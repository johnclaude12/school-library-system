<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_image' => $this->user_image ? "images/profile/".$this->user_image : "images/profile/user.png",
            'user_type_id' => $this->user_type_id,
            'user_type' => $this->userType->name,
            'firstname' => $this->firstname,
            'middlename' => $this->middlename,
            'lastname' => $this->lastname,
            'fullname' => $this->firstname ." ". $this->lastname,
            'gender' => $this->gender,
            'contact_no' => $this->contact_no,
            'birthday' => $this->birthday,
            'username' => $this->username,
            'email' => $this->email,
            'question_id' => $this->question_id,
            'question' => $this->question->question,
            'security_answer' => $this->security_answer
        ];
    }
}
