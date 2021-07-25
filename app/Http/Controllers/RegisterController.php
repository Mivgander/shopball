<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    function main()
    {
        session(['prevURL' => url()->previous()]);
        return view('register');
    }

    function register(RegisterRequest $request)
    {
        if(User::create([
            'name' => $request->nick,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'remember_token' => Str::random(10)
        ]))
        {
            return redirect($request->session()->get('prevURL'));
        }
        else
        {
            return back()->with('error', 'Wystapił problem z rejestracją. Spróbuj ponownie.');
        }
    }
}
