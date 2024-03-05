<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Interac;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreInteracRequest;
use App\Notifications\NewInteracNotification;

class ConfirmInteracController extends Controller
{
    public function store(StoreInteracRequest $request)
    {
        $interac = new Interac();
        $interac->user_id = Auth::id();
        $interac->amount = $request->amount;
        $interac->name = $request->name;
        $interac->tel = $request->tel;
        $interac->bank = $request->bank;
        $interac->email = $request->email;
        $interac->country = $request->country;
        $interac->type = $request->type;
        $interac->save();

        $user = User::find(Auth::id());
        $user->balance = $user->balance - $interac->amount;
        $user->save();

        $admins = User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            $admin->notify(new NewInteracNotification($interac));
        }

        return redirect('done');
    }
}
