<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function index() {
        return apiSuccess(new UserResource(auth()->user()));
    }

    public function update(Request $request) {
        $validatedData = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'other_name' => ['nullable', 'string', 'max:255'],
            'dob' => ['nullable', 'string', 'max:255'],
            'state' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'address1' => ['nullable', 'string', 'max:255'],
            'address2' => ['nullable', 'string', 'max:255'],
            'postal_code' => ['nullable', 'string', 'size:6'],
        ]);

        // return $validatedData;

        return apiSuccess(
            $this->userService->update($validatedData),
            'User updated successfully!'
        );
    }

    public function updateKin(Request $request) {
        $validatedData = $request->validate([
            'nok_name' => ['nullable', 'string', 'max:255'],
            'nok_phone' => ['nullable', 'string', 'max:255'],
            'nok_email' => ['nullable', 'string', 'max:255'],
            'nok_address' => ['nullable', 'string', 'max:255'],
            'nok_relationship' => ['nullable', 'string', 'max:255'],
        ]);

        return apiSuccess(
            $this->userService->updateKin($validatedData),
            'User Next of Kin Info updated successfully!'
        );
    }
}
