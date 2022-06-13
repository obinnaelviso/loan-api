<?php

namespace App\Repositories;

use App\Models\Loan;
use App\Repositories\LoanPackageRepository;
use App\Traits\ReferenceNumbers;

class LoanRepository {
    use ReferenceNumbers;

    protected $loanPackageRepo;
    protected $userRepo;

    public function __construct(LoanPackageRepository $loanPackageRepo, UserRepository $userRepo) {
        $this->loanPackageRepo = $loanPackageRepo;
        $this->userRepo = $userRepo;
    }

    public function getAllByLatest() {
        return Loan::latest()->get();
    }

    public function getById($id) {
        return Loan::find($id);
    }

    public function getByReferenceNumber($referenceNumber) {
        return Loan::where('reference_number', $referenceNumber)->first();
    }

    public function create($loanPackageId, $userId, $bankAccountId) {
        if ($this->getCurrentLoan($userId)) {
            throw new \Exception('You already have a current loan. You can\'t apply for another.');
        }
        $user = $this->userRepo->getById($userId);
        $loanPackage = $this->loanPackageRepo->getById($loanPackageId);
        return $user->loans()->create([
            'reference_number' => $this->generateLoanReference($this),
            'loan_score' => $loanPackage->amount,
            'percentage' => $loanPackage->percentage,
            'duration' => $loanPackage->duration,
            'amount' => $loanPackage->amount,
            'due_amount' => $loanPackage->total_amount_due,
            'interest' => $loanPackage->interest,
            'bank_account_id' => $bankAccountId,
            'status_id' => status_pending_id()
        ]);
    }

    public function getCurrentLoan($userId) {
        $user = $this->userRepo->getById($userId);
        return $user->loans()->where('status_id', '<>', status_completed_id())->first();
    }

    public function updateStatus($loanId, $statusId) {
        $loan = $this->getById($loanId);
        $loan->status_id = $statusId;
        $loan->save();
    }

    public function delete($loanId) {
        $loan = $this->getById($loanId);
        $loan->delete();
    }

    public function getClassConstant() {
        return Loan::class;
    }
}
