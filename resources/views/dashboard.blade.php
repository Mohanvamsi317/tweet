@extends('shared.common_nav')

@section('content')
    <!-- Success Message -->
    @include('Success-message')

    <div style="display: flex; align-items: center; justify-content: space-between;">
        <div>
            <input type="text" placeholder="Search...">
        </div>
        <div>
            <a href="{{ route('share-tweet') }}" class="btn btn-primary">New post</a>
        </div>
    </div>

    <!-- Tweet Ideas Display -->
    @foreach($ideas as $idea)
    <div class="tweet-box">
        <div style="display: flex; justify-content: space-between;">
            <div class="profile-info">
                <img src="{{ asset('storage/' . $idea->profile_pic) }}" alt="Profile" style="border-radius: 50%; width: 40px; height: 40px;">
                <h5>{{ $idea->name }}</h5>
            </div>
            <div style="display: flex;">
                <a href="{{ route('tweet-view.show', $idea->id) }}">view</a>
            </div>
        </div>    
        <textarea readonly>{{ $idea->content }}</textarea>

        @if($idea->media_type)
            <div class="media-container">
                @if(Str::contains($idea->media_type, ['.jpg', '.jpeg', '.png', '.gif']))
                    <img src="{{ asset('storage/' . $idea->media_type) }}" class="tweet-media" alt="Tweet Media">
                @elseif(Str::contains($idea->media_type, ['.mp4', '.mov', '.avi']))
                    <video controls class="tweet-media">
                        <source src="{{ asset('storage/' . $idea->media_type) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                @endif
            </div>
        @endif

        <div class="reactions">
            <button onclick="updatelike('{{ $idea->id }}')">
                <i class="ri-thumb-up-line"></i> Like 
                <span id="like-count-{{ $idea->id }}">{{ $idea->likes }}</span>
            </button>
            <button><i class="ri-chat-3-line"></i> Comment {{ $idea->comments }}</button>
            <button><i class="ri-share-forward-line"></i> Share {{ $idea->shares }}</button>
        </div>
    </div>
    @endforeach

@endsection

<script>
    // Get the current authenticated user ID
    let current_user = '{{ auth()->id() }}';

    // Function to update likes
    function updatelike(postId) {
        console.log(postId);
        fetch(`/updatelike/${current_user}/${postId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            // Update the like count dynamically in the DOM
            console.log(data);
            document.getElementById('like-count-' + postId).textContent = data.likes;
        });
    }
</script>
<style>
    .tweet-box {
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px;
        margin-bottom: 20px;
        max-width: 600px; /* Adjust based on layout requirements */
        margin: 0 auto; /* Center align */
    }

    .media-container {
        margin-top: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
        border-radius: 10px;
        max-height: 500px; /* Optional: limits the max height */
    }

    .tweet-media {
        width: 100%;
        height: auto;
        object-fit: cover;
        border-radius: 10px;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .tweet-box {
            width: 90%;
        }
    }

    @media (max-width: 480px) {
        .tweet-box {
            width: 100%;
        }
    }
</style>
