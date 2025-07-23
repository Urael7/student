<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $intendedRole = $request->input('role');
        $user = Auth::user();
        if ($intendedRole && $user->role !== $intendedRole) {
            Auth::logout();
            return back()->withErrors(['email' => 'You do not have access as ' . $intendedRole . '.']);
        }
        $role = $user->role;
        if ($role === 'admin') {
            return redirect('/admin/dashboard');
        } elseif ($role === 'student') {
            return redirect('/student/dashboard');
        } else {
            return redirect('/'); 
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
