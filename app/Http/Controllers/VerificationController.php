<?php

namespace App\Http\Controllers;

use App\Http\Resources\IdVerificationResource;
use App\Services\VerificationService;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    protected $verificationService;

    public function __construct(VerificationService $verificationService) {
        $this->verificationService = $verificationService;
    }

    public function phone(Request $request) {
        $request->validate([
            'phone' => 'required|string|size:11|regex:/^[0-9]{11}$/',
            'otp' => 'required|string'
        ]);

        $isVerified = $this->verificationService->verifyPhone(formatPhoneNumber($request->phone), $request->otp);

        if ($isVerified) {
            return apiSuccess(null, "Phone verified successfully!");
        } else {
            return apiError("Invalid OTP! Please input correct one.");
        }
    }

    public function email(Request $request) {
        $request->validate([
            'email' => 'required|string|email',
            'otp' => 'required|string'
        ]);

        $isVerified = $this->verificationService->verifyEmail($request->phone, $request->otp);

        if ($isVerified) {
            return apiSuccess(null, "Email verified successfully!");
        } else {
            return apiError("Invalid OTP! Please input correct one.");
        }
    }

    public function nin(Request $request) {
        $request->validate([
            'nin' => 'required|string|size:11|regex:/^[0-9]{11}$/',
        ]);

        $ninData = $this->verificationService->verifyNIN($request->nin);

        if ($ninData) {
            return apiSuccess(
                [
                    'id_number' => $ninData->nin,
                    'id_type' => 'NIN',
                    'id_firstname' => $ninData->firstname,
                    'id_lastname' => $ninData->lastname,
                    'id_middlename' => $ninData->middlename,
                    'id_gender' => $ninData->gender,
                    'id_phone' => $ninData->phone,
                    'id_birthdate' => $ninData->birthdate,
                ],
                "NIN verified successfully"
            );
        } else {
            return apiError(
                "NIN verification failed",
            );
        }
    }
}
