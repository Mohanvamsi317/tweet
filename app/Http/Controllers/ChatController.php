<?php

namespace App\Http\Controllers;

use id;
use App\Models\chat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller

{
public function index()
{
    $friends = User::where('id', '!=', Auth::id())->get(); // Example for fetching friends
    return view('chat', compact('friends'));
}



public function getMessages($friendId)
{
    // Get the messages for the authenticated user and the friend
    $user = Auth::user();// Get the authenticated user's ID
    $userId= $user->id;
    // print_r($userId);
    // Retrieve messages between the user and the specified friend
    $messages = Chat::where(function ($query) use ($userId, $friendId) {
        $query->where('sender_id', $userId)
              ->where('receiver_id', $friendId);
    })
    ->orWhere(function ($query) use ($userId, $friendId) {
        $query->where('sender_id', $friendId)
              ->where('receiver_id', $userId);
    })
    ->join('users', 'users.id', '=', 'chats.sender_id') // join with the users table
    ->select('chats.*', 'users.name as sender_name') 
    ->orderby('created_at')   // select chat data and sender's name
    ->get();

 
    return response()->json($messages);
}


public function send(Request $request, $friend_id)
{

    $message = new chat();
    $message->sender_id = Auth::id();
    $message->receiver_id = $friend_id;
    $message->message = $request->message;
    $message->save();

    return redirect()->route('chat.messages', $friend_id);
    // return response()->json(['status' =>200]);
}
}