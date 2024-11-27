<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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

.container {
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

input[type="email"],
input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
}

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
</style>
</head>
<body>
    <div class="container">
        <!-- Login Section -->
        <h2>Login</h2>
        <form method="Post" id="loginForm" action="{{ route('login.submit') }}">
            @csrf
            <div>
        <input type="email" name="email" placeholder="Email" required>
       
         </div>
    <div>
        <input type="password" name="password" placeholder="Password" required>
        
    </div>
    <button type="submit">Login</button>
        <div>
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
                @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
        </div>
        </form>
        <div style="display: grid;">
        <a href="{{ route('reg') }}">Register</a>
        <a href="{{ route('password.request') }}">Forgot your password?</a>
        </div>
    </div>
</body>
</html>
