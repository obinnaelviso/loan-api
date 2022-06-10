<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Services\GenerateTokenService;
use Illuminate\Http\Request;

class GenerateTokenController extends Controller
{
    public $generateTokenService;

    public function __construct(GenerateTokenService $generateTokenService)
    {
        $this->generateTokenService = $generateTokenService;
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required'
        ]);
        $data = $this->generateTokenService->generateLoginToken($request);
        return apiSuccess($data, 'Login Successful');
    }

    public function logout()
    {
        $this->generateTokenService->revokeLoginToken();
        return apiSuccess(null, 'Logout Successful');
    }
}
