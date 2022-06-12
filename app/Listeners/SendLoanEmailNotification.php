<?php

namespace App\Listeners;

use App\Events\LoanStatusUpdated;
use App\Mail\LoanStatusUpdateMail;
use App\Repositories\LoanRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendLoanEmailNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    protected $loanRepo;
    public function __construct(LoanRepository $loanRepo)
    {
        $this->loanRepo = $loanRepo;
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\LoanStatusUpdated  $event
     * @return void
     */
    public function handle(LoanStatusUpdated $event)
    {
        $loan = $this->loanRepo->getById($event->loanId);
        Mail::to($loan->user->email)->send(new LoanStatusUpdateMail($loan, $event->statusId));
    }
}
