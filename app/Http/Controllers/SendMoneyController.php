<?php

namespace App\Http\Controllers;

use App\Models\Cashout;
use App\Http\Requests\CashoutRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class SendMoneyController extends Controller
{
    public function create()
    {
        return view('send');
    }

    public function store(CashoutRequest $request)
    {
        $user = User::find(Auth::id());

        if ($request->amount >= $user->balance) {
            $cashOut = new Cashout();
            $cashOut->user_id = Auth::id();
            $cashOut->amount = $request->amount;
            $cashOut->uuid = $request->uuid;
            $cashOut->motif = $request->motif;
            $cashOut->save();

            $user->balance = $user->balance - $cashOut->amount;
            $user->save();

            $receiver = User::where('uuid', $cashOut->uuid)->first();
            $receiver->balance = $receiver->balance + $cashOut->amount;
            $receiver->save();

            Alert::success('success', 'Transaction effectué');
            return redirect('dashboard');
        } else {
            Alert::error('error', 'Solde insuffisant');
            return back();
        }
    }
}
