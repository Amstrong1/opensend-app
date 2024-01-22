<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TopUpController extends Controller
{
    public function index()
    {
        $public_key = "298dba30723511ec9f5205a1aca9c042";
        $private_key = "tpk_298de140723511ec9f5205a1aca9c042";
        $secret = "tsk_298de141723511ec9f5205a1aca9c042";
        $kkiapay = new \Kkiapay\Kkiapay(
            $public_key,
            $private_key,
            $secret,
            $sandbox = true
        );
        // $kkiapay->refundTransaction($transaction_id);
        return view('dashboard');
    }
}
