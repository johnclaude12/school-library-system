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

        return [
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
        ];
    }
}
