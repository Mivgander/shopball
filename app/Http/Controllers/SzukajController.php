<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SzukajController extends Controller
{
    function main(Request $request)
    {
        return view('szukaj', [
            'szukanyTekst'=>$request->q,
            'szukanaKategoria'=>$request->kategoria
        ]);
    }
}
