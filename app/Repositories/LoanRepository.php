<?php

namespace App\Repositories;

use App\Models\Loan;
use App\Repositories\LoanPackageRepository;
use App\Traits\ReferenceNumbers;

class LoanRepository
{
    use ReferenceNumbers;

    protected $loanPackageRepo;
    protected $userRepo;
    protected $bankAccountRepo;

    public function __construct(LoanPackageRepository $loanPackageRepo, UserRepository $userRepo, BankAccountRepository $bankAccountRepo)
    {
        $this->loanPackageRepo = $loanPackageRepo;
        $this->userRepo = $userRepo;
        $this->bankAccountRepo = $bankAccountRepo;
    }

    public function getAllByLatest()
    {
        return Loan::latest()->get();
    }

    public function getById($id)
    {
        return Loan::find($id);
    }

    public function getByReferenceNumber($referenceNumber)
    {
        return Loan::where('reference_number', $referenceNumber)->first();
    }

    public function create($loanPackageId, $userId)
    {
        if ($this->getCurrentLoan($userId)) {
            throw new \Exception('You already have a current loan. You can\'t apply for another.');
        }
        $user = $this->userRepo->getById($userId);
        $loanPackage = $this->loanPackageRepo->getById($loanPackageId);
        $bankAccount = $this->bankAccountRepo->getByUser($userId);
        if ($bankAccount == null) {
            throw new \Exception('You\'ve not set a bank account. Please add one.');
        }
        return $user->loans()->create([
            'title' => $loanPackage->name,
            'reference_number' => $this->generateLoanReference($this),
            'loan_score' => $loanPackage->amount,
            'percentage' => $loanPackage->percentage,
            'duration' => $loanPackage->duration,
            'amount' => $loanPackage->amount,
            'due_amount' => $loanPackage->total_amount_due,
            'interest' => $loanPackage->interest,
            'bank_account_id' => $bankAccount->id,
            'status_id' => status_pending_id()
        ]);
    }

    public function getCurrentLoan($userId)
    {
        $user = $this->userRepo->getById($userId);
        return $user->loans()->where('status_id', '<>', status_completed_id())->first();
    }

    public function update(int $id, array $data)
    {
        $loan = $this->getById($id);
        if ($loan) {
            $loan = $loan->update($data);
            $loan = $this->getById($id);
        } else {
            throw new \Exception('Loan not found');
        }
        return $loan;
    }

    public function updateStatus($loanId, $statusId)
    {
        $loan = $this->getById($loanId);
        $loan->status_id = $statusId;
        $loan->save();
    }

    public function delete($loanId)
    {
        $loan = $this->getById($loanId);
        $loan->delete();
    }

    public function getClassConstant()
    {
        return Loan::class;
    }
}
