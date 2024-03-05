<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\PaymentTransaction;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

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

            if ($request->payment_method !== 'interac') {
                $user->balance = $user->balance - $amount;
                $user->save();
            }

            if ($request->payment_method == 'interac') {
                $interac = new EloquentCollection();
                $interac->push([
                    'tel' => $request->tel,
                    'name' => $request->name,
                    'bank' => $request->bank,
                    'email' => $request->email,
                    'amount' => $request->amount,
                    'country' => $request->country,
                    'type' => $request->type,
                ]);
                $interac = $interac->collapse();
                return view('confirm-interac', compact('interac'));
            }

            return redirect('done');
        } else {
            Alert::error('error', 'Solde insuffisant');
            return back();
        }
    }
}
