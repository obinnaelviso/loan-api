<?php

namespace App\Http\Controllers;

use App\Services\LoanPackageService;
use Illuminate\Http\Request;

class LoanPackageController extends Controller
{
    protected $loanPackageService;

    public function __construct(LoanPackageService $loanPackageService) {
        $this->loanPackageService = $loanPackageService;
    }

    public function index() {
        return apiSuccess(
            $this->loanPackageService->getActive(),
            "Loan packages retrieved successfully"
        );
    }
}
