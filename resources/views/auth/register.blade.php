<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register & Login Demo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Container */
        .container {
            display: flex;
            flex-direction: column;
            gap: 20px;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        /* Input Fields */
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        /* Button */
        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049;
        }

        /* Link */
        a {
            display: inline-block;
            margin-top: 10px;
            color: #4CAF50;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s;
        }

        a:hover {
            color: #45a049;
        }
        .error{
            font-size: 10px;
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Registration Section -->
        <div id="registerSection">
            <h2>Register</h2>
            <form method="POST" id="registerForm"  action="{{ route('register.submit') }}">
                @csrf <!-- CSRF Token for security -->
                <input type="text" name="username" placeholder="Username" >
                @error('username')
                    <div class="error">{{ $message }}</div>
                @enderror
                <input type="email" name="email" placeholder="Email" >
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
                <input type="password" name="password" placeholder="Password" >
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
                <input type="password" name="password_confirmation" placeholder="Confirm Password" >
                @error('password_confirmation')
                    <div class="error">{{ $message }}</div>
                @enderror
                <button type="submit">Register</button>
            </form>
            <a href="{{ route('login') }}">Already registered? Login here</a>
        </div>
    </div>
</body>
</html>
