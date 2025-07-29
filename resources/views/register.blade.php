@extends('layouts.guest')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md p-6 bg-white rounded shadow">
        <h2 class="text-xl text-center text-gray-900">Register Student</h2>

        <form method="POST" action="{{ route('register.post') }}" class="mt-4 space-y-4">
            @csrf

            <div>
                @if ($errors->any())
    @foreach ($errors->all() as $error)
        <div style="border: 1px solid red; background-color: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 10px; border-radius: 4px; position: relative;">
            <strong>ማስተንቀቂያ!</strong> {{ $error }}.

            <button 
                type="button" 
                onclick="this.parentElement.style.display='none'" 
                style="position: absolute; top: 5px; right: 8px; background: none; border: none; font-weight: bold; color: #721c24; cursor: pointer;"
                aria-label="Close"
            >
                &times;
            </button>
        </div>
    @endforeach
@endif



                <label for="name" class="text-sm text-gray-700">Full Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}"  
                       class="w-full p-2 border rounded">

                
            </div>

            <div>
                <label for="email" class="text-sm text-gray-700">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}"  
                       class="w-full p-2 border rounded">
            </div>

            <div>
                <label for="password" class="text-sm text-gray-700">Password</label>
                <input id="password" type="password" name="password"  
                       class="w-full p-2 border rounded">
            </div>

            <button type="submit" class="w-full p-2 bg-indigo-600 text-white rounded">Register</button>
        </form>
    </div>
</div>
@endsection