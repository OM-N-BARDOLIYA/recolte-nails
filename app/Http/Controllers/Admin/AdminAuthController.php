<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check() && Auth::user()->is_admin) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => ['nullable', 'string'],
            'email' => ['nullable', 'string'],
            'password' => ['required', 'string'],
        ]);

        $loginInput = trim($request->input('login') ?? $request->input('email') ?? '');

        if (empty($loginInput)) {
            return back()->withErrors(['login' => 'Please enter your username or email address.'])->withInput();
        }

        $remember = $request->filled('remember');
        $isEmail = filter_var($loginInput, FILTER_VALIDATE_EMAIL);

        $attempt = false;
        if ($isEmail) {
            $attempt = Auth::attempt(['email' => $loginInput, 'password' => $request->password], $remember);
        } else {
            $attempt = Auth::attempt(['username' => $loginInput, 'password' => $request->password], $remember);
            if (!$attempt) {
                $attempt = Auth::attempt(['name' => $loginInput, 'password' => $request->password], $remember);
            }
            if (!$attempt) {
                $attempt = Auth::attempt(['email' => $loginInput, 'password' => $request->password], $remember);
            }
        }

        if ($attempt) {
            if (Auth::user()->is_admin) {
                $request->session()->regenerate();
                return redirect()->intended(route('admin.dashboard'))
                    ->with('success', 'Welcome back to Recolte Nails Atelier CMS!');
            }

            Auth::logout();
            return back()->withErrors(['login' => 'Access denied. You do not have administrator permissions.']);
        }

        return back()->withErrors([
            'login' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('login', 'email'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'You have been safely signed out.');
    }
}
