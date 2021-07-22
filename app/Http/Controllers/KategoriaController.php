<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PilkaNozna;
use App\Models\PilkaReczna;
use App\Models\Siatkowka;
use App\Models\Koszykowka;
use App\Models\TenisStolowy;
use App\Models\TenisZiemny;
use Illuminate\Support\Facades\DB;

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
         * Zwraca tablicę obektów klasy FiltyDane przechowujących filtry dla aktualnej kategorii.
         * @param Request $request obiekt Request
         * @param string $databaseName nazwa bazy danych, z której mają być brane dane
         *
         * @return array
         */
        function CreateFiltry($request, $databaseName)
        {
            $filtry = [];

            $select = DB::table($databaseName)->select('marka as param', DB::raw('count(marka) as ile'));
            $select = CreateSelect($select, $databaseName, 'marka', $request);
            $marki = new FiltryDane('marka', $select);
            $filtry[] = $marki;

            if(in_array($databaseName, ['pilka_nozna', 'pilka_reczna', 'koszykowka', 'siatkowka']))
            {
                $select = DB::table($databaseName)->select('rozmiar as param', DB::raw('count(rozmiar) as ile'))->orderByDesc('rozmiar');
                $select = CreateSelect($select, $databaseName, 'rozmiar', $request);
                $rozmiary = new FiltryDane('rozmiar', $select);
                $filtry[] = $rozmiary;
            }
            else if(in_array($databaseName, ['tenis_ziemny', 'tenis_stolowy']))
            {
                $select = DB::table($databaseName)->select('typ as param', DB::raw('count(typ) as ile'))->orderByDesc('typ');
                $select = CreateSelect($select, $databaseName, 'typ', $request);
                $typy = new FiltryDane('typ', $select);
                $filtry[] = $typy;
            }

            if(in_array($databaseName, ['pilka_nozna', 'pilka_reczna', 'siatkowka']))
            {
                $select = DB::table($databaseName)->select('łączenie as param', DB::raw('count(łączenie) as ile'));
                $select = CreateSelect($select, $databaseName, 'łączenie', $request);
                $laczenia = new FiltryDane('łączenie', $select);
                $filtry[] = $laczenia;
            }

            if(in_array($databaseName, ['koszykowka', 'pilka_nozna', 'siatkowka']))
            {
                $select = DB::table($databaseName)->select('przeznaczenie as param', DB::raw('count(przeznaczenie) as ile'));
                $select = CreateSelect($select, $databaseName, 'przeznaczenie', $request);
                $przeznaczenia = new FiltryDane('przeznaczenie', $select);
                $filtry[] = $przeznaczenia;
            }
            else if($databaseName == 'tenis_ziemny')
            {
                $select = DB::table($databaseName)->select('typ_nawierzchni as param', DB::raw('count(typ_nawierzchni) as ile'));
                $select = CreateSelect($select, $databaseName, 'typ_nawierzchni', $request);
                $typNawierzchni = new FiltryDane('typ nawierzchni', $select);
                $filtry[] = $typNawierzchni;
            }

            $select = DB::table($databaseName)->select('kolor as param', DB::raw('count(kolor) as ile'));
            $select = CreateSelect($select, $databaseName, 'kolor', $request);
            $kolory = new FiltryDane('kolor', $select);
            $filtry[] = $kolory;

            return $filtry;
        }

        /**
         * Zwraca kolekcję po uprzednim dodaniu wszystkich filtrów.
         *
         * @param Collection $select przygotowana instancja zapytania z użyciem klasy DB.
         * Musi ona już zawierać połączenie z odpowiednią tabelą oraz kolumny, które chce zwrócić
         * @param string $databaseName nazwa bazy danych, z której mają być brane dane
         * @param string $groupByColumn nazwa kolumny, po której grupuje dane. Można wpisać puste, wtedy grupowanie nie nastąpi
         * @param Request $req obiekt Request
         *
         * @return Collection
         */
        function CreateSelect($select, $databaseName, $groupByColumn, $req)
        {
            if($req->marka) $select = $select->whereIn('marka', $req->marka);

            if(in_array($databaseName, ['pilka_nozna', 'pilka_reczna', 'koszykowka', 'siatkowka']) && $req->rozmiar) $select = $select->whereIn('rozmiar', $req->rozmiar);
            else if(in_array($databaseName, ['tenis_ziemny', 'tenis_stolowy']) && $req->typ) $select = $select->whereIn('typ', $req->typ);

            if(in_array($databaseName, ['pilka_nozna', 'pilka_reczna', 'siatkowka']) && $req->łączenie) $select = $select->whereIn('łączenie', $req->łączenie);

            if(in_array($databaseName, ['koszykowka', 'pilka_nozna', 'siatkowka']) && $req->przeznaczenie) $select = $select->whereIn('przeznaczenie', $req->przeznaczenie);
            else if($databaseName == 'tenis_ziemny' && $req->typ_nawierzchni) $select = $select->whereIn('typ_nawierzchni', $req->typ_nawierzchni);

            if($req->kolor) $select = $select->whereIn('kolor', $req->kolor);

            if($req->od != '') $select = $select->where('cena', '>=', $req->od);
            if($req->do != '') $select = $select->where('cena', '<=', $req->do);

            if($groupByColumn != '')  $select = $select->groupBy($groupByColumn)->get();
            else $select = $select->get();

            return $select;
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

        switch($nazwa)
        {
            case 'pilka-nozna':
                return view('kategoria', [
                    'tytul'=>"Piłka nożna",
                    'nazwa'=>$nazwa,
                    'filtry'=>CreateFiltry($request, 'pilka_nozna'),
                    'produkty'=>PilkaNozna::Rekordy($request),
                    'parametry'=>CreateParametry($request, $nazwa)
                ]);
                break;
            case 'pilka-reczna':
                return view('kategoria', [
                    'tytul'=>"Piłka ręczna",
                    'nazwa'=>$nazwa,
                    'filtry'=>CreateFiltry($request, 'pilka_reczna'),
                    'produkty'=>PilkaReczna::Rekordy($request),
                    'parametry'=>CreateParametry($request, $nazwa)
                ]);
                break;
            case 'siatkowka':
                return view('kategoria', [
                    'tytul'=>"Siatkówka",
                    'nazwa'=>$nazwa,
                    'filtry'=>CreateFiltry($request, 'siatkowka'),
                    'produkty'=>Siatkowka::Rekordy($request),
                    'parametry'=>CreateParametry($request, $nazwa)
                ]);
                break;
            case 'koszykowka':
                return view('kategoria', [
                    'tytul'=>"Koszykówka",
                    'nazwa'=>$nazwa,
                    'filtry'=>CreateFiltry($request, 'koszykowka'),
                    'produkty'=>Koszykowka::Rekordy($request),
                    'parametry'=>CreateParametry($request, $nazwa)
                ]);
                break;
            case 'tenis-ziemny':
                return view('kategoria', [
                    'tytul'=>"Tenis ziemny",
                    'nazwa'=>$nazwa,
                    'filtry'=>CreateFiltry($request, 'tenis_ziemny'),
                    'produkty'=>TenisZiemny::Rekordy($request),
                    'parametry'=>CreateParametry($request, $nazwa)
                ]);
                break;
            case 'tenis-stolowy':
                return view('kategoria', [
                    'tytul'=>"Tenis stołowy",
                    'nazwa'=>$nazwa,
                    'filtry'=>CreateFiltry($request, 'tenis_stolowy'),
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
