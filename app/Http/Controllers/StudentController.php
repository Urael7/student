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
        // Ensure user is authenticated
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
        $request->validate([
            'full_name' => 'required|string|max:255',
            'student_id' => 'required|string|max:20',
            'leave_type' => 'required|string|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string',
            'attachment' => 'nullable|file|mimes:png,jpg,pdf|max:10240', 
        ]);

        $attachmentPath = $request->file('attachment') ? $request->file('attachment')->store('leave_attachments', 'public') : null;

        LeaveRequest::create([
            'user_id' => Auth::id(),
            'full_name' => $request->full_name,
            'student_id' => $request->student_id,
            'leave_type' => $request->leave_type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'reason' => $request->reason,
            'attachment' => $attachmentPath,
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