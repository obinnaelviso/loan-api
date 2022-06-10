<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LoanPackageResource extends JsonResource
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
            'title' => $this->name,
            'loan_score' => $this->loan_score,
            'percentage' => $this->percentage,
            'percentage_string' => $this->percentage_string,
            'amount' => $this->amount,
            'amount_string' => $this->amount_string,
            'duration' => $this->duration,
            'duration_string' => $this->duration_string,
            'interest' => $this->interest,
            'interest_string' => $this->interest_string,
            'status' => new StatusResource($this->status)
        ];
    }
}
