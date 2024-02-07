<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cashout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CashoutRequest;
use RealRashid\SweetAlert\Facades\Alert;

class TransfertValidation extends Controller
{
    public function store(CashoutRequest $request)
    {
        $user = User::find(Auth::id());
        if (Hash::check($request->password, $user->password)) {
            $receiver = User::where('openid', $request->uuid)->first();

            if ($receiver !== null) {
                $cashOut = new Cashout();
                $cashOut->user_id = Auth::id();
                $cashOut->amount = $request->amount;
                $cashOut->uuid = $request->uuid;
                $cashOut->motif = $request->motif;
                $cashOut->save();

                $user->balance = $user->balance - $cashOut->amount;
                $user->save();

                $receiver->balance = $receiver->balance + $cashOut->amount;
                $receiver->save();
            }

            return redirect('done');
        } else {
            Alert::error('error', 'Mot de passe incorrect');
            return back();
        }
    }
}
