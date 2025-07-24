<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentLeaveController extends Controller
{
    public function submit(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'full_name' => 'required|string|max:255',
            'student_id' => 'required|string|max:50',
            'leave_type' => 'required|string|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string',
            'attachment' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:2048',
        ]);

        // Handle optional file upload
        $filePath = null;
        if ($request->hasFile('attachment')) {
            $filePath = $request->file('attachment')->store('attachments', 'public');
        }

        // Save to database (assumes LeaveRequest model exists)
        // Uncomment the code below if you have a LeaveRequest model and migration ready

        \App\Models\LeaveRequest::create([
            'full_name' => $request->full_name,
            'student_id' => $request->student_id,
            'leave_type' => $request->leave_type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'reason' => $request->reason,
            'attachment' => $filePath,
        ]);


        return back()->with('success', 'Leave request submitted successfully.');
    }
}
