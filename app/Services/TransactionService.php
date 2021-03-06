<?php

namespace App\Services;

use App\Http\Resources\TransactionCollection;
use App\Http\Resources\TransactionResource;
use App\Repositories\TransactionRepository;

class TransactionService {

    public $transactionRepo;
    public function __construct(TransactionRepository $transactionRepo) {
        $this->transactionRepo = $transactionRepo;
    }

    public function get($size, $page) {
        $transactions = $this->transactionRepo->getByUser(auth()->user()->id, $size, $page);
        return new TransactionCollection($transactions);
    }

    public function getSingle($id) {
        $transaction = $this->transactionRepo->getById($id);
        return new TransactionResource($transaction);
    }

    public function getAll($size, $page) {
        $transactions = $this->transactionRepo->getAll($size, $page);
        return new TransactionCollection($transactions);
    }

    public function updateTransactionService(string $reference, array $data) {
        $this->transactionRepo->updateTransaction($reference, $data);
    }
}
