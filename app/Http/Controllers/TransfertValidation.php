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
                $cashout = new Cashout();
                $cashout->user_id = Auth::id();
                $cashout->amount = $request->amount;
                $cashout->uuid = $request->uuid;
                $cashout->motif = $request->motif;
                $cashout->save();

                $user->balance = $user->balance - $cashout->amount;
                $user->save();

                $receiver->balance = $receiver->balance + $cashout->amount;
                $receiver->save();

                $message1 = [
                    'sender' => Auth::user()->name,
                    'amount' => $cashout->amount,
                ];

                $message2 = [
                    'receiver' => $receiver->name,
                    'amount' => $cashout->amount,
                ];

                $receiver->notify(new \App\Notifications\MoneyReceivedNotification($message1));
                $user->notify(new \App\Notifications\MoneySendNotification($message2));
            }

            return redirect('done');
        } else {
            Alert::error('error', 'Mot de passe incorrect');
            return back();
        }
    }
}
