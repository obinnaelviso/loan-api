<?php

namespace App\Http\Controllers;

use App\Services\OtpService;
use Illuminate\Http\Request;

class OtpController extends Controller
{
    protected $otpService;

    public function __construct(OTPService $otpService) {
        $this->otpService = $otpService;
    }

    public function email(Request $request) {
        $request->validate([
            'email' => 'required|string|email'
        ]);
        $isSent = $this->otpService->sendEmailVerificationOTP($request->email, config('otp.expires_in_mins'));

        if ($isSent) {
            return apiSuccess(null, "OTP sent to email successfully!");
        } else {
            return apiError("Oops, something went wrong. Please try again later!");
        }
    }

    public function phone(Request $request) {
        $request->validate([
            'phone' => 'required|string|size:11|regex:/^[0-9]{11}$/'
        ]);
        $isSent = $this->otpService->sendPhoneVerificationOTP(formatPhoneNumber($request->phone), config('otp.expires_in_mins'));
        // return $isSent;
        if($isSent) {
            return apiSuccess($isSent, "OTP sent to phone successfully!");
        } else {
            return apiError("Oops, something went wrong. Please try again later!");
        }
    }
}
