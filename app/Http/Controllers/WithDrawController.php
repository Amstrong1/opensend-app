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

        $url = 'https://api.exchangerate-api.com/v4/latest/USD';
        $response = file_get_contents($url);
        $data = json_decode($response, true);

        if ($data !== null) {
            $rates = $data['rates'];
        } else {
            Alert::error('Error', 'Something went wrong!');
            return back();
        }

        $amount = round($request->get('amount') / $rates[Auth::user()->currency]);
        
        if ($amount <= $user->balance) {
            $paymentTransaction = new PaymentTransaction();
            $paymentTransaction->user_id = Auth::id();
            $paymentTransaction->amount = $amount;
            $paymentTransaction->payment_method = $request->payment_method;
            $paymentTransaction->destination = $request->destination;
            $paymentTransaction->transfer_group = 'withdraw';
            $paymentTransaction->status = 'pending';
            $paymentTransaction->save();

            return redirect('done');
        } else {
            Alert::error('error', 'Solde insuffisant');
            return back();
        }
    }
}
