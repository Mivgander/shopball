<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    function main()
    {
        session(['prevURL' => url()->previous()]);
        return view('login');
    }

    function login(LoginRequest $request)
    {
        $userData = array(
            'email' => $request->email,
            'password' => $request->password
        );

        $remember = $request->has('remember') ? true : false;

        if(Auth::attempt($userData, $remember))
        {
            return redirect($request->session()->get('prevURL'));
        }
        else
        {
            return back()->with('error', 'Dane logowania są niepoprawne. Spróbuj ponownie.');
        }
    }

    function wyloguj()
    {
        Auth::logout();
        return redirect(url()->previous());
    }
}
