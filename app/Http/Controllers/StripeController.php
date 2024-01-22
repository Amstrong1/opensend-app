<?php

namespace App\Http\Controllers;

use App\Models\Recharge;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class StripeController extends Controller
{

    public function session(Request $request)
    {
        \Stripe\Stripe::setApiKey(config('stripe.sk'));

        $productname = 'Recharge' . Auth::id();
        $totalprice = $request->get('amount');
        $two0 = "00";
        $total = "$totalprice$two0";

        session()->put('amount', $total);

        $session = \Stripe\Checkout\Session::create([
            'line_items'  => [
                [
                    'price_data' => [
                        'currency'     => 'USD',
                        'product_data' => [
                            "name" => $productname,
                        ],
                        'unit_amount'  => $total,
                    ],
                    'quantity'   => 1,
                ],

            ],
            'mode'        => 'payment',
            'success_url' => route('success'),
            'cancel_url'  => route('dashboard'),
        ]);

        return redirect()->away($session->url);
    }

    public function success()
    {
        $recharge = new Recharge();
        $recharge->user_id = Auth::id();
        $recharge->amount = session()->get('amount');
        $recharge->payment_method = 'stripe';
        $recharge->save();

        session()->forget('amount');

        $user = User::find(Auth::id()); 
        $user->balance = $user->balance + $recharge->amount;    
        $user->save();
        Alert::success('Success', 'Recharge Successful!');
        return redirect()->route('dashboard');
    }
}
