@extends('layouts.guest')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">Dashboard</h1>

    <div class="grid grid-cols-4 gap-4 mb-6">
        <div class="bg-gray-100 p-4 rounded text-center">
            <p>Requests Today</p>
            <p class="text-2xl font-bold">12</p>
        </div>
        <div class="bg-gray-100 p-4 rounded text-center">
            <p>Approved This Week</p>
            <p class="text-2xl font-bold">45</p>
        </div>
        <div class="bg-gray-100 p-4 rounded text-center">
            <p>Rejected</p>
            <p class="text-2xl font-bold">8</p>
        </div>
        <div class="bg-gray-100 p-4 rounded text-center">
            <p>Pending</p>
            <p class="text-2xl font-bold">20</p>
        </div>
    </div>

    <div class="bg-gray-100 p-6 rounded mb-6">
        <h2 class="text-lg font-bold mb-2">Weekly Leave Trends</h2>
        <div class="flex justify-between text-sm text-gray-600">
            <span>Mon</span><span>Tue</span><span>Wed</span><span>Thu</span><span>Fri</span><span>Sat</span><span>Sun</span>
        </div>
        <div class="flex justify-between mt-2">
            <div class="w-10 h-16 bg-gray-300 rounded"></div>
            <div class="w-10 h-20 bg-gray-300 rounded"></div>
            <div class="w-10 h-24 bg-gray-300 rounded"></div>
            <div class="w-10 h-18 bg-gray-300 rounded"></div>
            <div class="w-10 h-22 bg-gray-300 rounded"></div>
            <div class="w-10 h-14 bg-gray-300 rounded"></div>
            <div class="w-10 h-16 bg-gray-300 rounded"></div>
        </div>
    </div>

    <div class="bg-gray-100 p-6 rounded">
        <h2 class="text-lg font-bold mb-2">Recent Requests</h2>
        <div class="space-y-4">
            <div class="flex justify-between">
                <span>Ethan Harper</span>
                <span>2024-07-26</span>
                <span class="bg-green-100 text-green-800 text-xs font-semibold px-2 py-1 rounded">Approved</span>
            </div>
            <div class="flex justify-between">
                <span>Olivia Bennett</span>
                <span>2024-07-25</span>
                <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-2 py-1 rounded">Pending</span>
            </div>
            <div class="flex justify-between">
                <span>Noah Carter</span>
                <span>2024-07-24</span>
                <span class="bg-red-100 text-red-800 text-xs font-semibold px-2 py-1 rounded">Rejected</span>
            </div>
            <div class="flex justify-between">
                <span>Ava Morgan</span>
                <span>2024-07-23</span>
                <span class="bg-green-100 text-green-800 text-xs font-semibold px-2 py-1 rounded">Approved</span>
            </div>
            <div class="flex justify-between">
                <span>Liam Foster</span>
                <span>2024-07-22</span>
                <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-2 py-1 rounded">Pending</span>
            </div>
        </div>
    </div>

    <div class="mt-6 flex justify-between">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-blue-600">Logout</button>
        </form>
        <a href="#" class="text-blue-600">Generate Report (PDF)</a>
    </div>
</div>
@endsection