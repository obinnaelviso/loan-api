<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LoanResource extends JsonResource
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
            'amount' => $this->amount,
            'amount_string' => $this->amount_string,
            'interest' => $this->interest,
            'interest_string' => $this->interest_string,
            'duration' => $this->duration,
            'duration_string' => $this->duration_string,
            'total_amount_due' => $this->total_amount_due,
            'total_amount_due_string' => $this->total_amount_due_string,
            'start_date' => $this->start_at,
            'end_date' => $this->due_at,
            'status' => $this->status,
            'user' => new UserResource($this->user),
            'bank_account' => new BankAccountResource($this->bankAccount),
            'status' => new StatusResource($this->status),
        ];
    }
}
