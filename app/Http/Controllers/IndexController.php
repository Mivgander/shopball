<?php

namespace App\Http\Controllers;

use App\Models\Polecane;
use App\Models\PilkaNozna;
use App\Models\PilkaReczna;
use App\Models\Siatkowka;
use App\Models\Koszykowka;
use App\Models\TenisStolowy;
use App\Models\TenisZiemny;

class PolecaneDane
{
    function __construct($kategoriaURL, $query)
    {
        $this->kategoriaURL = $kategoriaURL;
        $this->query = $query;
    }
}

class IndexController extends Controller
{
    function show()
    {
        $polecane = [];
        foreach(Polecane::all()->take(5) as $row)
        {
            switch($row->tabela)
            {
                case 'pilka_nozna':
                    $polecane[] = new PolecaneDane('pilka-nozna', PilkaNozna::where('id', $row->id_produktu)->get());
                    break;
                case 'pilka_reczna':
                    $polecane[] = new PolecaneDane('pilka-reczna', PilkaReczna::where('id', $row->id_produktu)->get());
                    break;
                case 'siatkowka':
                    $polecane[] = new PolecaneDane('siatkowka', Siatkowka::where('id', $row->id_produktu)->get());
                    break;
                case 'koszykowka':
                    $polecane[] = new PolecaneDane('koszykowka', Koszykowka::where('id', $row->id_produktu)->get());
                    break;
                case 'tenis_ziemny':
                    $polecane[] = new PolecaneDane('tenis-ziemny', TenisZiemny::where('id', $row->id_produktu)->get());
                    break;
                case 'tenis_stolowy':
                    $polecane[] = new PolecaneDane('tenis-stolowy', TenisStolowy::where('id', $row->id_produktu)->get());
                    break;
            }
        }

        return view('index', [
            'polecane'=>$polecane
        ]);
    }
}
