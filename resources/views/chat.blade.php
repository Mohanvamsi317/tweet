@extends('shared.common_nav')

@section('content')
<div class="friend-list" id="friendList">
    <h3>Friends</h3>
    @foreach($friends as $friend)
        <div class="friend-card" onclick="openChat('{{ $friend->id }}', '{{ $friend->name }}')"> <!-- Pass both ID and name -->
            <img src="{{ $friend->profile_image_url }}" alt="{{ $friend->name }}">
            <h5>{{ $friend->name }}</h5>
        </div>
    @endforeach
</div>

<!-- Fullscreen Chat Window Section -->
<div class="chat-window" id="chatWindow" style="display: none;">
    <div class="chat-header">
        <h4 id="chatFriendName">Chat with </h4> <!-- Add an ID here -->
        <button onclick="closeChat()" class="close-btn">Close</button>
    </div>
    <div class="chat-box" id="chatBox">
        <!-- Chat content will be dynamically loaded here -->
    </div>
    <textarea id="chatInput" placeholder="Type your message..."></textarea>
    <button onclick="sendMessage()">Send</button>
</div>

<script>
    let currentUserId = '{{ auth()->id() }}'; // Store the current user's ID
    let currentFriendId = null; // Store the current friend's ID
    function closeChat() {
        // Hide the chat window and show the friend list again
        document.getElementById('chatWindow').style.display = 'none';
        document.getElementById('friendList').style.display = 'block';
    }

    function openChat(friendId, friendName) {
        // Hide the friend list
        document.getElementById('friendList').style.display = 'none';

        // Show the chat window
        document.getElementById('chatWindow').style.display = 'block';

        // Set the friend's name in the chat window
        document.getElementById('chatFriendName').textContent = `Chat with ${friendName}`;

        // Set the current friend ID
        currentFriendId = friendId;
        console.log(currentFriendId);
        console.log(currentUserId);

        // Clear and load chat messages (placeholder for real chat data)
        loadChatMessages(currentFriendId);
    }

    function loadChatMessages(friendId) {
        // Clear previous messages
        document.getElementById('chatBox').innerHTML = '';

        // Fetch messages from the server
        fetch(`/chat/${friendId}/messages`)
            .then(response => response.json())
            .then(messages => {
                // Iterate over the messages and display them
                messages.forEach(message => {
                    let messageElement = document.createElement('div');
                    console.log("hello",message.sender_id);
                    // Check if the message was sent by the current user (sender) or friend (receiver)
                    if (message.sender_id == currentUserId) {
                        messageElement.classList.add('message', 'sender'); // Sent by current user
                        messageElement.textContent = `You: ${message.message}`;
                    } else {
                        messageElement.classList.add('message', 'friend'); // Sent by friend
                        messageElement.textContent = `${message.sender_name}: ${message.message}`;
                    }

                    // Append the message to the chat box
                    document.getElementById('chatBox').appendChild(messageElement);
                });
            })
            .catch(error => console.error('Error fetching messages:', error));
    }

    function sendMessage() {
        // Get the message input value
        let message = document.getElementById('chatInput').value;

        if (message.trim() !== "") {
            // Create the sender's message element
            let messageElement = document.createElement('div');
            messageElement.classList.add('message', 'sender'); // Sender's message
            messageElement.textContent = `You: ${message}`;
            document.getElementById('chatBox').appendChild(messageElement);

            // Clear the input
            document.getElementById('chatInput').value = '';

            // Send the message to the server
            fetch(`/chat/${currentFriendId}/send`, {
                method: 'POST',
                body: JSON.stringify({ message }), // Send message as JSON
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include CSRF token for security
                }
            })
            .then(response => response.json())
            .then(data => console.log(data)) // Handle response (optional)
            .catch(error => console.error('Error sending message:', error));
        }
    }
</script>
@endsection
