<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function index()
    {
        $transactions = $this->transactionService->getAll(100, 1);
        return view('admin.transactions.index', compact('transactions'));
    }

    public function show($id) {
        $transaction = $this->transactionService->getSingle($id);
        return view('admin.transactions.show', compact('transaction'));
    }
}
