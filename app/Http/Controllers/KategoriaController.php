<?php

namespace App\Http\Controllers;

class KategoriaController extends Controller
{
    function show($nazwa)
    {
        $tytul = '';
        switch($nazwa)
        {
            case 'pilka-nozna':
                $tytul = 'Piłka nożna';
                break;
            case 'pilka-reczna':
                $tytul = 'Piłka ręczna';
                break;
            case 'siatkowka':
                $tytul = 'Siatkówka';
                break;
            case 'koszykowka':
                $tytul = 'Koszykówka';
                break;
            case 'tenis-ziemny':
                $tytul = 'Tenis ziemny';
                break;
            case 'tenis-stolowy':
                $tytul = 'Tenis stołowy';
                break;
        }

        return view('kategoria', [
            'tytul' => $tytul,
            'nazwa' => $nazwa
        ]);
    }
}
