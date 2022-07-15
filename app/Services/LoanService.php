<?php

namespace App\Services;

use App\Events\LoanStatusUpdated;
use App\Http\Resources\LoanResource;
use App\Repositories\LoanRepository;

class LoanService {

    protected $loanRepo;

    public function __construct(LoanRepository $loanRepo) {
        $this->loanRepo = $loanRepo;
    }

    public function getAll() {
        return LoanResource::collection($this->loanRepo->getAllByLatest());
    }

    public function getSingle($id) {
        return new LoanResource($this->loanRepo->getById($id));
    }

    public function apply($loanPackageId, $bankAccountId) {
        $loan = $this->loanRepo->create($loanPackageId, auth()->user()->id, $bankAccountId);

        event(new LoanStatusUpdated($loan->id, status_pending_id()));

        return new LoanResource($loan);
    }

    public function getCurrentLoan() {
        $loan = $this->loanRepo->getCurrentLoan(auth()->user()->id);
        return $loan ? new LoanResource($loan) : null;
    }

    public function changeStatus($loanId, string $status) {
        $loan = $this->loanRepo->getById($loanId);
        if ($status == 'active') {
            $statusId = status_active_id();
            $this->loanRepo->update($loanId, [
                'start_at' => now()
            ]);
            $this->loanRepo->update($loanId, [
                'due_at' => now()->addDays($loan->duration)
            ]);
        } else if($status == 'pending') {
            $statusId = status_pending_id();
            $this->loanRepo->update($loanId, [
                'start_at' => null
            ]);
            $this->loanRepo->update($loanId, [
                'due_at' => null
            ]);
        } else if($status == 'completed') {
            $statusId = status_completed_id();
        } else if($status == 'rejected') {
            $statusId = status_rejected_id();
        } else {
            throw new \Exception("Invalid status");
        }

        $this->loanRepo->updateStatus($loanId, $statusId);
        event(new LoanStatusUpdated($loanId, $statusId));

        return new LoanResource($this->loanRepo->getById($loanId));
    }

    public function delete($loanId) {
        $this->loanRepo->delete($loanId);
    }
}
