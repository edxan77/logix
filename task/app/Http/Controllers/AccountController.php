<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function index()
    {
        $authUser = Auth::user();
        return view('account_page.account')->with(['user' => $authUser]);
    }
}
