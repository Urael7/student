<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LeaveRequest;

class StudentController extends Controller
{
    public function dashboard()
    {
        if (!Auth::check()) {
            return redirect('/login')->with('status', 'Please log in to access the student dashboard.');
        }

        $user = Auth::user();
        if ($user->role !== 'student') {
            return redirect('/login')->with('status', 'Unauthorized access. Only students can access this dashboard.');
        }

        return view('student.dashboard');
    }

    public function leaveRequest(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'leave_type' => 'required|string|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string',
            'attachment' => 'nullable|file|mimes:png,jpg,pdf|max:10240', 
        ]);

        $attachmentPath = $request->file('attachment') ? $request->file('attachment')->store('leave_attachments', 'public') : null;

        LeaveRequest::create([
            'user_id' => $user->id,
            'full_name' => $user->name,
            'student_id' => $user->student_id ?? $user->id,
            'leave_type' => $request->leave_type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'reason' => $request->reason,
            'attachment' => $attachmentPath,
            'status' => 'Pending',
        ]);

        return redirect()->route('student.dashboard')->with('status', 'Leave request submitted successfully!');
    }

    public function editProfile()
    {
        $user = \App\Models\User::find(Auth::id());
        if (!Auth::check() || !$user || $user->role !== 'student') {
            return redirect('/login')->with('status', 'Unauthorized access or please log in.');
        }

        return view('profile.edit', ['user' => $user]);
    }

    public function updateProfile(Request $request)
    {
        $user = \App\Models\User::find(Auth::id());
        if (!Auth::check() || !$user || $user->role !== 'student') {
            return redirect('/login')->with('status', 'Unauthorized access or please log in.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        try {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();
            return redirect()->route('profile.edit')->with('status', 'Profile updated successfully!');
        } catch (\Exception $e) {
            return redirect()->route('profile.edit')->with('status', 'Error updating profile: ' . $e->getMessage());
        }
    }
}