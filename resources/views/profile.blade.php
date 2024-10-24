@extends('shared.common_nav')

@section('content')

    <<div class="main-content">
    <h1 class="text-center">Edit Profile</h1> <!-- Center the header -->
        
        <div class="profile-container d-flex justify-content-center align-items-center flex-column" style="margin-bottom: 20px;">
            @if($user->profile_pic)
                <img src="{{ asset('storage/' . $user->profile_pic) }}" alt="Profile Picture" class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
            @else
                <img src="{{ asset('default-profile.png') }}" alt="Default Profile Picture" class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
            @endif
        </div>

        <div class="profile-container">
            <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data" id="profileForm">
                <!-- @method('PUT') -->
                @csrf
                <input type="hidden" name="id" value="{{  $user->id }}">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" disabled value="{{ old('name', $user->name) }}" >
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" disabled value="{{ old('email', $user->email) }}" >
                </div>

                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" disabled ="{{ old('phone', $user->phone) }}" >
                </div>value

                <div class="form-group">
                    <label for="profile_pic">Profile Picture</label>
                    <input type="file" class="form-control" id="profile_pic" disabled name="profile_pic" >
                </div>
                <button type="submit" id="submitButton" class="btn btn-success" style="display: none;">Update Profile</button>
            </form>
            <button type="button" id="editButton" class="btn btn-primary">Edit</button>

        </div>
        </div>

        <footer>
            <p>&copy; {{ date('Y') }} {{ config('app.name', 'Your App Name') }}</p>
        </footer>

        <script @csrf src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            document.getElementById('editButton').addEventListener('click', function() {
                const inputs = document.querySelectorAll('#profileForm input');
                inputs.forEach(input => {
                    input.disabled = false; // Enable all inputs
                });
                // Toggle button visibility
                this.style.display = 'none';
                document.getElementById('submitButton').style.display = 'block';
            });
        </script>
@endsection