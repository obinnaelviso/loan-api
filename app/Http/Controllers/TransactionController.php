<?php

namespace App\Http\Controllers;

use App\Services\TransactionService;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function index(Request $request) {
        $request->validate([
            'size' => ['required', 'integer', 'min:1'],
            'page' => ['required', 'integer', 'min:1']
        ]);
        $transactions = $this->transactionService->get($request->size, $request->page);
        return apiSuccess($transactions, 'Transactions retrieved successfully!');
    }

    public function all(Request $request) {
        $request->validate([
            'size' => ['required', 'integer', 'min:1'],
            'page' => ['required', 'integer', 'min:1']
        ]);
        $transactions = $this->transactionService->getAll($request->size, $request->page);
        return apiSuccess($transactions, 'Transactions retrieved successfully!');
    }
}
