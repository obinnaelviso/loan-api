<?php

namespace App\Services;

use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;

class UserService {

    public $userRepo;
    public function __construct(UserRepository $userRepo) {
        $this->userRepo = $userRepo;
    }

    public function get($id) {
        $user = $this->userRepo->getById($id);
        return new UserResource($user);
    }

    public function update(array $data) {
        $user = $this->userRepo->update(auth()->user()->id, $data);
        return new UserResource($user);
    }

    public function updateKin(array $data) {
        $user = $this->userRepo->updateKin(auth()->user()->id, $data);
        return new UserResource($user);
    }

    public function allUsers() {
        return UserResource::collection($this->userRepo->allUsers());
    }

    public function updateUserInfo($id, array $data) {
        return $this->userRepo->updateUserInfo($id, $data);
    }

    public function approve($id) {
        $this->updateUserInfo($id, ['status_id' => status_approved_id()]);
    }

    public function reject($id) {
        $this->updateUserInfo($id, ['status_id' => status_rejected_id()]);
    }

    public function revert($id) {
        $this->updateUserInfo($id, ['status_id' => status_pending_id()]);
    }
}
