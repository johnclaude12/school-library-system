<?php

namespace App\Http\Resources\AdminSettings;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminSettingsCollection extends JsonResource
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
            'no_of_books' => $this->no_of_books,
            'no_of_days_allow' => $this->no_of_days_allow,
            'penalty_per_day' => $this->penalty_per_day,
            'grace_period' => $this->grace_period
        ];
    }
}
