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
            'label' => $this->description,
            'name' => $this->name,
            'required' => $this->required,
            'type' => $this->type
        ];
    }
}
