<?php

namespace App\Repositories;

use App\Models\LoanPackage;

class LoanPackageRepository {

    protected $loanPackage;

    public function __construct(LoanPackage $loanPackage) {
        $this->loanPackage = $loanPackage;
    }

    public function getActive() {
        return $this->loanPackage->active()->get();
    }
}
