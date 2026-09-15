<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Admin;
use App\Support\ActivityLogger;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm(): View
    {
        return view('admin.login');
    }

    
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $admin = Admin::where('username', $credentials['username'])->first();

        if (!$admin || !Hash::check($credentials['password'], $admin->password)) {
            return redirect()
                ->route('admin.login')
                ->withInput($request->only('username'))
                ->with('error', 'Invalid username or password.');
        }

        session(['admin_id' => $admin->id]);

        ActivityLogger::record($admin->id, 'Login', 'Successful admin console session start');

        return redirect()
            ->route('admin.dashboard')
            ->with('status', 'Welcome back, Admin User.');
    }

    public function logout(Request $request): RedirectResponse
    {
        session()->forget('admin_id');

        return redirect()
            ->route('admin.login')
            ->with('status', 'You have been logged out.');
    }
}
