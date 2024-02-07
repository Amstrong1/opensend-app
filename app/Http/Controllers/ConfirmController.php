<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ConfirmController extends Controller
{
    public function index(Request $request)
    {
        if (request()->method() === 'POST') {
            if ($request->code == session('code')) {
                $user = User::where('code', $request->code)->first();
                $user->code = null;
                $user->last_login = date('Y-m-d H:i:s');
                $user->save();
                $user->notify(new \App\Notifications\WelcomeNotification($user));

                return redirect('dashboard');
            }
        }
        return view('confirm');
    }
}
