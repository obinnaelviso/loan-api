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

    public function suspend($id) {
        $user = $this->userRepo->updateStatus($id, status_suspended_id());
        return new UserResource($user);
    }

    public function active($id) {
        $user = $this->userRepo->updateStatus($id, status_active_id());
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

    public function resetPassword($id) {
        $user = $this->userRepo->resetPassword($id);
        return new UserResource($user);
    }

    public function allUsers() {
        return UserResource::collection($this->userRepo->allUsers());
    }

    public function all() {
        return UserResource::collection($this->userRepo->all());
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
