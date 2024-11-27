@extends('shared.common_nav')
@section('content')
    <div class="settings-container">
        <h1>Settings</h1>

        <!-- Account Settings Form -->
        <form method="post" action="{{ route('setting') }}">
            @csrf
            <div class="settings-section">
                <h2>Account Settings</h2>
                
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="{{ $user->name }}" readonly>
                
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" value="{{ $user->email }}" required>
                
                <button type="submit" class="save-button">Save Changes</button>
            </div>
        </form>

        <!-- Password Change Form -->
        <form method="post" action="{{ route('change_password', Auth::user()->id) }}">
            @csrf
            <div class="settings-section">
                <h2>Security</h2>
                
                <label for="password">New Password:</label>
                <input type="password" id="password" name="password" placeholder="New password" required>
                
                <label for="confirm-password">Confirm Password:</label>
                <input type="password" id="confirm-password" name="confirm_password" placeholder="Confirm password" required>
                
                <button type="submit" class="save-button">Update Password</button>
            </div>
        </form>

        <!-- Display Status -->
        @if(session('status'))
            <h4>{{ session('status') }}</h4>
        @endif
    </div>
@endsection
