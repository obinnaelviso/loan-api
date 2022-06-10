<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IdVerificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id_number' => $this->id_number,
            'id_type' => $this->id_type,
            'id_firstname' => $this->firstname,
            'id_lastname' => $this->lastname,
            'id_gender' => $this->gender,
            'id_phone' => $this->phone,
            'id_birthdate' => $this->birthdate,
        ];
    }
}
