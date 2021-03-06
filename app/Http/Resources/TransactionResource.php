<?php

namespace App\Http\Resources;

use App\Enums\TransactionEnum;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data = [
            'id' => $this->id,
            'title' => $this->type_text,
            'amount' => $this->amount,
            'amount_string' => $this->amount_string,
            'reference' => $this->reference,
            'user' => new UserResource($this->user),
            'status' => new StatusResource($this->status),
            'created_at' => $this->created_at
        ];

        if ($this->transactable_id > 0) {
            if ($this->type == TransactionEnum::LOAN) {
                $data['loan'] = new LoanResource($this->transactable);
            }
            else if ($this->type == TransactionEnum::SAVE_CARD) {
                $data['card'] = new CardResource($this->transactable);
            }
        }

        return $data;
    }
}
