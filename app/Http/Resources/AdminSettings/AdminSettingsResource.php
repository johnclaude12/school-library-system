<?php

namespace App\Http\Resources\AdminSettings;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminSettingsResource extends JsonResource
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
            'id' => $this->resource['id'],
            'no_of_books' => $this->resource['no_of_books'],
            'no_of_days_allow' => $this->resource['no_of_days_allow'],
            'penalty_per_day' => $this->resource['penalty_per_day'],
            'grace_period' => $this->resource['grace_period']
        ];
    }
}
