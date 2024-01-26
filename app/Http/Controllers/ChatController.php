<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        return view('chat');
    }

    public function fetchMessages()
    {
        return Message::with('user')->get();
    }

    public function sendMessage(Request $request)
    {

        //dd($request->all());
        $user = Auth::user();

        $message = Message::create([
            'user_id' => $user->id,
            'content' => $request->input('content'),
        ]);

        broadcast(new \App\Events\MessageSent($user, $message))->toOthers();

        return response()->json(['status' => 'Message Sent!']);
    }
}
