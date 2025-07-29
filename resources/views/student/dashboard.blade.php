@extends('layouts.guest')

@section('content')
<div class="p-6 max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">Leave Request</h1>

    @if (session('status'))
        <div class="bg-green-100 text-green-800 p-4 rounded mb-6">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('student.leave.request') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div>
            <label class="block mb-1 font-medium">Full Name</label>
            <input type="text" name="full_name" value="{{ old('full_name', Auth::user()->name) }}" class="w-full border rounded px-3 py-2" readonly>
            @error('full_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block mb-1 font-medium">Registration ID</label>
            <input type="text" name="student_id" value="{{ old('student_id', Auth::user()->student_id ?? Auth::user()->id) }}" class="w-full border rounded px-3 py-2" readonly>
            @error('student_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block mb-1 font-medium">Leave Type</label>
            <input type="text" name="leave_type" value="{{ old('leave_type') }}" class="w-full border rounded px-3 py-2" required>
            @error('leave_type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block mb-1 font-medium">Start Date</label>
                <input type="date" name="start_date" value="{{ old('start_date') }}" class="w-full border rounded px-3 py-2" required>
                @error('start_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block mb-1 font-medium">End Date</label>
                <input type="date" name="end_date" value="{{ old('end_date') }}" class="w-full border rounded px-3 py-2" required>
                @error('end_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <div>
            <label class="block mb-1 font-medium">Reason (along with your student ID)</label>
            <textarea name="reason" rows="4" class="w-full border rounded px-3 py-2" required>{{ old('reason') }}</textarea>
            @error('reason') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="border-2 border-dashed border-gray-300 rounded p-6 text-center">
            <h3 class="font-semibold mb-2">Upload Attachment</h3>
            <p class="text-sm text-gray-500 mb-4">Drag and drop or browse to upload a file (PNG, JPG, PDF, max 10MB)</p>
            <label class="inline-block bg-gray-100 border px-4 py-2 rounded cursor-pointer hover:bg-gray-200">
                <input type="file" name="attachment" class="hidden" accept=".png,.jpg,.pdf">
                Browse
            </label>
            @error('attachment') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="text-right">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Submit</button>
        </div>
    </form>

    <div class="mt-6 flex justify-end">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-blue-600">Logout</button>
        </form>
    </div>
</div>
@endsection