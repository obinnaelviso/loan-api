<?php

namespace App\Repositories;

use App\Models\LoanPackage;

class LoanPackageRepository {

    protected $loanPackage;

    public function __construct(LoanPackage $loanPackage) {
        $this->loanPackage = $loanPackage;
    }

    public function getById($id) {
        return $this->loanPackage->find($id);
    }

    public function getActive() {
        return $this->loanPackage->active()->get();
    }
}
