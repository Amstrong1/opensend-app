<?php

namespace App\Http\Controllers;

use App\Models\Cashout;
use App\Models\PaymentTransaction;
use App\Models\Recharge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index()
    {
        $recharges = Recharge::where('user_id', Auth::id())->get();
        $cashouts = Cashout::where('user_id', Auth::id())->get();
        $payment_transactions = PaymentTransaction::where('user_id', Auth::id())->where('status', 'completed')->get();

        // $transactions = $recharge->merge($cashout, $payment_transaction);

        // $sortedTransactions = $transactions->sortByDesc('created_at');
        return view('history', compact('recharges','cashouts','payment_transactions' ));
    }
}
