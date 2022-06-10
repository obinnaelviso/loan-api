<?php

namespace App\Services;

use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class GenerateTokenService {

    protected $userRepo;

    public function __construct(UserRepository $userRepo) {
        $this->userRepo = $userRepo;
    }
    public function generateLoginToken(Request $request) : array {
        $user = $this->userRepo->getByEmail($request->email);
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken($request->device_name)->plainTextToken;
        return [
            'user' => new UserResource($user),
            'token' => $token
        ];
    }

    public function revokeLoginToken() : void {
        auth()->user()->tokens()->delete();
    }
}
