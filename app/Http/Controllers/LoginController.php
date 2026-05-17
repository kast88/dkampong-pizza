<?php

namespace App\Http\Controllers;

use App\Enums\LoginProvider;
use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Support\SessionUser;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function showLoginForm(): View
    {
        if (SessionUser::check()) {
            return view('dashboard', [
                'user' => SessionUser::get(),
            ]);
        }

        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:4'],
        ]);

        // Fake login, no DB
        if (
            $credentials['email'] !== 'admin@example.com' ||
            $credentials['password'] !== '123456'
        ) {
            return back()
                ->withErrors(['email' => 'Invalid credentials.'])
                ->withInput();
        }

        SessionUser::put([
            'id' => 'USR-1001',
            'name' => 'System Admin',
            'email' => $credentials['email'],
            'role' => UserRole::Admin,
            'provider' => LoginProvider::Local,
        ]);

        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }

    public function dashboard(): View
    {
        return view('dashboard', [
            'user' => SessionUser::get(),
        ]);
    }

    public function logout(Request $request): RedirectResponse
    {
        SessionUser::logout();

        return redirect()->route('login');
    }
}