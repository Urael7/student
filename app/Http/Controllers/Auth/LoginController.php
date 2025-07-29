<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function showLoginForm(Request $request)
    {
        $role = $request->query('role', 'student');
        return view('auth.login', ['role' => $role]);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $role = $request->input('role', 'student'); 

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            Log::info('Login successful', ['user_id' => $user->id, 'role' => $user->role]); 
            if ($role === 'admin' && $user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($role === 'student' && $user->role === 'student') {
                return redirect()->route('student.dashboard');
            }
            return redirect()->back()->withErrors(['role' => 'Unauthorized access for this role.']);
        }

        Log::warning('Login failed', ['email' => $request->email]); 
        return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function dashboard()
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return view('admin.dashboard');
        }
        return redirect('/login')->with('status', 'Unauthorized access.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
}