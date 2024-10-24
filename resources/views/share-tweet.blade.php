@extends('shared.common_nav')

@section('content')
    <!-- Form to create a new post -->
    <form action="{{ route('create-tweet') }}" method="post">
        @csrf
        <div class="tweet-box">
            <textarea placeholder="What's on your mind?" name="tweet_content"></textarea>
            @error('tweet_content')
            <span class="fs-6 text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <button type="submit" class="btn btn-success">Post</button>
        </div>
    </form>
@endsection
