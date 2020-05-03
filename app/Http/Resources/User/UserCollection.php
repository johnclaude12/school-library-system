<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'firstname' => $this->firstname,
            'middlename' => $this->middlename,
            'lastname' => $this->lastname,
            'gender' => $this->gender,
            'contact_no' => $this->contact_no,
            'birthday' => $this->birthday,
            'username' => $this->username,
            'email' => $this->email,
            'question' => $this->question->question,
            'security_answer' => $this->security_answer
        ];
    }
}
