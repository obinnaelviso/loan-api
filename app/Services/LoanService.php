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

    public function apply($loanPackageId, $bankAccountId) {
        $loan = $this->loanRepo->create($loanPackageId, auth()->user()->id, $bankAccountId);

        event(new LoanStatusUpdated($loan->id, status_pending_id()));

        return new LoanResource($loan);
    }

    public function changeStatus($loanId, string $status) {
        if ($status == 'active') {
            $statusId = status_active_id();
        } else if($status == 'pending') {
            $statusId = status_pending_id();
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
