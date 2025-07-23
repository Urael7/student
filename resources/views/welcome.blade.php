<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f3f4f6;
        }
        .button-container {
            text-align: center;
        }
        .welcome-text {
            font-size: 1.5em;
            margin-bottom: 20px;
            color: #333;
        }
        .button {
            display: block;
            padding: 10px 20px;
            margin: 10px 0;
            background: #4B5EAA;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="button-container">
        <div class="welcome-text">Sign in as ...</div>
        <a href="/login?role=admin" class="button">Admin Login</a>
        <a href="/login?role=student" class="button">Student Login</a>
        <a href="/register" class="button">Register Student</a>
    </div>
</body>
</html>