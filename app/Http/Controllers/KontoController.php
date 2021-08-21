<?php

namespace App\Http\Controllers;

use App\Rules\EmailExist;
use App\Rules\IsPasswordSame;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class KontoController extends Controller
{
    function main()
    {
        return view('konto');
    }

    function nick(Request $request)
    {
        $this->validate($request,[
            'nick' => 'bail|required|string|alphaDash|min:3|max:40'
        ],
        [
            'required' => 'Nazwa użytkownika jest wymagana',
            'string' => 'Nazwa użytkownika musi być ciągiem znaków',
            'alpha_dash' => 'Nazwa użytkownika może zawierać tylko litery, cyfry, myślniki oraz podkreślenia',
            'min' => 'Nazwa użytkownika musi składać się z conajmniej :min znaków',
            'max' => 'Nazwa użytkownika musi składać się maksymalnie z :max znaków'
        ]);

        $user = Auth::user();
        $user->name = $request->nick;
        $user->save();

        return back()->with('nickMessage', 'Nazwa użytkownika została pomyślnie zaktualizowana');
    }

    function email(Request $request)
    {
        $this->validate($request, [
            'email' => ['bail', 'required', 'email', 'max:30', new EmailExist]
        ],
        [
            'required' => 'Nie podano emaila',
            'email' => 'Podany email jest niepoprawny',
            'max' => 'Email musi składać się z maksymalnie :max znaków'
        ]);

        $user = Auth::user();
        $user->email = $request->email;
        $user->save();

        return back()->with('emailMessage', 'Email został pomyślnie zaktualizowany');
    }

    function haslo(Request $request)
    {
        $this->validate($request, [
            'oldPassword' => ['bail', 'required', 'string', new IsPasswordSame],
            'newPassword' => 'bail|required|string|min:6'
        ],
        [
            'oldPassword.required' => 'Stare hasło jest wymagane',
            'oldPassword.string' => 'Stare hasło musi być ciągiem znaków',
            'newPassword.required' => 'Nowe hasło jest wymagane',
            'newPassword.string' => 'Nowe hasło musi być ciągiem znaków',
            'newPassword.min' => 'Nowe hasło musi składać się z conajmniej :min znaków'
        ]);

        $user = Auth::user();
        $user->password = Hash::make($request->newPassword);
        $user->save();

        return back()->with('hasloMessage', 'Hasło zostało pomyślnie zaktualizowane');
    }
}
