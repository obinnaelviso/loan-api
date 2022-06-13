<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository {

    public function create(array $data)
    {
        return User::create($data);
    }

    public function update(int $id, array $data)
    {
        $user = $this->getById($id);
        if ($user) {
            $user->info()->update([
                'dob' => $data['dob'],
                'state' => $data['state'],
                'city' => $data['city'],
                'address1' => $data['address1'],
                'address2' => $data['address2'],
                'postal_code' => $data['postal_code'],
            ]);
            $user = $user->update([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name']
            ]);
            $user = $this->getById($id);
        } else {
            throw new \Exception('User not found');
        }
        return $user;
    }

    public function getAuthUser()
    {
        return $this->getById(auth()->user()->id);
    }

    public function getById($id) {
        return User::find($id);
    }

    public function getByEmail(string $email) {
        return User::where('email', $email)->first();
    }

    public function createUserInfo(User $user, array $data)
    {
        return $user->info()->create($data);
    }

    public function createIdVerification(User $user, array $data)
    {
        return $user->idVerification()->create($data);
    }

    public function createWallet(User $user, array $data) {
        return $user->wallet()->create($data);
    }

    public function createOTP(User $user, array $data) {
        return $user->otp()->create($data);
    }

    public function getOTP(User $user) {
        return $user->otp;
    }
}
