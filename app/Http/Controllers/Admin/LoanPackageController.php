<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\LoanPackageService;
use Illuminate\Http\Request;

class LoanPackageController extends Controller
{
    protected $loanPackageService;

    public function __construct(LoanPackageService $loanPackageService) {
        $this->loanPackageService = $loanPackageService;
    }

    public function index() {
        $packages = $this->loanPackageService->getAll();
        return view('admin.loan-packages.index', compact('packages'));
    }

    public function create() {
        return view('admin.loan-packages.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'loan_score' => 'required|numeric',
            'amount' => 'required|numeric',
            'duration' => 'required|numeric',
            'percentage' => 'required|numeric',
        ]);
        $this->loanPackageService->create($request->all());
        return redirect()->route('admin.loan-packages.index')->with('success', 'Loan package created successfully');
    }

    public function edit($id) {
        $package = $this->loanPackageService->get($id);
        return view('admin.loan-packages.edit', compact('package'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|string|max:255',
            'loan_score' => 'required|numeric',
            'amount' => 'required|numeric',
            'duration' => 'required|numeric',
            'percentage' => 'required|numeric',
        ]);
        $this->loanPackageService->update($id, $request->all());
        return redirect()->route('admin.loan-packages.index')->with('success', 'Loan package updated successfully');
    }

    public function destroy($id) {
        $this->loanPackageService->delete($id);
        return back()->with('success', 'Loan package deleted successfully');
    }
}
