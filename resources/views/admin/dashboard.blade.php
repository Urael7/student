@extends('layouts.guest')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">Dashboard</h1>

    <div class="grid grid-cols-4 gap-4 mb-6">
        <div class="bg-gray-100 p-4 rounded text-center">
            <p>Requests Today</p>
            <p class="text-2xl font-bold">{{ $requestsToday }}</p>
        </div>
        <div class="bg-gray-100 p-4 rounded text-center">
            <p>Approved This Week</p>
            <p class="text-2xl font-bold">{{ $approvedThisWeek }}</p>
        </div>
        <div class="bg-gray-100 p-4 rounded text-center">
            <p>Rejected</p>
            <p class="text-2xl font-bold">{{ $rejected }}</p>
        </div>
        <div class="bg-gray-100 p-4 rounded text-center">
            <p>Pending</p>
            <p class="text-2xl font-bold">{{ $pending }}</p>
        </div>
    </div>

    <div class="bg-gray-100 p-6 rounded mb-6">
        <h2 class="text-lg font-bold mb-2">Weekly Leave Trends</h2>
        <div class="flex justify-between text-sm text-gray-600">
            <span>Mon</span><span>Tue</span><span>Wed</span><span>Thu</span><span>Fri</span><span>Sat</span><span>Sun</span>
        </div>
        <div class="flex justify-between mt-2">
            @php
                use App\Models\LeaveRequest;
                $weekCounts = [];
                for ($i = 0; $i < 7; $i++) {
                    $date = Carbon\Carbon::now()->startOfWeek()->addDays($i);
                    $weekCounts[$i] = LeaveRequest::whereDate('created_at', $date)->count();
                }
            @endphp
            <div class="w-10 h-{{ $weekCounts[0] * 2 }} bg-gray-300 rounded" style="height: {{ max(10, $weekCounts[0] * 2) }}px;"></div>
            <div class="w-10 h-{{ $weekCounts[1] * 2 }} bg-gray-300 rounded" style="height: {{ max(10, $weekCounts[1] * 2) }}px;"></div>
            <div class="w-10 h-{{ $weekCounts[2] * 2 }} bg-gray-300 rounded" style="height: {{ max(10, $weekCounts[2] * 2) }}px;"></div>
            <div class="w-10 h-{{ $weekCounts[3] * 2 }} bg-gray-300 rounded" style="height: {{ max(10, $weekCounts[3] * 2) }}px;"></div>
            <div class="w-10 h-{{ $weekCounts[4] * 2 }} bg-gray-300 rounded" style="height: {{ max(10, $weekCounts[4] * 2) }}px;"></div>
            <div class="w-10 h-{{ $weekCounts[5] * 2 }} bg-gray-300 rounded" style="height: {{ max(10, $weekCounts[5] * 2) }}px;"></div>
            <div class="w-10 h-{{ $weekCounts[6] * 2 }} bg-gray-300 rounded" style="height: {{ max(10, $weekCounts[6] * 2) }}px;"></div>
        </div>
    </div>

    <div class="bg-gray-100 p-6 rounded">
        <h2 class="text-lg font-bold mb-2">Recent Requests</h2>
        <div class="space-y-4">
            @foreach ($recentRequests as $request)
                <div class="flex justify-between items-center">
                    <span>{{ $request->full_name }}</span>
                    <span>{{ $request->created_at->format('Y-m-d') }}</span>
                    <span class="{{ $request->status === 'Approved' ? 'bg-green-100 text-green-800' : ($request->status === 'Rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }} text-xs font-semibold px-2 py-1 rounded">
                        {{ $request->status }}
                    </span>
                    <div>
                        <button onclick="document.getElementById('info-{{ $request->id }}').classList.toggle('hidden')" class="text-blue-600 text-xs mr-2">Full Information</button>
                        @if ($request->attachment)
                            <a href="{{ asset('storage/' . $request->attachment) }}" class="text-blue-600 text-xs mr-2" target="_blank">View Attachment</a>
                        @else
                            <span class="text-gray-500 text-xs mr-2">No Attachment</span>
                        @endif
                        @if ($request->status === 'Pending')
                            <form action="{{ route('admin.leave.update', $request->id) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" name="status" value="Approved" class="bg-green-600 text-white text-xs px-2 py-1 rounded mr-1 hover:bg-green-700">Accept</button>
                                <button type="submit" name="status" value="Rejected" class="bg-red-600 text-white text-xs px-2 py-1 rounded hover:bg-red-700">Reject</button>
                            </form>
                        @endif
                        <div id="info-{{ $request->id }}" class="hidden mt-2 p-2 bg-white border rounded text-sm">
                            <p><strong>Full Name:</strong> {{ $request->full_name }}</p>
                            <p><strong>Student ID:</strong> {{ $request->student_id }}</p>
                            <p><strong>Leave Type:</strong> {{ $request->leave_type }}</p>
                            <p><strong>Start Date:</strong> {{ $request->start_date }}</p>
                            <p><strong>End Date:</strong> {{ $request->end_date }}</p>
                            <p><strong>Reason:</strong> {{ $request->reason }}</p>
                            <p><strong>Attachment:</strong> {{ $request->attachment ? 'Yes' : 'No' }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="mt-6 flex justify-between">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-blue-600">Logout</button>
        </form>
    </div>
</div>
@endsection