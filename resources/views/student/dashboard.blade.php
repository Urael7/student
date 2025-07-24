@extends('layouts.guest')

@section('content')
<div class="p-6 max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">Leave Request</h1>

    <form method="POST" action="{{ route('student.leave.submit') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- Full Name -->
        <div>
            <label class="block mb-1 font-medium">Full Name</label>
            <input type="text" name="full_name" class="w-full border rounded px-3 py-2" required>
        </div>

        <!-- Student ID -->
        <div>
            <label class="block mb-1 font-medium">Student ID</label>
            <input type="text" name="student_id" class="w-full border rounded px-3 py-2" required>
        </div>

        <!-- Leave Type -->
        <div>
            <label class="block mb-1 font-medium">Leave Type</label>
            <input type="text" name="leave_type" class="w-full border rounded px-3 py-2" required>
        </div>

        <!-- Start Date & End Date -->
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block mb-1 font-medium">Start Date</label>
                <input type="date" name="start_date" class="w-full border rounded px-3 py-2" required>
            </div>
            <div>
                <label class="block mb-1 font-medium">End Date</label>
                <input type="date" name="end_date" class="w-full border rounded px-3 py-2" required>
            </div>
        </div>

        <!-- Reason -->
        <div>
            <label class="block mb-1 font-medium">Reason</label>
            <textarea name="reason" rows="4" class="w-full border rounded px-3 py-2" required></textarea>
        </div>

        <!-- Upload Attachment -->
        <div class="border-2 border-dashed border-gray-300 rounded p-6 text-center">
            <h3 class="font-semibold mb-2">Upload Attachment</h3>
            <p class="text-sm text-gray-500 mb-4">Drag and drop or browse to upload a file</p>
            <label class="inline-block bg-gray-100 border px-4 py-2 rounded cursor-pointer hover:bg-gray-200">
                <input type="file" name="attachment" class="hidden">
                Browse
            </label>
        </div>

        <!-- Submit Button -->
        <div class="text-right">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Submit</button>
        </div>
    </form>
</div>
@endsection
