<?php

namespace App\Http\Controllers;

class DodajController extends Controller
{
    function main()
    {
        return view('dodaj');
    }

    function pomyslnie()
    {
        return view('pomyslnie');
    }
}
