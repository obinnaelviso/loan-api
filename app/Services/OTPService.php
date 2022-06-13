<?php

namespace App\Services;

use App\Enums\OtpEnum;
use App\Mail\OTPEmail;
use App\Repositories\OtpRepository;
use App\Traits\SendSMS;
use Illuminate\Support\Facades\Mail;

class OtpService {

    use SendSMS;

    protected $otpRepo;

    public function __construct(OtpRepository $otpRepo) {
        $this->otpRepo = $otpRepo;
    }

    public function sendEmailVerificationOTP(string $email, int $expireInMins = 15) : bool {
        // Send email here
        $otp = $this->retrieveOTP($email, OtpEnum::EMAIL_VERIFICATION, $expireInMins);
        try {
            Mail::to($email)->send(new OTPEmail($otp, $expireInMins));
            return true;
        } catch (\Throwable $e) {
            // report error
            return false;
        }
    }

    public function sendPhoneVerificationOTP(string $phone, int $expireInMins = 15) {
        // Send SMS here
        $otp = $this->retrieveOTP($phone, OtpEnum::PHONE_VERIFICATION, $expireInMins);
        return $this->sendSMS($phone,
            "Here is your OTP: {$otp}. \nIt will expire in {$expireInMins} minutes. \nPlease do not share this OTP with anyone."
        );
    }

    protected function retrieveOTP($entity, $type, int $expireInMins) : string {
        $otp = $this->otpRepo->get($entity, $type);
        // Check if user already generated OTP and if it is expired
        if($otp == null) {
            $generatedOTP = $this->generateOTP();
            return $this->storeOTP($generatedOTP, $entity, $type, $expireInMins)->otp;
        } else {
            return $otp->otp;
        }
    }

    protected function generateOTP(int $size = 5) {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $size; $i++) {
            $randomString .= $characters[mt_rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    protected function storeOTP(string $generatedOTP, string $entity, string $type, int $expireInMins) {
        return $this->otpRepo->create([
            'otp' => $generatedOTP,
            'entity' => $entity,
            'type' => $type,
            'expired_at' => now()->addMinutes($expireInMins),
            'status_id' => status_pending_id()
        ]);
    }
}
