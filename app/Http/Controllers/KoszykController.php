<?php

namespace App\Http\Controllers;

use App\Models\Koszyk;
use App\Models\Koszykowka;
use App\Models\PilkaNozna;
use App\Models\PilkaReczna;
use App\Models\Siatkowka;
use App\Models\TenisStolowy;
use App\Models\TenisZiemny;
use Illuminate\Support\Facades\Auth;

class KoszykController extends Controller
{
    function main()
    {
        function KoszykGetProdukty()
        {
            $tablica = [];

            foreach(Koszyk::where('id_klienta', Auth::user()->id)->get() as $row)
            {
                switch($row->tabela)
                {
                    case 'pilka_nozna':
                        $tablica[] = new PolecaneDane('pilka-nozna', PilkaNozna::where('id', $row->id_produktu)->get());
                        break;
                    case 'pilka_reczna':
                        $tablica[] = new PolecaneDane('pilka-reczna', PilkaReczna::where('id', $row->id_produktu)->get());
                        break;
                    case 'siatkowka':
                        $tablica[] = new PolecaneDane('siatkowka', Siatkowka::where('id', $row->id_produktu)->get());
                        break;
                    case 'koszykowka':
                        $tablica[] = new PolecaneDane('koszykowka', Koszykowka::where('id', $row->id_produktu)->get());
                        break;
                    case 'tenis_ziemny':
                        $tablica[] = new PolecaneDane('tenis-ziemny', TenisZiemny::where('id', $row->id_produktu)->get());
                        break;
                    case 'tenis_stolowy':
                        $tablica[] = new PolecaneDane('tenis-stolowy', TenisStolowy::where('id', $row->id_produktu)->get());
                        break;
                }
            }

            return $tablica;
        }

        $produkty = KoszykGetProdukty();

        return view('koszyk', [
            'produkty' => $produkty
        ]);
    }

    function dodaj($nazwa, $id)
    {
        function KoszykDodajProdukt($nazwa, $idProduktu)
        {
            $tabela = '';
            $produkt = null;

            switch($nazwa)
            {
                case 'pilka-nozna':
                    $tabela = 'pilka_nozna';
                    $produkt = PilkaNozna::where('id', $idProduktu)->get();
                    break;
                case 'pilka-reczna':
                    $tabela = 'pilka_reczna';
                    $produkt = PilkaReczna::where('id', $idProduktu)->get();
                    break;
                case 'siatkowka':
                    $tabela = 'siatkowka';
                    $produkt = Siatkowka::where('id', $idProduktu)->get();
                    break;
                case 'koszykowka':
                    $tabela = 'koszykowka';
                    $produkt = Koszykowka::where('id', $idProduktu)->get();
                    break;
                case 'tenis-ziemny':
                    $tabela = 'tenis_ziemny';
                    $produkt = TenisZiemny::where('id', $idProduktu)->get();
                    break;
                case 'tenis-stolowy':
                    $tabela = 'tenis_stolowy';
                    $produkt = TenisStolowy::where('id', $idProduktu)->get();
                    break;
            }

            if(Koszyk::create([
                'tabela' => $tabela,
                'id_produktu' => $idProduktu,
                'id_klienta' => Auth::user()->id
            ])) return [true, $produkt];
            else return [false, $produkt];
        }

        if(!Auth::user())
        {
            return back();
        }
        else
        {
            $funkcja = KoszykDodajProdukt($nazwa, $id);
            session(['prevURL' => url()->previous()]);
            $wynik = $funkcja[0];
            $produkt = $funkcja[1];
            return view('koszykWynik', [
                'produkt' => $produkt[0]
            ])->with('wynik', $wynik);
        }
    }

    function usun($nazwa, $id)
    {
        if(Koszyk::where('tabela', str_replace('-', '_', $nazwa))->where('id_produktu', $id)->where('id_klienta', Auth::user()->id)->delete())
        {
            return redirect('/koszyk');
        }
        else
        {
            return redirect('/koszyk')->with('error', 'Nie udało się usunąć przedmiotu. Spróbuj ponownie.');
        }

    }
}
