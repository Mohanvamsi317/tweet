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
                <img src="{{ asset('storage/' . $idea->profile_pic) }}" alt="Profile">
                <h5>{{ $idea->name }}</h5>
            </div>
            <div style="display:flex">
                <a href="{{ route('tweet-view.show', $idea->id) }}">view</a>
            </div>
        </div>    
        <textarea readonly>{{ $idea->content }}</textarea>
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
        })
      
    }
</script>

