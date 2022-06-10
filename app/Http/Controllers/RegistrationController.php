<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\User;
use App\Services\RegisterService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RegistrationController extends Controller
{
    use PasswordValidationRules;

    protected $registerService;

    public function __construct(RegisterService $registerService) {
        $this->registerService = $registerService;
    }

    public function register(Request $request) {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'phone' => [
                'required',
                'string',
                'max:255',
                Rule::unique(User::class)
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
        ]);

        $user = $this->registerService->register($request);

        return apiSuccess($user, 'Registration successful!');
    }
}
