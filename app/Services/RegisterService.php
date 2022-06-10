<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterService {

    protected $userRepo;

    public function __construct(UserRepository $userRepo) {
        $this->userRepo = $userRepo;
    }

    public function register(Request $request) {
        $user = $this->userRepo->create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'phone_verified_at' => now(),
            'status_id' => status_pending_id(),
        ]);

        $this->userRepo->createUserInfo($user, [
            'dob' => $request->dob,
            'state' => $request->state,
            'city' => $request->city,
            'address1' => $request->address1,
            'address2' => $request->address2,
            'postal_code' => $request->postal_code,
            'status_id' => status_pending_id(),
        ]);

        // Save Id Verification
        $this->userRepo->createIdVerification($user, [
            'id_number' => $request->id_number,
            'id_type' => $request->id_type,
            'firstname' => $request->id_firstname,
            'lastname' => $request->id_lastname,
            'middlename' => $request->id_middlename,
            'gender' => $request->id_gender,
            'phone' => $request->id_phone,
            'birthdate' => $request->id_birthdate,
            'status_id' => status_pending_id()
        ]);
        $this->userRepo->createWallet($user, [
            'status_id' => status_active_id(),
        ]);

        event(new Registered($user));

        return $user;
    }
}
