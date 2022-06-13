<?php

namespace App\Traits;

use App\Repositories\LoanRepository;
use App\Repositories\TransactionRepository;
use Illuminate\Support\Str;

trait ReferenceNumbers {

    public function generateLoanReference(LoanRepository $loanRepo) : string {
        $loanRef = 'FP-LN'.Str::padLeft(mt_rand(1, 99999).mt_rand(1,9999), 9, '0');
        $loan = $loanRepo->getByReferenceNumber($loanRef);
        if ($loan) {
            $loanRef = $this->generateLoanReference($loanRepo);
        }
        return $loanRef;
    }

    public function generatePaymentReference(TransactionRepository $transactionRepo) : string {
        $transactionRef = 'FP-PSTCK-'.Str::padLeft(mt_rand(1, 99999).mt_rand(1,9999), 9, '0');
        $transaction = $transactionRepo->getByReferenceNumber($transactionRef);
        if ($transaction) {
            $transactionRef = $this->generatetransactionReference($transactionRepo);
        }
        return $transactionRef;
    }
}
