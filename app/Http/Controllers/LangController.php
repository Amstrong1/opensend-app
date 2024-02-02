<?php

namespace App\Http\Controllers;

use App\Models\UserLang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LangController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->locale !== null) {
            $userLang = UserLang::where('user_id', Auth::user()->id)->first();
            $userLang->lang = $request->lang;
        } else {
            $userLang = new UserLang();
            $userLang->user_id = Auth::user()->id;
            $userLang->lang = $request->lang;
        }

        $userLang->save();
        return back();
    }
}
