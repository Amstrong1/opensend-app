<?php

namespace App\Http\Controllers;

use App\Http\Requests\CashoutRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class SendMoneyController extends Controller
{
    public function create()
    {
        return view('send');
    }

    public function store(CashoutRequest $request)
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
            $receiver = User::where('openid', $request->uuid)->first();
            if ($receiver !== null) {
                $transfert = new EloquentCollection();
                $transfert->push([
                    'amount' => $amount,
                    'uuid' => $request->uuid,
                    'motif' => $request->motif,
                    'receiver' => $receiver->name
                ]);
                $transfert = $transfert->collapse();
                return view('confirm-transfert', compact('transfert'));
            } else {
                Alert::error('error', 'Destinataire introuvable');
                return back();
            }
        } else {
            Alert::error('error', 'Solde insuffisant');
            return back();
        }
    }
}
