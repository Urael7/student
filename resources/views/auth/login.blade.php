@extends('layouts.guest')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md p-6 bg-white rounded shadow">
        <h2 class="text-xl text-center text-gray-900">Login</h2>
        
        @if (session('status'))
            <p class="text-sm text-green-600 text-center mt-2">{{ session('status') }}</p>
        @endif

        @if (session('error'))
            <p class="text-sm text-red-600 text-center mt-2">{{ session('error') }}</p>
        @endif

        <form method="POST" action="{{ route('login.post') }}" class="mt-4 space-y-4">
            @csrf
            <input type="hidden" name="role" value="{{ $role ?? 'student' }}">

            <div>
                <label for="email" class="text-sm text-gray-700">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required 
                       class="w-full p-2 border rounded">
                @error('email')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @endif
            </div>

            <div>
                <label for="password" class="text-sm text-gray-700">Password</label>
                <input id="password" type="password" name="password" required 
                       class="w-full p-2 border rounded">
                @error('password')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @endif
            </div>

            <button type="submit" class="w-full p-2 bg-indigo-600 text-white rounded">Log in</button>
        </form>

        <div class="mt-4 text-center">
            <a href="{{ route('login.admin') }}" class="text-blue-600">Login as Admin</a>
            <span class="mx-2">|</span>
            <a href="{{ route('login.student') }}" class="text-blue-600">Login as Student</a>
        </div>
    </div>
</div>
@endsection