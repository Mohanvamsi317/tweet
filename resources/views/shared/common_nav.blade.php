<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sidebar with Tweet and Reactions')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #343a40;
            padding-top: 20px;
        }
        .sidebar a, .sidebar input {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 18px;
            color: white;
            display: block;
        }
        .main-content input {
            width: 90%;
            margin: 10px;
            border: black;
            border-radius: 20px;
            padding: 8px;
            display: block;
        }
        .sidebar a:hover {
            background-color: #007bff;
            color: white;
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }
        .tweet-box {
            margin-bottom: 20px;
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .profile-info {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .profile-info img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }
        .profile-info h5 {
            margin: 0;
        }
        .tweet-box textarea {
            width: 100%;
            height: 100px;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .reactions {
            display: flex;
            justify-content: space-between;
        }
        .reactions button {
            background: none;
            border: none;
            color: #007bff;
            cursor: pointer;
            font-size: 16px;
            display: flex;
            align-items: center;
        }

        .friend-list {
        margin-left: 250px;
        padding: 20px;
    }

    .friend-card {
        display: flex;
        align-items: center;
        padding: 10px;
        background-color: #f8f9fa;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        cursor: pointer;
    }

    .friend-card img {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        margin-right: 20px;
    }

    .friend-card h5 {
        margin: 0;
        font-size: 18px;
    }

    /* Chat window styles */
    .chat-window {
        margin-left: 250px;
        padding: 20px;
        background-color: #ffffff;
        height: 100vh;
        display: flex;
        flex-direction: column;
    }

    chat-header {
        text-align: center;
        text-align: center;
        font-size: 24px;
        font-size: 24px;
        font-weight: bold;
        font-weight: bold;
        padding-bottom: 20px;
        padding: 20px;
        background-color: #007bff;
        color: white;
        position: relative;
    }
    .chat-header .close-btn {
        position: absolute;
        right: 20px;
        top: 20px;
        background-color: transparent;
        border-bottom: 1px solid #ddd;
        border: none;
        color: red;
        font-size: 18px;
        cursor: pointer;
    }

    .chat-box {
        flex-grow: 1;
        padding: 20px;
        background-color: #f8f9fa;
        overflow-y: auto;
        border-radius: 10px;
        margin-bottom: 10px;
    }

    .message {
    padding: 10px;
    border-radius: 10px;
    margin-bottom: 10px;
    max-width: 60%;
    word-wrap: break-word;
    }

    .message.friend {
        background-color: #e9ecef;
        text-align: left;
        margin-left: 0;
    }

    .message.sender {
        background-color: #007bff;
        color: white;
        text-align: right;
        margin-left: auto;
    }

    textarea {
        width: 100%;
        padding: 10px;
        border-radius: 10px;
        border: 1px solid #ced4da;
        margin-bottom: 10px;
        resize: none;
    }

    button {
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    button:hover {
        background-color: #0056b3;
    }
    body {
            font-family: Arial, sans-serif;
        }

        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #343a40;
            padding-top: 20px;
        }

        .sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 18px;
            color: white;
            display: block;
        }

        .sidebar a:hover {
            background-color: #007bff;
            color: white;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
        }

        .profile-container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
        }
    

    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="{{ route('dashboard') }}">Home</a>
        <a href="{{ route('profile') }}">Profile</a>
        <a href="{{ route('chat.index') }}">Messages</a>
        <a href="{{ route('posts') }}">My Posts</a>
        <a href="#settings">Settings</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        Logout
    </a>
    </div>

    <!-- Content section -->
    <div class="main-content">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; {{ date('Y') }} {{ config('app.name') }}</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
