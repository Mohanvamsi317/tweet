@extends('shared.common_nav')

@section('content')
<div class="friend-list">
    <h3>Friends</h3>
    @foreach($friends as $friend)
        <div class="friend-card">
            <a href="{{ route('chat.show', $friend->id) }}">
                <img src="{{ $friend->profile_image_url }}" alt="{{ $friend->name }}">
                <h5>{{ $friend->name }}</h5>
            </a>
        </div>
    @endforeach
</div>
@endsection
