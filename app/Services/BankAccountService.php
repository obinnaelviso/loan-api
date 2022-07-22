<?php

namespace App\Services;

use App\Http\Resources\BankAccountResource;
use App\Repositories\BankAccountRepository;

class BankAccountService
{

    protected $bankAccountRepo;
    public function __construct(BankAccountRepository $bankAccountRepo)
    {
        $this->bankAccountRepo = $bankAccountRepo;
    }

    public function getAll()
    {
        return BankAccountResource::collection([$this->bankAccountRepo->getByUser(auth()->user()->id)]);
    }

    public function create(array $data)
    {
        return $this->bankAccountRepo->create(auth()->user(), $data);
    }

    public function update($id, array $data)
    {
        $this->bankAccountRepo->update($id, $data);
        return $this->bankAccountRepo->getById($id);
    }

    public function delete($id)
    {
        return $this->bankAccountRepo->delete($id);
    }
}
