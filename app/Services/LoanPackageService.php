<?php

namespace App\Services;

use App\Http\Resources\LoanPackageResource;
use App\Repositories\LoanPackageRepository;

class LoanPackageService {

    protected $loanPackageRepository;

    public function __construct(LoanPackageRepository $loanPackageRepository) {
        $this->loanPackageRepository = $loanPackageRepository;
    }

    public function get($id) {
        $loanPackage = $this->loanPackageRepository->getById($id);
        return new LoanPackageResource($loanPackage);
    }

    public function getActive() {
        return LoanPackageResource::collection($this->loanPackageRepository->getActive());
    }

    public function getAll() {
        return LoanPackageResource::collection($this->loanPackageRepository->getAll());
    }

    public function create(array $data) {
        return $this->loanPackageRepository->create($data + ['status_id' => status_active_id()]);
    }

    public function update($id, array $data) {
        return $this->loanPackageRepository->update($id, $data);
    }

    public function delete($id) {
        return $this->loanPackageRepository->delete($id);
    }
}
