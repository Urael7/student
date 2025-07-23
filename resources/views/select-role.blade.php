<!DOCTYPE html>
<html>
<head>
    <title>Select Role</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        h1 {
            margin-bottom: 30px;
        }

        .button-group {
            display: flex;
            gap: 20px;
        }

        .role-btn {
            padding: 12px 24px;
            font-size: 18px;
            background-color: #3490dc;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .role-btn:hover {
            background-color: #2779bd;
        }
    </style>
</head>
<body>
    <h1>Sign in as...</h1>
    <div class="button-group">
        <a href="{{ route('login', ['role' => 'student']) }}" class="role-btn">Student Login</a>
        <a href="{{ route('login', ['role' => 'admin']) }}" class="role-btn">Admin Login</a>
        <a href="{{ route('register', ['role' => 'student']) }}" class="role-btn">Student Register</a>
    </div>
</body>
</html>
