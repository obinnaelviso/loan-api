<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CardResource extends JsonResource
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
            'id' => $this->id,
            'exp_month' => $this->exp_month,
            'exp_year' => $this->exp_year,
            'last4' => $this->last4,
            'card_type' => $this->card_type,
            'bank' => $this->bank,
            'is_default' => $this->is_default,
        ];
    }
}
