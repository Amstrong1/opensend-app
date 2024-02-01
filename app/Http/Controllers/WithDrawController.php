<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\PaymentTransaction;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class WithDrawController extends Controller
{
    public function create()
    {
        return view('withdraw');
    }

    public function store(Request $request)
    {
        $user = User::find(Auth::id());

        if ($request->amount >= $user->balance) {
            $paymentTransaction = new PaymentTransaction();
            $paymentTransaction->user_id = Auth::id();
            $paymentTransaction->amount = $request->amount;
            $paymentTransaction->currency = $request->currency;
            $paymentTransaction->destination = $request->destination;
            $paymentTransaction->transfer_group = 'withdraw';
            $paymentTransaction->status = 'pending';
            $paymentTransaction->save();

            // Alert::success('success', 'Votre requete est en cours d\'execution');
            return redirect('done');
        } else {
            Alert::error('error', 'Solde insuffisant');
            return back();
        }
    }
}
