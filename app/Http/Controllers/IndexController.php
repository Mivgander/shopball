<?php

namespace App\Http\Controllers;

use App\Models\Polecane;
use App\Models\PilkaNozna;
use App\Models\PilkaReczna;
use App\Models\Siatkowka;
use App\Models\Koszykowka;
use App\Models\ProduktDnia;
use App\Models\TenisStolowy;
use App\Models\TenisZiemny;

class IndexController extends Controller
{
    function show()
    {
        function IndexPolecane()
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

            return $polecane;
        }

        function IndexProduktDnia()
        {
            $row = ProduktDnia::where('dzien', date('Y-m-d'))->limit(1)->get();
            $produkt = null;

            if($row->count() > 0)
            {
                switch($row[0]->tabela)
                {
                    case 'pilka_nozna':
                        $produkt = new PolecaneDane('pilka-nozna', PilkaNozna::where('id', $row[0]->id_produktu)->get()[0]);
                        break;
                    case 'pilka_reczna':
                        $produkt = new PolecaneDane('pilka-reczna', PilkaReczna::where('id', $row[0]->id_produktu)->get()[0]);
                        break;
                    case 'siatkowka':
                        $produkt = new PolecaneDane('siatkowka', Siatkowka::where('id', $row[0]->id_produktu)->get()[0]);
                        break;
                    case 'koszykowka':
                        $produkt = new PolecaneDane('koszykowka', Koszykowka::where('id', $row[0]->id_produktu)->get()[0]);
                        break;
                    case 'tenis_ziemny':
                        $produkt = new PolecaneDane('tenis-ziemny', TenisZiemny::where('id', $row[0]->id_produktu)->get()[0]);
                        break;
                    case 'tenis_stolowy':
                        $produkt = new PolecaneDane('tenis-stolowy', TenisStolowy::where('id', $row[0]->id_produktu)->get()[0]);
                        break;
                }
            }
            else
            {
                $produkt = new PolecaneDane('siatkowka', Siatkowka::where('id', '1')->get()[0]);
            }

            return $produkt;
        }

        $polecane = IndexPolecane();
        $produktDnia = IndexProduktDnia();

        return view('index', [
            'polecane'=>$polecane,
            'produktDnia'=>$produktDnia
        ]);
    }
}
