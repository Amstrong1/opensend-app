<?php

namespace App\Http\Controllers;

use App\Models\Cashout;
use App\Models\Recharge;
use App\Models\PaymentTransaction;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index()
    {
        $recharges = Recharge::where('user_id', Auth::id())->get();
        $cashouts = Cashout::where('user_id', Auth::id())->get();
        $payment_transactions = PaymentTransaction::where('user_id', Auth::id())->where('status', 'completed')->get();

        return view('history', compact('recharges', 'cashouts', 'payment_transactions'));
    }
}
