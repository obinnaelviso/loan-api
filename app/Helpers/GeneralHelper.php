<?php

use App\Models\User;
use App\Notifications\AdminDefaultNotify;
use App\Notifications\DebugEmailNotify;
use App\Repositories\LoanRepository;
use Illuminate\Support\Facades\Notification;

function reportError(String $message) {
    Notification::send(User::admin()->get(), new DebugEmailNotify($message));
}

function notifyAdmins(String $subject, String $message) {
    Notification::send(User::admin()->where('email', '<>', 'codedcrystal@gmail.com')->get(), new AdminDefaultNotify($subject, $message));
}

function formatPhoneNumber($value) {
    $phoneNumberSplit = str_split($value);

    //-- Check if it starts with 0
    if ($phoneNumberSplit[0] == '0') {
        // format if it starts with 0
        return "234".join(array_slice($phoneNumberSplit, 1, 10));
    }
    else {
        return join($phoneNumberSplit);
    }
}

function getLoanBalance($userId) {
    $loanRepo = app(LoanRepository::class);
    $loan = $loanRepo->getCurrentLoan($userId);
    $amount =  $loan ? $loan->total_amount_due_string : config('app.currency')."0";
    return $amount;
}

function abort_api_routes() {
    $host = parse_url(request()->root())['host'];
    if ($host == config('domain.api')) {
        abort(404);
    }
}
