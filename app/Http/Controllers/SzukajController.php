<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PilkaNozna;
use App\Models\PilkaReczna;
use App\Models\Siatkowka;
use App\Models\Koszykowka;
use App\Models\TenisStolowy;
use App\Models\TenisZiemny;

class FiltryDane
{
    function __construct($nazwa, $query)
    {
        $this->nazwa = $nazwa;
        $this->query = $query;
    }
}

class SzukajController extends Controller
{
    function main(Request $request)
    {
        $produkty = [];
        $parametry = [];

        function SzukajCreateParametry($kategoria, $przedmiot)
        {
            $parametr = [];

            switch($kategoria)
            {
                case 'pilka-nozna':
                    $parametr = [
                        ['rodzaj' => 'marka', 'wartosc' => $przedmiot->marka],
                        ['rodzaj' => 'rozmiar', 'wartosc' => $przedmiot->rozmiar],
                        ['rodzaj' => 'łączenie', 'wartosc' => $przedmiot->łączenie],
                        ['rodzaj' => 'przeznaczenie', 'wartosc' => $przedmiot->przeznaczenie],
                        ['rodzaj' => 'kolor', 'wartosc' => $przedmiot->kolor]
                    ];
                    break;
                case 'pilka-reczna':
                    $parametr = [
                        ['rodzaj' => 'marka', 'wartosc' => $przedmiot->marka],
                        ['rodzaj' => 'rozmiar', 'wartosc' => $przedmiot->rozmiar],
                        ['rodzaj' => 'łączenie', 'wartosc' => $przedmiot->łączenie],
                        ['rodzaj' => 'kolor', 'wartosc' => $przedmiot->kolor]
                    ];
                    break;
                case 'siatkowka':
                    $parametr = [
                        ['rodzaj' => 'marka', 'wartosc' => $przedmiot->marka],
                        ['rodzaj' => 'rozmiar', 'wartosc' => $przedmiot->rozmiar],
                        ['rodzaj' => 'łączenie', 'wartosc' => $przedmiot->łączenie],
                        ['rodzaj' => 'przeznaczenie', 'wartosc' => $przedmiot->przeznaczenie],
                        ['rodzaj' => 'kolor', 'wartosc' => $przedmiot->kolor]
                    ];
                    break;
                case 'koszykowka':
                    $parametr = [
                        ['rodzaj' => 'marka', 'wartosc' => $przedmiot->marka],
                        ['rodzaj' => 'rozmiar', 'wartosc' => $przedmiot->rozmiar],
                        ['rodzaj' => 'przeznaczenie', 'wartosc' => $przedmiot->przeznaczenie],
                        ['rodzaj' => 'kolor', 'wartosc' => $przedmiot->kolor]
                    ];
                    break;
                case 'tenis-ziemny':
                    $parametr = [
                        ['rodzaj' => 'marka', 'wartosc' => $przedmiot->marka],
                        ['rodzaj' => 'typ', 'wartosc' => $przedmiot->typ],
                        ['rodzaj' => 'typ nawierzchni', 'wartosc' => $przedmiot->typ_nawierzchni],
                        ['rodzaj' => 'kolor', 'wartosc' => $przedmiot->kolor]
                    ];
                    break;
                case 'tenis-stolowy':
                    $parametr = [
                        ['rodzaj' => 'marka', 'wartosc' => $przedmiot->marka],
                        ['rodzaj' => 'typ', 'wartosc' => $przedmiot->typ],
                        ['rodzaj' => 'kolor', 'wartosc' => $przedmiot->kolor]
                    ];
                    break;
            }

            return $parametr;
        }

        function SzukajCreateSelect($kategoria, $req)
        {
            $pytanie = null;

            switch($kategoria)
            {
                case 'pilka-nozna':
                    $pytanie = PilkaNozna::where('tytul','LIKE', '%'.$req->q.'%');
                    break;
                case 'pilka-reczna':
                    $pytanie = PilkaReczna::where('tytul','LIKE', '%'.$req->q.'%');
                    break;
                case 'siatkowka':
                    $pytanie = Siatkowka::where('tytul','LIKE', '%'.$req->q.'%');
                    break;
                case 'koszykowka':
                    $pytanie = Koszykowka::where('tytul','LIKE', '%'.$req->q.'%');
                    break;
                case 'tenis-ziemny':
                    $pytanie = TenisZiemny::where('tytul','LIKE', '%'.$req->q.'%');
                    break;
                case 'tenis-stolowy':
                    $pytanie = TenisStolowy::where('tytul','LIKE', '%'.$req->q.'%');
                    break;
            }

            if($req->marki) $pytanie = $pytanie->where('marka', $req->marki);
            if($req->kolory) $pytanie = $pytanie->where('kolor', $req->kolory);
            if($req->od != '') $pytanie = $pytanie->where('cena', '>=', $req->od);
            if($req->do != '') $pytanie = $pytanie->where('cena', '<=', $req->do);

            return $pytanie->get();
        }

        switch($request->kategoria)
        {
            case 'wszedzie':
                foreach(SzukajCreateSelect('pilka-nozna', $request) as $row)
                {
                    $produkty[] = new PolecaneDane('pilka-nozna', $row);
                    $parametry[] = SzukajCreateParametry('pilka-nozna', $row);
                }

                foreach(SzukajCreateSelect('pilka-reczna', $request) as $row)
                {
                    $produkty[] = new PolecaneDane('pilka-reczna', $row);
                    $parametry[] = SzukajCreateParametry('pilka-reczna', $row);
                }

                foreach(SzukajCreateSelect('siatkowka', $request) as $row)
                {
                    $produkty[] = new PolecaneDane('siatkowka', $row);
                    $parametry[] = SzukajCreateParametry('siatkowka', $row);
                }

                foreach(SzukajCreateSelect('koszykowka', $request) as $row)
                {
                    $produkty[] = new PolecaneDane('koszykowka', $row);
                    $parametry[] = SzukajCreateParametry('koszykowka', $row);
                }

                foreach(SzukajCreateSelect('tenis-ziemny', $request) as $row)
                {
                    $produkty[] = new PolecaneDane('tenis-ziemny', $row);
                    $parametry[] = SzukajCreateParametry('tenis-ziemny', $row);
                }

                foreach(SzukajCreateSelect('tenis-stolowy', $request) as $row)
                {
                    $produkty[] = new PolecaneDane('tenis-stolowy', $row);
                    $parametry[] = SzukajCreateParametry('tenis-stolowy', $row);
                }
                break;
            case 'pilka_nozna':
                foreach(SzukajCreateSelect('pilka-nozna', $request) as $row)
                {
                    $produkty[] = new PolecaneDane('pilka-nozna', $row);
                    $parametry[] = SzukajCreateParametry('pilka-reczna', $row);
                }
                break;
            case 'pilka_reczna':
                foreach(SzukajCreateSelect('pilka-reczna', $request) as $row)
                {
                    $produkty[] = new PolecaneDane('pilka-reczna', $row);
                    $parametry[] = SzukajCreateParametry('pilka-reczna', $row);
                }
                break;
            case 'siatkowka':
                foreach(SzukajCreateSelect('siatkowka', $request) as $row)
                {
                    $produkty[] = new PolecaneDane('siatkowka', $row);
                    $parametry[] = SzukajCreateParametry('siatkowka', $row);
                }
                break;
            case 'koszykowka':
                foreach(SzukajCreateSelect('koszykowka', $request) as $row)
                {
                    $produkty[] = new PolecaneDane('koszykowka', $row);
                    $parametry[] = SzukajCreateParametry('koszykowka', $row);
                }
                break;
            case 'tenis_ziemny':
                foreach(SzukajCreateSelect('tenis-ziemny', $request) as $row)
                {
                    $produkty[] = new PolecaneDane('tenis-ziemny', $row);
                    $parametry[] = SzukajCreateParametry('tenis-ziemny', $row);
                }
                break;
            case 'tenis_stolowy':
                foreach(SzukajCreateSelect('tenis-stolowy', $request) as $row)
                {
                    $produkty[] = new PolecaneDane('tenis-stolowy', $row);
                    $parametry[] = SzukajCreateParametry('tenis-stolowy', $row);
                }
                break;
        }

        function SzukajCreateFiltry($przedmioty)
        {
            $filtry = [];

            $marki = [];
            $kolory = [];
            foreach($przedmioty as $row)
            {
                $marki[] = $row->query->marka;
                $kolory[] = $row->query->kolor;
            }

            $elo = [];
            foreach(array_unique($marki) as $marka)
            {
                $i = 0;
                foreach($przedmioty as $row)
                {
                    if($row->query->marka == $marka)
                    {
                        $i++;
                    }
                }

                $elo[] = ['param' => $marka, 'ile' => $i];
            }

            $koniec = new FiltryDane('marki', $elo);
            $filtry[] = $koniec;
            $elo = [];

            foreach(array_unique($kolory) as $kolor)
            {
                $i = 0;
                foreach($przedmioty as $row)
                {
                    if($row->query->kolor == $kolor)
                    {
                        $i++;
                    }
                }

                $elo[] = ['param' => $kolor, 'ile' => $i];
            }

            $koniec = new FiltryDane('kolory', $elo);
            $filtry[] = $koniec;

            return $filtry;
        }

        function SzukajSortujFiltry($filtry)
        {
            $max = count($filtry[0]->query);
            for($i=0; $i<$max; $i++)
            {
                for($j=0; $j<$max; $j++)
                {
                    if($filtry[0]->query[$i]['ile'] > $filtry[0]->query[$j]['ile'])
                    {
                        $tmp = $filtry[0]->query[$i];
                        $filtry[0]->query[$i] = $filtry[0]->query[$j];
                        $filtry[0]->query[$j] = $tmp;
                    }
                }
            }

            $max = count($filtry[1]->query);
            for($i=0; $i<$max; $i++)
            {
                for($j=0; $j<$max; $j++)
                {
                    if($filtry[1]->query[$i]['ile'] > $filtry[1]->query[$j]['ile'])
                    {
                        $tmp = $filtry[1]->query[$i];
                        $filtry[1]->query[$i] = $filtry[1]->query[$j];
                        $filtry[1]->query[$j] = $tmp;
                    }
                }
            }

            return $filtry;
        }

        $filtry = SzukajCreateFiltry($produkty);
        $filtry = SzukajSortujFiltry($filtry);

        return view('szukaj', [
            'produkty'=>$produkty,
            'parametry' => $parametry,
            'filtry'=>$filtry,
            'szukanyTekst'=>$request->q,
            'szukanaKategoria'=>$request->kategoria
        ]);
    }
}
