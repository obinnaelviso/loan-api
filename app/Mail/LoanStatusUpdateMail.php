<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LoanStatusUpdateMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $loan;
    public $statusId;
    public function __construct($loan, $statusId)
    {
        $this->loan = $loan;
        $this->statusId = $statusId;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("We've got some news about your loan application!")
            ->markdown('emails.loan-status-update-mail', [
                'loan' => $this->loan,
                'statusId' => $this->statusId,
            ]);
    }
}
