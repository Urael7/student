@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex items-center mb-6">
                    <a href="{{ route('student.dashboard') }}" class="mr-4">
                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </a>
                    <h1 class="text-2xl font-bold">Student Dashboard</h1>
                </div>

                @if (session('status'))
                    <p class="text-sm text-green-600 text-center mt-2">{{ session('status') }}</p>
                @endif

                @if (!Auth::check() || !Auth::user()->role)
                    <p class="text-sm text-red-600 text-center mt-2">Error: User not authenticated or role not set. Please log in again.</p>
                @else
                    <div class="mt-6">
                        <h2 class="text-xl font-semibold mb-6 text-center">Leave Request</h2>

                        <form action="{{ route('student.leave.request') }}" method="POST" class="max-w-md mx-auto space-y-6 p-6 border border-gray-200 rounded-lg shadow-sm">
                            @csrf

                            <div>
                                <label for="full_name" class="block text-sm font-medium text-gray-700">Full Name</label>
                                <input type="text" name="full_name" id="full_name" value="{{ Auth::user()->name ?? '' }}" class="mt-1 block w-full border-gray-300 rounded-full shadow-sm p-2" required readonly>
                            </div>

                            <div>
                                <label for="student_id" class="block text-sm font-medium text-gray-700">Student ID</label>
                                <input type="text" name="student_id" id="student_id" value="{{ Auth::user()->id ?? '' }}" class="mt-1 block w-full border-gray-300 rounded-full shadow-sm p-2" required readonly>
                            </div>

                            <div>
                                <label for="leave_type" class="block text-sm font-medium text-gray-700">Leave Type</label>
                                <input type="text" name="leave_type" id="leave_type" class="mt-1 block w-full border-gray-300 rounded-full shadow-sm p-2" required>
                            </div>

                            <div class="flex space-x-4">
                                <div class="w-1/2">
                                    <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                                    <input type="date" name="start_date" id="start_date" class="mt-1 block w-full border-gray-300 rounded-full shadow-sm p-2" required>
                                </div>
                                <div class="w-1/2">
                                    <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                                    <input type="date" name="end_date" id="end_date" class="mt-1 block w-full border-gray-300 rounded-full shadow-sm p-2" required>
                                </div>
                            </div>

                            <div>
                                <label for="reason" class="block text-sm font-medium text-gray-700">Reason</label>
                                <textarea name="reason" id="reason" rows="4" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm p-2" required></textarea>
                            </div>

                            <div>
                                <label for="attachment" class="block text-sm font-medium text-gray-700">Upload Attachment</label>
                                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-dashed border-gray-300 rounded-lg">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                            <path d="M28 8H12a4 4 0 00-4 4v24a4 4 0 004 4h24a4 4 0 004-4V16l-12-12zM12 6h16l12 12v20a2 2 0 01-2 2H12a2 2 0 01-2-2V10a2 2 0 012-2zm12 26V18h-8v14h8zm2 0h8V20h-8v12zm-2-14a2 2 0 11-4 0 2 2 0 014 0z" stroke-width="2" />
                                        </svg>
                                        <div class="flex text-sm text-gray-600">
                                            <label for="attachment" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                <span>Browse</span>
                                                <input id="attachment" name="attachment" type="file" class="sr-only">
                                            </label>
                                            <p class="pl-1">or drag and drop</p>
                                        </div>
                                        <p class="text-xs text-gray-500">PNG, JPG, PDF up to 10MB</p>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-full text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Submit
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection