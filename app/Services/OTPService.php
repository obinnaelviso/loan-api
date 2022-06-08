<?php

namespace App\Services;

use App\Mail\OTPEmail;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Mail;

class OTPService {

    protected $userRepo;

    public function __construct(UserRepository $userRepo) {
        $this->userRepo = $userRepo;
    }

    public function generateOTP(int $size = 5) {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $size; $i++) {
            $randomString .= $characters[mt_rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function storeOTP(int $generatedOTP, User $user, int $expireInMins) {
        return $this->userRepo->createOTP($user, [
            'otp' => $generatedOTP,
            'expired_at' => now()->addMinutes($expireInMins),
            'status_id' => status_pending_id()
        ]);
    }

    public function sendEmailOTP(User $user, $expireInMins = 15) {
        // Send email here
        $otp = $this->retrieveUserOTP($user, $expireInMins);
        try {
            Mail::to($user->email)->send(new OTPEmail($otp, $expireInMins));
        } catch (\Exception $e) {
            // report error
        }
    }

    public function retrieveUserOTP(User $user, int $expireInMins) : string {
        $otp = $this->userRepo->getOTP($user);
        // Check if user already generated OTP and if it is expired
        if($otp == null || $otp->expired_at < now()) {
            $generatedOTP = $this->generateOTP();
            return $this->storeOTP($generatedOTP, $user, $expireInMins)->otp;
        } else {
            return $otp->otp;
        }
    }
}
