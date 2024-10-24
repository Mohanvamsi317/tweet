@extends('shared.common_nav')


@section('content')

    <!-- Tweet Ideas Display -->
     @foreach($ideas as $idea)
    <div class="tweet-box">
        <div style="display: flex; justify-content: space-between;">
            <div class="profile-info">
                <img src="https://via.placeholder.com/40" alt="Profile">
                <h5>{{ $idea->name }}</h5>
            </div>
            <div style="display:flex">
                    <a href="{{ route('tweet-view.show',$idea->id) }}">view</a>
                    <form method="post" action="{{ route('dashboard.destroy', $idea->id) }}">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger btn-sm">delete post</button>
                    </form>
                    
                </div>
        
        </div>    
        <textarea readonly>{{ $idea->content }}</textarea>
        <div class="reactions">
            <button><i class="ri-thumb-up-line"></i> Like {{ $idea->likes }}</button>
            <button><i class="ri-chat-3-line"></i> Comment {{ $idea->comments }}</button>
            <button><i class="ri-share-forward-line"></i> Share {{ $idea->shares }}</button>
        </div>
    </div>
    @endforeach
@endsection
