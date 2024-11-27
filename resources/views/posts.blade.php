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
            <div>
                <!-- Button Container -->
                <div style="display: flex;">
                    <div style="margin-right:5px;">    
                        <a href="{{ route('tweet-view.show', $idea->id) }}" class="btn btn-primary btn-sm">View</a>
                    </div>
                    <div style="margin-right:5px;">
                        <form method="post" action="{{ route('dashboard.destroy', $idea->id) }}">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </div>
                    <div>    
                        <form method="post" action="">
                            <!-- @csrf
                            @method('edit') -->
                            <button class="btn btn-secondary btn-sm">Edit</button>
                        </form>
                    </div>    
                </div>
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
