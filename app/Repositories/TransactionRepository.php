<?php

namespace App\Repositories;

use App\Models\Transaction;

class TransactionRepository {
    public $userRepo;

    public function __construct(Transaction $transaction) {
        $this->transaction = $transaction;
    }

    public function getByReferenceNumber(string $referenceNumber) {
        return $this->transaction->where('reference', $referenceNumber)->first();
    }

    public function create(array $data) {
        return $this->transaction->create($data);
    }

    public function getByUser($userId, $size, $page) {
        return $this->transaction
            ->where('user_id', $userId)
            ->latest()
            ->paginate($size, ['*'], 'page', $page);
    }

    public function getAll($size, $page) {
        return $this->transaction
            ->latest()
            ->paginate($size, ['*'], 'page', $page);
    }

    public function updateTransaction($referenceNumber, array $data) {
        $transaction = $this->getByReferenceNumber($referenceNumber);
        if ($transaction) {
            $transaction->update($data);
        } else {
            throw new \Exception('Transaction not found');
        }
    }
}
