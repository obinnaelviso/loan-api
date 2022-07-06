<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\LoanService;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public $loanService;

    public function __construct(LoanService $loanService)
    {
        $this->loanService = $loanService;
    }

    public function index()
    {
        $loans = $this->loanService->getAll();
        return view('admin.loans.index', compact('loans'));
    }

    public function show($id) {
        $loan = $this->loanService->getSingle($id);
        return view('admin.loans.show', compact('loan'));
    }

    public function statusUpdate($loanId, $status) {
        $loan = $this->loanService->changeStatus($loanId, $status);

        return back()->with('success', 'Loan status updated successfully!');
    }

    public function approve($loanId) {
        $this->loanService->changeStatus($loanId, 'active');
        return back()->with('success', 'Loan Approved Successfully');
    }

    public function reject($loanId) {
        $this->loanService->changeStatus($loanId, 'rejected');
        return back()->with('success', 'Loan Rejected Successfully');
    }

    public function complete($loanId) {
        $this->loanService->changeStatus($loanId, 'completed');
        return back()->with('success', 'Loan Completed Successfully');
    }

    public function revert($loanId) {
        $this->loanService->changeStatus($loanId, 'pending');
        return back()->with('success', 'Loan status Reverted Successfully');
    }

    public function destroy($loanId) {
        $this->loanService->delete($loanId);

        return back()->with('success', 'Loan application deleted successfully!');
    }
}
