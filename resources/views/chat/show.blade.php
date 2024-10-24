@extends('shared.common_nav')

@section('content')
<div class="chat-window">
    <div class="chat-header">
        <h4>Chat with {{ $currentFriend->name }}</h4>
    </div>
    <div class="chat-box" style="height: 300px; overflow-y: scroll;">
        @foreach($messages as $message)
            <div class="message {{ $message->sender_id == Auth::id() ? 'sender' : 'friend' }}">
                <strong>{{ $message->sender_id == Auth::id() ? 'You' : $currentFriend->name }}:</strong> {{ $message->message }}
            </div>
        @endforeach
    </div>

    <form method="POST" action="{{ route('chat.send', $currentFriend->id) }}">
        @csrf
        <div class="input-group">
            <textarea name="message" placeholder="Type your message..." required></textarea>
            <button type="submit" class="btn btn-primary">Send</button>
        </div>
    </form>
</div>
@endsection
