<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NewMessageNotify;

class ChatController extends Controller
{
    public function index()
    {
        return view('chat');
    }

    public function fetchMessages()
    {
        return Message::where('user_id', Auth::user()->id)->get();
    }

    public function sendMessage(Request $request)
    {

        $user = Auth::user();

        $message = Message::create([
            'user_id' => $user->id,
            'content' => $request->input('content'),
        ]);

        $admins = User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            $admin->notify(new NewMessageNotify($user, $message));
        }

        broadcast(new \App\Events\MessageSent($user, $message))->toOthers();

        return response()->json(['status' => 'Message Sent!']);
    }
}
