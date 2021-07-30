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
        $produktyBezFiltrow = [];
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

            if($req->marka) $pytanie = $pytanie->where('marka', $req->marka);
            if($req->kolor) $pytanie = $pytanie->where('kolor', $req->kolor);
            if($req->od != '') $pytanie = $pytanie->where('cena', '>=', $req->od);
            if($req->do != '') $pytanie = $pytanie->where('cena', '<=', $req->do);

            return $pytanie->get();
        }

        switch($request->kategoria)
        {
            case 'wszedzie':
                $produktyBezFiltrow[] = PilkaNozna::where('tytul', 'LIKE', '%'.$request->q.'%')->get();
                foreach(SzukajCreateSelect('pilka-nozna', $request) as $row)
                {
                    $produkty[] = new PolecaneDane('pilka-nozna', $row);
                    $parametry[] = SzukajCreateParametry('pilka-nozna', $row);
                }

                $produktyBezFiltrow[] = PilkaReczna::where('tytul', 'LIKE', '%'.$request->q.'%')->get();
                foreach(SzukajCreateSelect('pilka-reczna', $request) as $row)
                {
                    $produkty[] = new PolecaneDane('pilka-reczna', $row);
                    $parametry[] = SzukajCreateParametry('pilka-reczna', $row);
                }

                $produktyBezFiltrow[] = Siatkowka::where('tytul', 'LIKE', '%'.$request->q.'%')->get();
                foreach(SzukajCreateSelect('siatkowka', $request) as $row)
                {
                    $produkty[] = new PolecaneDane('siatkowka', $row);
                    $parametry[] = SzukajCreateParametry('siatkowka', $row);
                }

                $produktyBezFiltrow[] = Koszykowka::where('tytul', 'LIKE', '%'.$request->q.'%')->get();
                foreach(SzukajCreateSelect('koszykowka', $request) as $row)
                {
                    $produkty[] = new PolecaneDane('koszykowka', $row);
                    $parametry[] = SzukajCreateParametry('koszykowka', $row);
                }

                $produktyBezFiltrow[] = TenisZiemny::where('tytul', 'LIKE', '%'.$request->q.'%')->get();
                foreach(SzukajCreateSelect('tenis-ziemny', $request) as $row)
                {
                    $produkty[] = new PolecaneDane('tenis-ziemny', $row);
                    $parametry[] = SzukajCreateParametry('tenis-ziemny', $row);
                }

                $produktyBezFiltrow[] = TenisStolowy::where('tytul', 'LIKE', '%'.$request->q.'%')->get();
                foreach(SzukajCreateSelect('tenis-stolowy', $request) as $row)
                {
                    $produkty[] = new PolecaneDane('tenis-stolowy', $row);
                    $parametry[] = SzukajCreateParametry('tenis-stolowy', $row);
                }
                break;
            case 'pilka_nozna':
                $produktyBezFiltrow[] = PilkaNozna::where('tytul', 'LIKE', '%'.$request->q.'%')->get();
                foreach(SzukajCreateSelect('pilka-nozna', $request) as $row)
                {
                    $produkty[] = new PolecaneDane('pilka-nozna', $row);
                    $parametry[] = SzukajCreateParametry('pilka-reczna', $row);
                }
                break;
            case 'pilka_reczna':
                $produktyBezFiltrow[] = PilkaReczna::where('tytul', 'LIKE', '%'.$request->q.'%')->get();
                foreach(SzukajCreateSelect('pilka-reczna', $request) as $row)
                {
                    $produkty[] = new PolecaneDane('pilka-reczna', $row);
                    $parametry[] = SzukajCreateParametry('pilka-reczna', $row);
                }
                break;
            case 'siatkowka':
                $produktyBezFiltrow[] = Siatkowka::where('tytul', 'LIKE', '%'.$request->q.'%')->get();
                foreach(SzukajCreateSelect('siatkowka', $request) as $row)
                {
                    $produkty[] = new PolecaneDane('siatkowka', $row);
                    $parametry[] = SzukajCreateParametry('siatkowka', $row);
                }
                break;
            case 'koszykowka':
                $produktyBezFiltrow[] = Koszykowka::where('tytul', 'LIKE', '%'.$request->q.'%')->get();
                foreach(SzukajCreateSelect('koszykowka', $request) as $row)
                {
                    $produkty[] = new PolecaneDane('koszykowka', $row);
                    $parametry[] = SzukajCreateParametry('koszykowka', $row);
                }
                break;
            case 'tenis_ziemny':
                $produktyBezFiltrow[] = TenisZiemny::where('tytul', 'LIKE', '%'.$request->q.'%')->get();
                foreach(SzukajCreateSelect('tenis-ziemny', $request) as $row)
                {
                    $produkty[] = new PolecaneDane('tenis-ziemny', $row);
                    $parametry[] = SzukajCreateParametry('tenis-ziemny', $row);
                }
                break;
            case 'tenis_stolowy':
                $produktyBezFiltrow[] = TenisStolowy::where('tytul', 'LIKE', '%'.$request->q.'%')->get();
                foreach(SzukajCreateSelect('tenis-stolowy', $request) as $row)
                {
                    $produkty[] = new PolecaneDane('tenis-stolowy', $row);
                    $parametry[] = SzukajCreateParametry('tenis-stolowy', $row);
                }
                break;
        }

        function SzukajCreateFiltry($przedmioty, $przedmiotyBezFiltrow)
        {
            $kolory = [];
            $marki = [];
            foreach($przedmiotyBezFiltrow as $tab)
            {
                if($tab == []) continue;
                foreach($tab as $row)
                {
                    if(!in_array($row->kolor, $kolory))
                    {
                        $kolory[] = $row->kolor;
                    }

                    if(!in_array($row->marka, $marki))
                    {
                        $marki[] = $row->marka;
                    }
                }
            }

            $liczbaKolory = [];
            $liczbaMarki = [];
            for($i=0; $i<count($kolory); $i++)
            {
                $liczbaKolory[] = 0;
            }
            for($i=0; $i<count($marki); $i++)
            {
                $liczbaMarki[] = 0;
            }

            foreach($przedmioty as $row)
            {
                $key = array_search($row->query->kolor, $kolory);
                if($key !== false)
                {
                    $liczbaKolory[$key]++;
                }

                $key = array_search($row->query->marka, $marki);
                if($key !== false)
                {
                    $liczbaMarki[$key]++;
                }
            }

            $paramKolory = [];
            $paramMarki = [];
            for($i=0; $i<count($kolory); $i++)
            {
                $paramKolory[] = ['param' => $kolory[$i], 'ile' => $liczbaKolory[$i]];
            }
            for($i=0; $i<count($marki); $i++)
            {
                $paramMarki[] = ['param' => $marki[$i], 'ile' => $liczbaMarki[$i]];
            }
            $filtry = [new FiltryDane('marka', $paramMarki), new FiltryDane('kolor', $paramKolory)];

            return $filtry;
        }

        function SzukajSortujFiltry($filtry)
        {
            foreach($filtry as $filtr)
            {
                $max = count($filtr->query);
                for($i=0; $i<$max; $i++)
                {
                    for($j=0; $j<$max; $j++)
                    {
                        if($filtr->query[$i]['ile'] > $filtr->query[$j]['ile'])
                        {
                            $tmp = $filtr->query[$i];
                            $filtr->query[$i] = $filtr->query[$j];
                            $filtr->query[$j] = $tmp;
                        }
                    }
                }
            }

            return $filtry;
        }

        $filtry = SzukajCreateFiltry($produkty, $produktyBezFiltrow);
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
