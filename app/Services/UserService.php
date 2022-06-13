<?php

namespace App\Services;

use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;

class UserService {

    public $userRepo;
    public function __construct(UserRepository $userRepo) {
        $this->userRepo = $userRepo;
    }

    public function update(array $data) {
        $user = $this->userRepo->update(auth()->user()->id, $data);
        return new UserResource($user);
    }
}
