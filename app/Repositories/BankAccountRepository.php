<?php

namespace App\Repositories;

use App\Models\BankAccount;
use App\Models\User;

class BankAccountRepository
{

    public function getAll()
    {
        return BankAccount::all();
    }
    public function getById($id)
    {
        return BankAccount::find($id);
    }
    public function getByUser($userId)
    {
        return BankAccount::where('user_id', $userId)->first();
    }
    public function create(User $user, array $data)
    {
        return $user->bankAccount()->create($data + [
            'status_id' => status_active_id()
        ]);
    }
    public function update(string $bankAccountId, array $data)
    {
        return BankAccount::find($bankAccountId)->update($data);
    }
    public function delete(string $bankAccountId)
    {
        return BankAccount::find($bankAccountId)->delete();
    }
}
