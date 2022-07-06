<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index() {
        $users = $this->userService->all();
        return view('admin.users.index', compact('users'));
    }

    public function show($id) {
        $user = $this->userService->get($id);
        return view('admin.users.show', compact('user'));
    }

    public function suspend($id) {
        $this->userService->suspend($id);
        return back()->with('success', 'User Suspended Successfully');
    }

    public function active($id) {
        $this->userService->active($id);
        return back()->with('success', 'User Activated Successfully');
    }

    public function resetPassword($id) {
        $this->userService->resetPassword($id);
        return back()->with('success', 'User password reset Successfully');
    }
}
