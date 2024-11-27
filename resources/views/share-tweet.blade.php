@extends('shared.common_nav')

@section('content')
    <!-- Form to create a new post -->
    <form action="{{ route('create-tweet') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="tweet-box">
            <textarea placeholder="What's on your mind?" name="tweet_content"></textarea>
            @error('tweet_content')
            <span class="fs-6 text-danger">{{ $message }}</span>
            @enderror
            <div class="form-group">
                <input type="file" class ="form-control" id="media" name="media" accept="image/*,video/*">
            </div>
            <div>
            <button type="submit" class="btn btn-success">Post</button>
        </div>
        </div>
        
    </form>
@endsection
