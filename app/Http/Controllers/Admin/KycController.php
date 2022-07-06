<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;

class KycController extends Controller
{
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index() {
        $kycs = $this->userService->allUsers();
        return view('admin.kycs.index', compact('kycs'));
    }

    public function show($id) {
        $kyc = $this->userService->get($id);
        return view('admin.kycs.show', compact('kyc'));
    }

    public function approve($id) {
        $this->userService->approve($id);
        return back()->with('success', 'KYC Approved Successfully');
    }

    public function reject($id) {
        $this->userService->reject($id);
        return back()->with('success', 'KYC Rejected Successfully');
    }

    public function revert($id) {
        $this->userService->revert($id);
        return back()->with('success', 'KYC Reverted Successfully');
    }
}
