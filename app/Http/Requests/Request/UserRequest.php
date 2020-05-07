<?php

namespace App\Http\Requests\Request;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $aplha_allow_spaces = 'regex:/^[.a-zA-Z\s]*$/';
        $isMethodPut = $this->method() == 'PUT';

        return array_merge(
            [
                'user_type_id' => 'required|numeric',
                'username' => $isMethodPut ? 'required|min:8|max:25' : 'required|min:8|max:25|unique:users',
                'password' => $isMethodPut ? '' : 'required|min:8|max:25',
                'email' =>  $isMethodPut ? 'required|email' : 'required|email|unique:users,email',
                'firstname' => 'required|max:50',
                'middlename' => 'required|max:50|'. $aplha_allow_spaces,
                'lastname' => 'required|max:50|'. $aplha_allow_spaces,
                'gender' => 'required|alpha|max:1',
                'contact_no' => $isMethodPut ? 'required|numeric|digits_between:10,12' : 'required|numeric|digits_between:10,12|unique:users',
                'birthday' => 'required|date_format:Y-m-d',
                'question_id' => 'required|max:1',
                'security_answer' => 'required'
            ],
            $this->changePassValidator($this) // insert array
        );
    }

    public function attributes()
    {
        return [
            'password' => 'new password'
        ];
    }

    public function changePassValidator($data)
    {
        if (isset($data->current_password) || isset($data->newpassword) || isset($data->confirm_password)) {
            return [
                'current_password' => [
                    'required', 'min:8', 'max:25',
                    function($attribute, $value, $fail) {
                        $comparePassword = \Hash::check($value, auth()->user()->password);

                        if ($comparePassword == false) {
                            $fail('Password did not match.');
                        }
                    }
                ],
                'password' => 'required|min:8|max:25',
                'confirm_password' => 'required|same:password|min:8|max:25'
            ];
        }

        return ['' => ''];
    }
}
