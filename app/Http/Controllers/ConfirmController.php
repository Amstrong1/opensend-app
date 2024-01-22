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
                Auth::login($user);
                return redirect('dashboard');
            }
        }
        return view('confirm');
    }
}
