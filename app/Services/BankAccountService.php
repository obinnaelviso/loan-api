<?php

namespace App\Services;

use App\Http\Resources\BankAccountResource;
use App\Repositories\BankAccountRepository;
use Illuminate\Support\Facades\Http;

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

    public function getBanks()
    {
        $response = $this->initializeApi()->get(config('paystack.url') . '/bank?currency=NGN');
        $data = $response->object();
        return $data ? $data->data : null;
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

    protected function initializeApi()
    {
        return Http::withToken(config('paystack.sk'));
    }
}
