<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'My App')</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
    </style>
</head>
<body>
    @yield('content')
</body>
</html>