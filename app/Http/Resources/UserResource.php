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
        $resource = [
            'id' => $this->id,
            'name' => $this->name,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'other_name' => $this->other_name,
            'email' => $this->email,
            'phone_verified' => $this->phone_verified,
            'email_verified' => $this->email_verified,
            'dob' => $this->info->dob,
            'state' => $this->info->state,
            'city' => $this->info->city,
            'address1' => $this->info->address1,
            'address2' => $this->info->address2,
            'postal_code' => $this->info->postal_code,
            'nok_name' => $this->info->nok_name,
            'nok_phone' => $this->info->nok_phone,
            'nok_email' => $this->info->nok_email,
            'nok_address' => $this->info->nok_address,
            'nok_relationship' => $this->info->nok_relationship,
            'role' => $this->is_user ? 'User' : 'Admin',
            'wallet' => new WalletResource($this->wallet),
            'status' => new StatusResource($this->status),
        ];
        if (auth()->user()->is_admin) {
            $resource['checked_by'] = $this->info->checked_by ? new UserResource($this->info->checked_by_user) : null;
            $resource['id_type'] = $this->idVerification ? $this->idVerification->id_type : 'N/A';
            $resource['submitted_at'] = $this->info->created_at->format('d M Y, h:i A'); // 01 Jan 2020, 12:00 AM
        }
        return $resource;
    }
}
