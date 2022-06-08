<?php

namespace App\Http\Controllers;

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
        return $this->generateTokenService->generateLoginToken($request);
    }

    public function logout()
    {
        return $this->generateTokenService->revokeLoginToken();
    }
}
