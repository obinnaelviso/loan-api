<?php

namespace App\Traits;

use App\Repositories\LoanRepository;
use Illuminate\Support\Str;

trait ReferenceNumbers {

    public function generateLoanReference(LoanRepository $loanRepo) : string {
        $loanRef = 'LN'.Str::padLeft(mt_rand(1, 99999).mt_rand(1,9999), 9, '0');
        $loan = $loanRepo->getByReferenceNumber($loanRef);
        if ($loan) {
            $loanRef = $this->generateLoanReference($loanRepo);
        }
        return $loanRef;
    }
}
