<?php

namespace App\Actions\Fortify;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    protected $userRepo;

    public function __construct(UserRepository $userRepo) {
        $this->userRepo = $userRepo;
    }

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'dob' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'address1' => ['required', 'string', 'max:255'],
            'address2' => ['nullable', 'string', 'max:255'],
            'postal_code' => ['required', 'string', 'size:6'],
            'id_number' => ['required', 'string', 'size:11', 'unique:id_verifications', 'regex:/^[0-9]{11}$/'],
            'id_type' => ['required', 'string', 'max:255'],
            'id_firstname' => ['nullable', 'string', 'max:255'],
            'id_lastname' => ['nullable', 'string', 'max:255'],
            'id_middlename' => ['nullable', 'string', 'max:255'],
            'id_gender' => ['nullable', 'string', 'max:255'],
            'id_phone' => ['nullable', 'string', 'max:255'],
            'id_birthdate' => ['nullable', 'string', 'max:255'],
            'password' => $this->passwordRules(),
        ])->validate();

        $user = $this->userRepo->create([
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'status_id' => status_pending_id(),
        ]);

        $this->userRepo->createUserInfo($user, [
            'dob' => $input['dob'],
            'state' => $input['state'],
            'city' => $input['city'],
            'address1' => $input['address1'],
            'address2' => $input['address2'],
            'postal_code' => $input['postal_code'],
            'status_id' => status_pending_id(),
        ]);

        $this->userRepo->createIdVerification($user, [
            'id_number' => $input['id_number'],
            'id_type' => $input['id_type'],
            'firstname' => $input['id_firstname'],
            'lastname' => $input['id_lastname'],
            'middlename' => $input['id_middlename'],
            'gender' => $input['id_gender'],
            'phone' => $input['id_phone'],
            'birthdate' => $input['id_birthdate'],
            'status_id' => status_pending_id()
        ]);

        $this->userRepo->createWallet($user, [
            'status_id' => status_active_id(),
        ]);

        return $user;
    }
}
