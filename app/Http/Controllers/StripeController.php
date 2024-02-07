<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Recharge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class StripeController extends Controller
{

    public function stripeSession(Request $request)
    {
        \Stripe\Stripe::setApiKey(config('stripe.sk'));        

        $url = 'https://api.exchangerate-api.com/v4/latest/USD';
        $response = file_get_contents($url);
        $data = json_decode($response, true);

        if ($data !== null) {
            $rates = $data['rates'];
        } else {
            Alert::error('Error', 'Something went wrong!');
            return back();
        }

        $productname = 'Recharge' . Auth::id();
        $totalprice = round($request->get('amount') / $rates[Auth::user()->currency]);
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
        $recharge->amount = rmtwochar(session()->get('amount'));
        $recharge->payment_method = 'stripe';
        $recharge->save();

        session()->forget('amount');

        $user = User::find(Auth::id());
        $user->balance = $user->balance + $recharge->amount;
        $user->save();
        // Alert::success('Success', 'Recharge Successful!');
        return redirect('done');
    }
}
