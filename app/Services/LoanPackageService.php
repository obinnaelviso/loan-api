<?php

namespace App\Services;

use App\Http\Resources\LoanPackageResource;
use App\Repositories\LoanPackageRepository;

class LoanPackageService {

    protected $loanPackageRepository;

    public function __construct(LoanPackageRepository $loanPackageRepository) {
        $this->loanPackageRepository = $loanPackageRepository;
    }

    public function getActive() {
        return LoanPackageResource::collection($this->loanPackageRepository->getActive());
    }
}
