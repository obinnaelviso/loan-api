<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository {

    public function create(array $data)
    {
        return User::create($data);
    }

    public function getAuthUser()
    {
        return auth()->user();
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
