<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
                Auth::login($user);
                $user->notify(new \App\Notifications\WelcomeNotification($user));
            } else {
                $user = User::where('code', $request->code)->first();
                if ($user !== null && $user->balance == 0) {
                    $user->code = null;
                    $user->last_login = date('Y-m-d H:i:s');
                    $user->save();
                    Auth::login($user);
                    $user->notify(new \App\Notifications\WelcomeNotification($user));
                }
            }
            return redirect('dashboard');
        }
        return view('confirm');
    }
}
