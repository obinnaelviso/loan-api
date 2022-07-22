<?php

namespace App\Http\Controllers;

use App\Http\Resources\BankAccountResource;
use App\Services\BankAccountService;
use Illuminate\Http\Request;

class BankAccountController extends Controller
{
    protected $bankAccountService;
    public function __construct(BankAccountService $bankAccountService) {
        $this->bankAccountService = $bankAccountService;
    }

    public function index()
    {
        return apiSuccess($this->bankAccountService->getAll(), "Bank account retrieved successfully!");
    }

    public function banks()
    {
        return apiSuccess($this->bankAccountService->getBanks(), "Banks retrieved successfully!");
    }

    public function store(Request $request) {
        $request->validate([
            'bank_name' => 'required|string',
            'account_name' => 'required|string',
            'account_number' => 'required|string|size:10|regex:/^[0-9]{10}$/',
        ]);

        $bankAccount = $this->bankAccountService->create($request->all());

        return apiSuccess(new BankAccountResource($bankAccount), "Bank account created successfully!");
    }

    public function update(Request $request, $id) {
        $request->validate([
            'bank_name' => 'required|string',
            'account_name' => 'required|string',
            'account_number' => 'required|string|size:10|regex:/^[0-9]{10}$/',
        ]);

        $bankAccount = $this->bankAccountService->update($id, $request->all());

        return apiSuccess(new BankAccountResource($bankAccount), "Bank account updated successfully!");
    }

    public function destroy($id) {
        $this->bankAccountService->delete($id);
        return apiSuccess(null, "Bank account deleted successfully!");
    }
}
