<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone_verified' => $this->phone_verified,
            'email_verified' => $this->email_verified,
            'dob' => $this->info->dob,
            'state' => $this->info->state,
            'city' => $this->info->city,
            'address1' => $this->info->address1,
            'address2' => $this->info->address2,
            'postal_code' => $this->info->postal_code,
            'role' => $this->is_user ? 'User' : 'Admin',
            'wallet' => new WalletResource($this->wallet),
            'status' => new StatusResource($this->status),
        ];
    }
}
