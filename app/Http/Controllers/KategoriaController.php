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

class KategoriaController extends Controller
{
    function show($nazwa, Request $request)
    {
        /**
         * Zwraca kolekcję po uprzednim dodaniu wszystkich filtrów.
         *
         * @param Collection $select przygotowana instancja zapytania. Aby ją przygotować użyj modelu i wykonaj zapytanie "where('id', '>=', '1')"
         * @param string $tableName nazwa tablicy, z której mają być brane dane
         * @param Request $req obiekt Request
         *
         * @return Collection
         */
        function CreateSelect($select, $tableName, $req)
        {
            if($req->marka) $select = $select->whereIn('marka', $req->marka);

            if(in_array($tableName, ['pilka_nozna', 'pilka_reczna', 'koszykowka', 'siatkowka']) && $req->rozmiar) $select = $select->whereIn('rozmiar', $req->rozmiar);
            else if(in_array($tableName, ['tenis_ziemny', 'tenis_stolowy']) && $req->typ) $select = $select->whereIn('typ', $req->typ);

            if(in_array($tableName, ['pilka_nozna', 'pilka_reczna', 'siatkowka']) && $req->łączenie) $select = $select->whereIn('łączenie', $req->łączenie);

            if(in_array($tableName, ['koszykowka', 'pilka_nozna', 'siatkowka']) && $req->przeznaczenie) $select = $select->whereIn('przeznaczenie', $req->przeznaczenie);
            else if($tableName == 'tenis_ziemny' && $req->typ_nawierzchni) $select = $select->whereIn('typ_nawierzchni', $req->typ_nawierzchni);

            if($req->kolor) $select = $select->whereIn('kolor', $req->kolor);

            if($req->od != '') $select = $select->where('cena', '>=', $req->od);
            if($req->do != '') $select = $select->where('cena', '<=', $req->do);

            return $select->get();
        }

        /**
         * Zwraca dwuwymiarową tablicę przechowującą parametry wszystkich szukanych produktów
         * @param Request $request obiekt Request
         * @param string $sport string przechowujący nazwę obecnej kategorii.
         * W KategoriaController nazwa jest trzymana w zmiennej $nazwa
         *
         * @return array
         */
        function CreateParametry($request, $sport)
        {
            $parametry = [];
            switch($sport)
            {
                case 'pilka-nozna':
                    $data = PilkaNozna::Rekordy($request);
                    $marki = [];
                    $rozmiary = [];
                    $przeznaczenia = [];
                    $laczenia = [];
                    $kolory = [];
                    foreach($data as $row)
                    {
                        $marki[] = $row->marka;
                        $rozmiary[] = $row->rozmiar;
                        $przeznaczenia[] = $row->przeznaczenie;
                        $laczenia[] = $row->łączenie;
                        $kolory[] = $row->kolor;
                    }

                    $parametry = [$marki, $rozmiary, $laczenia, $przeznaczenia, $kolory];
                    break;
                case 'siatkowka':
                    $data = Siatkowka::Rekordy($request);
                    $marki = [];
                    $rozmiary = [];
                    $przeznaczenia = [];
                    $laczenia = [];
                    $kolory = [];
                    foreach($data as $row)
                    {
                        $marki[] = $row->marka;
                        $rozmiary[] = $row->rozmiar;
                        $przeznaczenia[] = $row->przeznaczenie;
                        $laczenia[] = $row->łączenie;
                        $kolory[] = $row->kolor;
                    }

                    $parametry = [$marki, $rozmiary, $laczenia, $przeznaczenia, $kolory];
                    break;
                case 'pilka-reczna':
                    $data = PilkaReczna::Rekordy($request);
                    $marki = [];
                    $rozmiary = [];
                    $laczenia = [];
                    $kolory = [];
                    foreach($data as $row)
                    {
                        $marki[] = $row->marka;
                        $rozmiary[] = $row->rozmiar;
                        $laczenia[] = $row->łączenie;
                        $kolory[] = $row->kolor;
                    }

                    $parametry = [$marki, $rozmiary, $laczenia, $kolory];
                    break;
                case 'koszykowka':
                    $data = Koszykowka::Rekordy($request);
                    $marki = [];
                    $rozmiary = [];
                    $przeznaczenia = [];
                    $kolory = [];
                    foreach($data as $row)
                    {
                        $marki[] = $row->marka;
                        $rozmiary[] = $row->rozmiar;
                        $przeznaczenia[] = $row->przeznaczenie;
                        $kolory[] = $row->kolor;
                    }

                    $parametry = [$marki, $rozmiary, $przeznaczenia, $kolory];
                    break;
                case 'tenis-ziemny':
                    $data = TenisZiemny::Rekordy($request);
                    $marki = [];
                    $typy = [];
                    $typyNawierzchni = [];
                    $kolory = [];
                    foreach($data as $row)
                    {
                        $marki[] = $row->marka;
                        $typy[] = $row->typ;
                        $typyNawierzchni[] = $row->typ_nawierzchni;
                        $kolory[] = $row->kolor;
                    }

                    $parametry = [$marki, $typy, $typyNawierzchni, $kolory];
                    break;
                case 'tenis-stolowy':
                    $data = TenisStolowy::Rekordy($request);
                    $marki = [];
                    $typy = [];
                    $kolory = [];
                    foreach($data as $row)
                    {
                        $marki[] = $row->marka;
                        $typy[] = $row->typ;
                        $kolory[] = $row->kolor;
                    }

                    $parametry = [$marki, $typy, $kolory];
                    break;
            }

            return $parametry;
        }

        /**
         * Zwraca tablicę obiektów klasy FiltryDane zawieracjącą wszystkie filtry odpowiedniej kategorii.
         * @param Request $request obiekt Request
         * @param string $tableName nazwa tablicy, z której mają być brane dane
         * @return array
         */
        function KategoriaCreateFiltry($request, $tableName)
        {
            $filtry = [];
            switch($tableName)
            {
                case 'pilka_nozna':
                    $przedmioty = CreateSelect(PilkaNozna::where('id', '>=', '1'), 'pilka_nozna', $request);
                    $przedmiotyBezFiltrow = PilkaNozna::all();
                    $marki = [];
                    $rozmiary = [];
                    $laczenia = [];
                    $przeznaczenia = [];
                    $kolory = [];

                    foreach($przedmiotyBezFiltrow as $row)
                    {
                        if(!in_array($row->marka, $marki)) $marki[] = $row->marka;
                        if(!in_array($row->rozmiar, $rozmiary)) $rozmiary[] = $row->rozmiar;
                        if(!in_array($row->łączenie, $laczenia)) $laczenia[] = $row->łączenie;
                        if(!in_array($row->przeznaczenie, $przeznaczenia)) $przeznaczenia[] = $row->przeznaczenie;
                        if(!in_array($row->kolor, $kolory)) $kolory[] = $row->kolor;
                    }

                    $liczbaMarki = [];
                    $liczbaRozmiary = [];
                    $liczbaLaczenia = [];
                    $liczbaPrzeznaczenia = [];
                    $liczbaKolory = [];

                    for($i=0; $i<count($marki); $i++) $liczbaMarki[] = 0;
                    for($i=0; $i<count($rozmiary); $i++) $liczbaRozmiary[] = 0;
                    for($i=0; $i<count($laczenia); $i++) $liczbaLaczenia[] = 0;
                    for($i=0; $i<count($przeznaczenia); $i++) $liczbaPrzeznaczenia[] = 0;
                    for($i=0; $i<count($kolory); $i++) $liczbaKolory[] = 0;

                    foreach($przedmioty as $row)
                    {
                        $key = array_search($row->marka, $marki);
                        if($key !== false) $liczbaMarki[$key]++;

                        $key = array_search($row->rozmiar, $rozmiary);
                        if($key !== false) $liczbaRozmiary[$key]++;

                        $key = array_search($row->łączenie, $laczenia);
                        if($key !== false) $liczbaLaczenia[$key]++;

                        $key = array_search($row->przeznaczenie, $przeznaczenia);
                        if($key !== false) $liczbaPrzeznaczenia[$key]++;

                        $key = array_search($row->kolor, $kolory);
                        if($key !== false) $liczbaKolory[$key]++;
                    }

                    $filtry = [];
                    $param = [];

                    for($i=0; $i<count($marki); $i++) $param[] = ['param' => $marki[$i], 'ile' => $liczbaMarki[$i]];
                    $filtry[] = new FiltryDane('marka', $param);
                    $param = [];

                    for($i=0; $i<count($rozmiary); $i++) $param[] = ['param' => $rozmiary[$i], 'ile' => $liczbaRozmiary[$i]];
                    $filtry[] = new FiltryDane('rozmiar', $param);
                    $param = [];

                    for($i=0; $i<count($laczenia); $i++) $param[] = ['param' => $laczenia[$i], 'ile' => $liczbaLaczenia[$i]];
                    $filtry[] = new FiltryDane('łączenie', $param);
                    $param = [];

                    for($i=0; $i<count($przeznaczenia); $i++) $param[] = ['param' => $przeznaczenia[$i], 'ile' => $liczbaPrzeznaczenia[$i]];
                    $filtry[] = new FiltryDane('przeznaczenie', $param);
                    $param = [];

                    for($i=0; $i<count($kolory); $i++) $param[] = ['param' => $kolory[$i], 'ile' => $liczbaKolory[$i]];
                    $filtry[] = new FiltryDane('kolor', $param);
                    break;
                case 'pilka_reczna':
                    $przedmioty = CreateSelect(PilkaReczna::where('id', '>=', '1'), 'pilka_reczna', $request);
                    $przedmiotyBezFiltrow = PilkaReczna::all();
                    $marki = [];
                    $rozmiary = [];
                    $laczenia = [];
                    $kolory = [];

                    foreach($przedmiotyBezFiltrow as $row)
                    {
                        if(!in_array($row->marka, $marki)) $marki[] = $row->marka;
                        if(!in_array($row->rozmiar, $rozmiary)) $rozmiary[] = $row->rozmiar;
                        if(!in_array($row->łączenie, $laczenia)) $laczenia[] = $row->łączenie;
                        if(!in_array($row->kolor, $kolory)) $kolory[] = $row->kolor;
                    }

                    $liczbaMarki = [];
                    $liczbaRozmiary = [];
                    $liczbaLaczenia = [];
                    $liczbaKolory = [];

                    for($i=0; $i<count($marki); $i++) $liczbaMarki[] = 0;
                    for($i=0; $i<count($rozmiary); $i++) $liczbaRozmiary[] = 0;
                    for($i=0; $i<count($laczenia); $i++) $liczbaLaczenia[] = 0;
                    for($i=0; $i<count($kolory); $i++) $liczbaKolory[] = 0;

                    foreach($przedmioty as $row)
                    {
                        $key = array_search($row->marka, $marki);
                        if($key !== false) $liczbaMarki[$key]++;

                        $key = array_search($row->rozmiar, $rozmiary);
                        if($key !== false) $liczbaRozmiary[$key]++;

                        $key = array_search($row->łączenie, $laczenia);
                        if($key !== false) $liczbaLaczenia[$key]++;

                        $key = array_search($row->kolor, $kolory);
                        if($key !== false) $liczbaKolory[$key]++;
                    }

                    $filtry = [];
                    $param = [];

                    for($i=0; $i<count($marki); $i++) $param[] = ['param' => $marki[$i], 'ile' => $liczbaMarki[$i]];
                    $filtry[] = new FiltryDane('marka', $param);
                    $param = [];

                    for($i=0; $i<count($rozmiary); $i++) $param[] = ['param' => $rozmiary[$i], 'ile' => $liczbaRozmiary[$i]];
                    $filtry[] = new FiltryDane('rozmiar', $param);
                    $param = [];

                    for($i=0; $i<count($laczenia); $i++) $param[] = ['param' => $laczenia[$i], 'ile' => $liczbaLaczenia[$i]];
                    $filtry[] = new FiltryDane('łączenie', $param);
                    $param = [];

                    for($i=0; $i<count($kolory); $i++) $param[] = ['param' => $kolory[$i], 'ile' => $liczbaKolory[$i]];
                    $filtry[] = new FiltryDane('kolor', $param);
                    break;
                case 'siatkowka':
                    $przedmioty = CreateSelect(Siatkowka::where('id', '>=', '1'), 'siatkowka', $request);
                    $przedmiotyBezFiltrow = Siatkowka::all();
                    $marki = [];
                    $rozmiary = [];
                    $laczenia = [];
                    $przeznaczenia = [];
                    $kolory = [];

                    foreach($przedmiotyBezFiltrow as $row)
                    {
                        if(!in_array($row->marka, $marki)) $marki[] = $row->marka;
                        if(!in_array($row->rozmiar, $rozmiary)) $rozmiary[] = $row->rozmiar;
                        if(!in_array($row->łączenie, $laczenia)) $laczenia[] = $row->łączenie;
                        if(!in_array($row->przeznaczenie, $przeznaczenia)) $przeznaczenia[] = $row->przeznaczenie;
                        if(!in_array($row->kolor, $kolory)) $kolory[] = $row->kolor;
                    }

                    $liczbaMarki = [];
                    $liczbaRozmiary = [];
                    $liczbaLaczenia = [];
                    $liczbaPrzeznaczenia = [];
                    $liczbaKolory = [];

                    for($i=0; $i<count($marki); $i++) $liczbaMarki[] = 0;
                    for($i=0; $i<count($rozmiary); $i++) $liczbaRozmiary[] = 0;
                    for($i=0; $i<count($laczenia); $i++) $liczbaLaczenia[] = 0;
                    for($i=0; $i<count($przeznaczenia); $i++) $liczbaPrzeznaczenia[] = 0;
                    for($i=0; $i<count($kolory); $i++) $liczbaKolory[] = 0;

                    foreach($przedmioty as $row)
                    {
                        $key = array_search($row->marka, $marki);
                        if($key !== false) $liczbaMarki[$key]++;

                        $key = array_search($row->rozmiar, $rozmiary);
                        if($key !== false) $liczbaRozmiary[$key]++;

                        $key = array_search($row->łączenie, $laczenia);
                        if($key !== false) $liczbaLaczenia[$key]++;

                        $key = array_search($row->przeznaczenie, $przeznaczenia);
                        if($key !== false) $liczbaPrzeznaczenia[$key]++;

                        $key = array_search($row->kolor, $kolory);
                        if($key !== false) $liczbaKolory[$key]++;
                    }

                    $filtry = [];
                    $param = [];

                    for($i=0; $i<count($marki); $i++) $param[] = ['param' => $marki[$i], 'ile' => $liczbaMarki[$i]];
                    $filtry[] = new FiltryDane('marka', $param);
                    $param = [];

                    for($i=0; $i<count($rozmiary); $i++) $param[] = ['param' => $rozmiary[$i], 'ile' => $liczbaRozmiary[$i]];
                    $filtry[] = new FiltryDane('rozmiar', $param);
                    $param = [];

                    for($i=0; $i<count($laczenia); $i++) $param[] = ['param' => $laczenia[$i], 'ile' => $liczbaLaczenia[$i]];
                    $filtry[] = new FiltryDane('łączenie', $param);
                    $param = [];

                    for($i=0; $i<count($przeznaczenia); $i++) $param[] = ['param' => $przeznaczenia[$i], 'ile' => $liczbaPrzeznaczenia[$i]];
                    $filtry[] = new FiltryDane('przeznaczenie', $param);
                    $param = [];

                    for($i=0; $i<count($kolory); $i++) $param[] = ['param' => $kolory[$i], 'ile' => $liczbaKolory[$i]];
                    $filtry[] = new FiltryDane('kolor', $param);
                    break;
                case 'koszykowka':
                    $przedmioty = CreateSelect(Koszykowka::where('id', '>=', '1'), 'koszykowka', $request);
                    $przedmiotyBezFiltrow = Koszykowka::all();
                    $marki = [];
                    $rozmiary = [];
                    $przeznaczenia = [];
                    $kolory = [];

                    foreach($przedmiotyBezFiltrow as $row)
                    {
                        if(!in_array($row->marka, $marki)) $marki[] = $row->marka;
                        if(!in_array($row->rozmiar, $rozmiary)) $rozmiary[] = $row->rozmiar;
                        if(!in_array($row->przeznaczenie, $przeznaczenia)) $przeznaczenia[] = $row->przeznaczenie;
                        if(!in_array($row->kolor, $kolory)) $kolory[] = $row->kolor;
                    }

                    $liczbaMarki = [];
                    $liczbaRozmiary = [];
                    $liczbaPrzeznaczenia = [];
                    $liczbaKolory = [];

                    for($i=0; $i<count($marki); $i++) $liczbaMarki[] = 0;
                    for($i=0; $i<count($rozmiary); $i++) $liczbaRozmiary[] = 0;
                    for($i=0; $i<count($przeznaczenia); $i++) $liczbaPrzeznaczenia[] = 0;
                    for($i=0; $i<count($kolory); $i++) $liczbaKolory[] = 0;

                    foreach($przedmioty as $row)
                    {
                        $key = array_search($row->marka, $marki);
                        if($key !== false) $liczbaMarki[$key]++;

                        $key = array_search($row->rozmiar, $rozmiary);
                        if($key !== false) $liczbaRozmiary[$key]++;

                        $key = array_search($row->przeznaczenie, $przeznaczenia);
                        if($key !== false) $liczbaPrzeznaczenia[$key]++;

                        $key = array_search($row->kolor, $kolory);
                        if($key !== false) $liczbaKolory[$key]++;
                    }

                    $filtry = [];
                    $param = [];

                    for($i=0; $i<count($marki); $i++) $param[] = ['param' => $marki[$i], 'ile' => $liczbaMarki[$i]];
                    $filtry[] = new FiltryDane('marka', $param);
                    $param = [];

                    for($i=0; $i<count($rozmiary); $i++) $param[] = ['param' => $rozmiary[$i], 'ile' => $liczbaRozmiary[$i]];
                    $filtry[] = new FiltryDane('rozmiar', $param);
                    $param = [];

                    for($i=0; $i<count($przeznaczenia); $i++) $param[] = ['param' => $przeznaczenia[$i], 'ile' => $liczbaPrzeznaczenia[$i]];
                    $filtry[] = new FiltryDane('przeznaczenie', $param);
                    $param = [];

                    for($i=0; $i<count($kolory); $i++) $param[] = ['param' => $kolory[$i], 'ile' => $liczbaKolory[$i]];
                    $filtry[] = new FiltryDane('kolor', $param);
                    break;
                case 'tenis_ziemny':
                    $przedmioty = CreateSelect(TenisZiemny::where('id', '>=', '1'), 'tenis_ziemny', $request);
                    $przedmiotyBezFiltrow = TenisZiemny::all();
                    $marki = [];
                    $typy = [];
                    $typy_nawierzchni = [];
                    $kolory = [];

                    foreach($przedmiotyBezFiltrow as $row)
                    {
                        if(!in_array($row->marka, $marki)) $marki[] = $row->marka;
                        if(!in_array($row->typ, $typy)) $typy[] = $row->typ;
                        if(!in_array($row->typ_nawierzchni, $typy_nawierzchni)) $typy_nawierzchni[] = $row->typ_nawierzchni;
                        if(!in_array($row->kolor, $kolory)) $kolory[] = $row->kolor;
                    }

                    $liczbaMarki = [];
                    $liczbaTypy = [];
                    $liczbaTypyNawierzchni = [];
                    $liczbaKolory = [];

                    for($i=0; $i<count($marki); $i++) $liczbaMarki[] = 0;
                    for($i=0; $i<count($typy); $i++) $liczbaTypy[] = 0;
                    for($i=0; $i<count($typy_nawierzchni); $i++) $liczbaTypyNawierzchni[] = 0;
                    for($i=0; $i<count($kolory); $i++) $liczbaKolory[] = 0;

                    foreach($przedmioty as $row)
                    {
                        $key = array_search($row->marka, $marki);
                        if($key !== false) $liczbaMarki[$key]++;

                        $key = array_search($row->typ, $typy);
                        if($key !== false) $liczbaTypy[$key]++;

                        $key = array_search($row->typ_nawierzchni, $typy_nawierzchni);
                        if($key !== false) $liczbaTypyNawierzchni[$key]++;

                        $key = array_search($row->kolor, $kolory);
                        if($key !== false) $liczbaKolory[$key]++;
                    }

                    $filtry = [];
                    $param = [];

                    for($i=0; $i<count($marki); $i++) $param[] = ['param' => $marki[$i], 'ile' => $liczbaMarki[$i]];
                    $filtry[] = new FiltryDane('marka', $param);
                    $param = [];

                    for($i=0; $i<count($typy); $i++) $param[] = ['param' => $typy[$i], 'ile' => $liczbaTypy[$i]];
                    $filtry[] = new FiltryDane('typ', $param);
                    $param = [];

                    for($i=0; $i<count($typy_nawierzchni); $i++) $param[] = ['param' => $typy_nawierzchni[$i], 'ile' => $liczbaTypyNawierzchni[$i]];
                    $filtry[] = new FiltryDane('typ nawierzchni', $param);
                    $param = [];

                    for($i=0; $i<count($kolory); $i++) $param[] = ['param' => $kolory[$i], 'ile' => $liczbaKolory[$i]];
                    $filtry[] = new FiltryDane('kolor', $param);
                    break;
                case 'tenis_stolowy':
                    $przedmioty = CreateSelect(TenisStolowy::where('id', '>=', '1'), 'tenis_stolowy', $request);
                    $przedmiotyBezFiltrow = TenisStolowy::all();
                    $marki = [];
                    $typy = [];
                    $kolory = [];

                    foreach($przedmiotyBezFiltrow as $row)
                    {
                        if(!in_array($row->marka, $marki)) $marki[] = $row->marka;
                        if(!in_array($row->typ, $typy)) $typy[] = $row->typ;
                        if(!in_array($row->kolor, $kolory)) $kolory[] = $row->kolor;
                    }

                    $liczbaMarki = [];
                    $liczbaTypy = [];
                    $liczbaTypyNawierzchni = [];
                    $liczbaKolory = [];

                    for($i=0; $i<count($marki); $i++) $liczbaMarki[] = 0;
                    for($i=0; $i<count($typy); $i++) $liczbaTypy[] = 0;
                    for($i=0; $i<count($kolory); $i++) $liczbaKolory[] = 0;

                    foreach($przedmioty as $row)
                    {
                        $key = array_search($row->marka, $marki);
                        if($key !== false) $liczbaMarki[$key]++;

                        $key = array_search($row->typ, $typy);
                        if($key !== false) $liczbaTypy[$key]++;

                        $key = array_search($row->kolor, $kolory);
                        if($key !== false) $liczbaKolory[$key]++;
                    }

                    $filtry = [];
                    $param = [];

                    for($i=0; $i<count($marki); $i++) $param[] = ['param' => $marki[$i], 'ile' => $liczbaMarki[$i]];
                    $filtry[] = new FiltryDane('marka', $param);
                    $param = [];

                    for($i=0; $i<count($typy); $i++) $param[] = ['param' => $typy[$i], 'ile' => $liczbaTypy[$i]];
                    $filtry[] = new FiltryDane('typ', $param);
                    $param = [];

                    for($i=0; $i<count($kolory); $i++) $param[] = ['param' => $kolory[$i], 'ile' => $liczbaKolory[$i]];
                    $filtry[] = new FiltryDane('kolor', $param);
                    break;
            }

            return $filtry;
        }

        function KategoriaSortujFiltry($filtry)
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

        switch($nazwa)
        {
            case 'pilka-nozna':
                $filtry = KategoriaCreateFiltry($request, 'pilka_nozna');
                return view('kategoria', [
                    'tytul'=>"Piłka nożna",
                    'nazwa'=>$nazwa,
                    'produkty'=>PilkaNozna::Rekordy($request),
                    'filtry'=>KategoriaSortujFiltry($filtry),
                    'parametry'=>CreateParametry($request, $nazwa)
                ]);
                break;
            case 'pilka-reczna':
                $filtry = KategoriaCreateFiltry($request, 'pilka_reczna');
                return view('kategoria', [
                    'tytul'=>"Piłka ręczna",
                    'nazwa'=>$nazwa,
                    'filtry'=>KategoriaSortujFiltry($filtry),
                    'produkty'=>PilkaReczna::Rekordy($request),
                    'parametry'=>CreateParametry($request, $nazwa)
                ]);
                break;
            case 'siatkowka':
                $filtry = KategoriaCreateFiltry($request, 'siatkowka');
                return view('kategoria', [
                    'tytul'=>"Siatkówka",
                    'nazwa'=>$nazwa,
                    'filtry'=>KategoriaSortujFiltry($filtry),
                    'produkty'=>Siatkowka::Rekordy($request),
                    'parametry'=>CreateParametry($request, $nazwa)
                ]);
                break;
            case 'koszykowka':
                $filtry = KategoriaCreateFiltry($request, 'koszykowka');
                return view('kategoria', [
                    'tytul'=>"Koszykówka",
                    'nazwa'=>$nazwa,
                    'filtry'=>KategoriaSortujFiltry($filtry),
                    'produkty'=>Koszykowka::Rekordy($request),
                    'parametry'=>CreateParametry($request, $nazwa)
                ]);
                break;
            case 'tenis-ziemny':
                $filtry = KategoriaCreateFiltry($request, 'tenis_ziemny');
                return view('kategoria', [
                    'tytul'=>"Tenis ziemny",
                    'nazwa'=>$nazwa,
                    'filtry'=>KategoriaSortujFiltry($filtry),
                    'produkty'=>TenisZiemny::Rekordy($request),
                    'parametry'=>CreateParametry($request, $nazwa)
                ]);
                break;
            case 'tenis-stolowy':
                $filtry = KategoriaCreateFiltry($request, 'tenis_stolowy');
                return view('kategoria', [
                    'tytul'=>"Tenis stołowy",
                    'nazwa'=>$nazwa,
                    'filtry'=>KategoriaSortujFiltry($filtry),
                    'produkty'=>TenisStolowy::Rekordy($request),
                    'parametry'=>CreateParametry($request, $nazwa)
                ]);
                break;
            default:
                return "Nie ma!";
                break;
        }
    }
}
