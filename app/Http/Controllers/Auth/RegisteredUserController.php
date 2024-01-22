<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Mail\RegisterMailConfirm;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'tel' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'cid' => ['required', 'image', 'max:5000'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $fileName = time() . '.' . $request->cid->extension();
        $path = $request->file('cid')->storeAs('images', $fileName, 'public');
        $code = gen_code();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'tel' => $request->email,
            'address' => $request->email,
            'cid' => $path,
            'code' => $code,
            'openid' => Str::orderedUuid(),
            'password' => Hash::make($request->password),
        ]);

        $request->session()->put('code', $user->code);

        event(new Registered($user));

        Mail::to($user->email)->send(new RegisterMailConfirm($user));

        return redirect('confirm');
    }
}
