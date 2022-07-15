<?php

namespace App\Http\Controllers;

use App\Services\LoanService;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    protected $loanService;

    public function __construct(LoanService $loanService) {
        $this->loanService = $loanService;
    }

    public function index() {
        return apiSuccess($this->loanService->getAll(), "Loan applications retrieved successfully!");
    }

    public function currentLoan() {
        return apiSuccess($this->loanService->getCurrentLoan(), "Loan application retrieved successfully!");
    }

    public function apply(Request $request) {
        $request->validate([
            'loan_package_id' => 'required|integer|exists:loan_packages,id',
            'bank_account_id' => 'required|integer|exists:bank_accounts,id',
        ]);
        return apiSuccess(
            $this->loanService->apply(
                $request->loan_package_id,
                $request->bank_account_id,
            ),
            "Loan applied successfully!",
        );
    }

    public function statusUpdate($loanId, $status) {
        $loan = $this->loanService->changeStatus($loanId, $status);

        return apiSuccess(
            $loan,
            "Loan status updated successfully!",
        );
    }

    public function destroy($loanId) {
        $this->loanService->delete($loanId);

        return apiSuccess(
            null,
            "Loan deleted successfully!",
        );
    }
}
