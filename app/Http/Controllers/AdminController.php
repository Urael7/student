<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LeaveRequest;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        if (!Auth::check()) {
            return redirect('/login')->with('status', 'Please log in to access the admin dashboard.');
        }

        $user = Auth::user();
        if ($user->role !== 'admin') {
            return redirect('/login')->with('status', 'Unauthorized access. Only admins can access this dashboard.');
        }

        $today = Carbon::today();
        $weekStart = Carbon::now()->startOfWeek();
        $weekEnd = Carbon::now()->endOfWeek();

        $requestsToday = LeaveRequest::whereDate('created_at', $today)->count();
        $approvedThisWeek = LeaveRequest::where('status', 'Approved')
            ->whereBetween('created_at', [$weekStart, $weekEnd])
            ->count();
        $rejected = LeaveRequest::where('status', 'Rejected')->count();
        $pending = LeaveRequest::where('status', 'Pending')->count();
        $recentRequests = LeaveRequest::orderBy('created_at', 'desc')->take(5)->get();

        return view('admin.dashboard', compact('requestsToday', 'approvedThisWeek', 'rejected', 'pending', 'recentRequests'));
    }

    public function updateLeaveStatus($id, Request $request)
    {
        $request->validate([
            'status' => 'required|in:Approved,Rejected',
        ]);

        $leaveRequest = LeaveRequest::findOrFail($id);
        $leaveRequest->status = $request->status;
        $leaveRequest->save();

        return redirect()->route('admin.dashboard')->with('status', 'Leave request updated successfully!');
    }
}