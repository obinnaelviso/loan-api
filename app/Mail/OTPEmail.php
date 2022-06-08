<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OTPEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $otp;
    protected $expireInMins;

    public function __construct(string $otp, int $expireInMins)
    {
        $this->otp = $otp;
        $this->expireInMins = $expireInMins;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('You have received an OTP')
            ->markdown('emails.otp-email', [
                'otp' => $this->otp,
                'expireInMins' => $this->expireInMins
            ]);
    }
}
