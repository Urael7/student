@extends('layouts.guest')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md p-6 bg-white rounded shadow">
        <h2 class="text-xl text-center text-gray-900">Register Student</h2>

        @if (session('status'))
            <p class="text-sm text-green-600 text-center mt-2">{{ session('status') }}</p>
        @endif

        <form method="POST" action="{{ route('register.post') }}" class="mt-4 space-y-4">
            @csrf

            <div>
                <label for="name" class="text-sm text-gray-700">Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required 
                       class="w-full p-2 border rounded">
                @error('name')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @endif
            </div>

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

            <button type="submit" class="w-full p-2 bg-indigo-600 text-white rounded">Register</button>
        </form>
    </div>
</div>
@endsection