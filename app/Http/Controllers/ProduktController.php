<?php

namespace App\Http\Controllers;

use App\Models\PilkaNozna;
use App\Models\PilkaReczna;
use App\Models\Koszykowka;
use App\Models\Siatkowka;
use App\Models\TenisStolowy;
use App\Models\TenisZiemny;
use Illuminate\Support\Facades\DB;

class ProduktController extends Controller
{
    function show($nazwa, $id)
    {
        $produkt = null;
        $parametry = [];
        $podobne = [];

        /**
         * Zwraca dwuwymiarową tablicę zawierającą nazwy parametrów oraz ich wartości danego produktu
         * @param string $databaseName nazwa bazy danych, z której brany jest produkt
         * @param string $id id szukanego produktu
         *
         * @return array
         */
        function ProduktCreateParametry($databaseName, $id)
        {
            $columny = DB::select(DB::raw('SHOW COLUMNS FROM '.$databaseName));
            $i = 1;
            $nazwy = [];
            $param = [];
            while($columny[$i]->Field != 'cena')
            {
                $nazwy[] = $columny[$i]->Field;
                $i++;
            }

            $i = 1;

            switch($databaseName)
            {
                case 'pilka_nozna':
                    foreach(PilkaNozna::select($nazwy)->where('id', $id)->get()[0]->toArray() as $value)
                    {
                        $param[] = [$columny[$i]->Field, $value];
                        $i++;
                    }
                    break;
                case 'pilka_reczna':
                    foreach(PilkaReczna::select($nazwy)->where('id', $id)->get()[0]->toArray() as $value)
                    {
                        $param[] = [$columny[$i]->Field, $value];
                        $i++;
                    }
                    break;
                case 'siatkowka':
                    foreach(Siatkowka::select($nazwy)->where('id', $id)->get()[0]->toArray() as $value)
                    {
                        $param[] = [$columny[$i]->Field, $value];
                        $i++;
                    }
                    break;
                case 'koszykowka':
                    foreach(Koszykowka::select($nazwy)->where('id', $id)->get()[0]->toArray() as $value)
                    {
                        $param[] = [$columny[$i]->Field, $value];
                        $i++;
                    }
                    break;
                case 'tenis_ziemny':
                    foreach(TenisZiemny::select($nazwy)->where('id', $id)->get()[0]->toArray() as $value)
                    {
                        $param[] = [$columny[$i]->Field, $value];
                        $i++;
                    }
                    break;
                case 'tenis_stolowy':
                    foreach(TenisStolowy::select($nazwy)->where('id', $id)->get()[0]->toArray() as $value)
                    {
                        $param[] = [$columny[$i]->Field, $value];
                        $i++;
                    }
                    break;
            }

            return $param;
        }

        /**
         * Zwraca tablicę pięciu obiektów klasy PolecaneDane
         *
         * @param string $kategoriaURL nazwa kategorii z URL strony. W ProduktController jest to zmienna $nazwa
         * @param string $id id głównego produktu. Jest potrzebny, żeby się nie wyświetlał w polecanych.
         * W ProduktController jest to ziemnna $id
         *
         * @return array
         */
        function ProduktPolecane($kategoriaURL, $id)
        {
            $select = [];
            $elosiema = null;

            switch($kategoriaURL)
            {
                case 'pilka-nozna':
                    $elosiema = PilkaNozna::where('id', '!=', $id)->inRandomOrder()->limit(5)->get();
                    break;
                case 'pilka-reczna':
                    $elosiema = PilkaReczna::where('id', '!=', $id)->inRandomOrder()->limit(5)->get();
                    break;
                case 'siatkowka':
                    $elosiema = Siatkowka::where('id', '!=', $id)->inRandomOrder()->limit(5)->get();
                    break;
                case 'koszykowka':
                    $elosiema = Koszykowka::where('id', '!=', $id)->inRandomOrder()->limit(5)->get();
                    break;
                case 'tenis-ziemny':
                    $elosiema = TenisZiemny::where('id', '!=', $id)->inRandomOrder()->limit(5)->get();
                    break;
                case 'tenis-stolowy':
                    $elosiema = TenisStolowy::where('id', '!=', $id)->inRandomOrder()->limit(5)->get();
                    break;
            }

            foreach($elosiema as $row)
            {
                $select[] = new PolecaneDane($kategoriaURL, $row);
            }

            return $select;
        }

        switch($nazwa)
        {
            case 'pilka-nozna':
                $produkt = PilkaNozna::where('id', $id)->get();
                $parametry = ProduktCreateParametry('pilka_nozna', $id);
                $podobne = ProduktPolecane($nazwa, $id);
                break;
            case 'pilka-reczna':
                $produkt = PilkaReczna::where('id', $id)->get();
                $parametry = ProduktCreateParametry('pilka_reczna', $id);
                $podobne = ProduktPolecane($nazwa, $id);
                break;
            case 'siatkowka':
                $produkt = Siatkowka::where('id', $id)->get();
                $parametry = ProduktCreateParametry('siatkowka', $id);
                $podobne = ProduktPolecane($nazwa, $id);
                break;
            case 'koszykowka':
                $produkt = Koszykowka::where('id', $id)->get();
                $parametry = ProduktCreateParametry('koszykowka', $id);
                $podobne = ProduktPolecane($nazwa, $id);
                break;
            case 'tenis-stolowy':
                $produkt = TenisStolowy::where('id', $id)->get();
                $parametry = ProduktCreateParametry('tenis_stolowy', $id);
                $podobne = ProduktPolecane($nazwa, $id);
                break;
            case 'tenis-ziemny':
                $produkt = TenisZiemny::where('id', $id)->get();
                $parametry = ProduktCreateParametry('tenis_ziemny', $id);
                $podobne = ProduktPolecane($nazwa, $id);
                break;
        }

        $produkt = $produkt[0];

        return view('produkt', [
            'produkt'=>$produkt,
            'parametry'=>$parametry,
            'podobne'=>$podobne,
            'nazwa'=>$nazwa
        ]);
    }
}
