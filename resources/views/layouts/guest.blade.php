<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'My App')</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
    </style>
</head>
<body>
    @yield('content')
</body>
</html>