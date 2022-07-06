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

    public function getAll() {
        return $this->loanPackage->all();
    }

    public function create(array $data) {
        return $this->loanPackage->create($data);
    }
    public function update($id, array $data) {
        $loanPackage = $this->getById($id);
        $loanPackage->update($data);
        return $loanPackage;
    }
    public function delete($id) {
        $loanPackage = $this->getById($id);
        $loanPackage->delete();
        return $loanPackage;
    }
}
