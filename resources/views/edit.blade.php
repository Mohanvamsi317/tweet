@extends('shared.common_nav')

@section('content')
<div class="container">
    <div style="align-items:center">
        @if($user->profile_pic)
            <img src="{{ asset('storage/profile_pics/' . $user->profile_pic) }}" alt="Profile Picture" width="150">
        @else
            <img src="{{ asset('default-profile.png') }}" alt="Default Profile Picture" width="150">
        @endif
    </div>

    <h1>Edit Profile</h1>


    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Name -->
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>

        <!-- Email -->
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>

        <!-- Profile Picture -->
        <div class="form-group">
            <label for="profile_pic">Profile Picture:</label>
            <input type="file" name="profile_pic" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update Profile</button>
    </form>
</div>
@endsection

