<?php

namespace App\Http\Controllers;

use App\Models\PilkaNozna;
use App\Models\PilkaReczna;
use App\Models\Koszykowka;
use App\Models\Siatkowka;
use App\Models\TenisStolowy;
use App\Models\TenisZiemny;
use Illuminate\Support\Facades\DB;

class PolecaneDane
{
    function __construct($kategoriaURL, $query)
    {
        $this->kategoriaURL = $kategoriaURL;
        $this->query = $query;
    }
}

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
            $columny = DB::table('INFORMATION_SCHEMA.COLUMNS')->select('COLUMN_NAME as kolumna')->where('TABLE_SCHEMA', 'shopball')->where('TABLE_NAME', $databaseName)->get();
            $i = 1;
            $nazwy = [];
            $param = [];
            while($columny[$i]->kolumna != 'cena')
            {
                $nazwy[] = $columny[$i]->kolumna;
                $i++;
            }

            $i = 1;

            switch($databaseName)
            {
                case 'pilka_nozna':
                    foreach(PilkaNozna::select($nazwy)->where('id', $id)->get()[0]->toArray() as $value)
                    {
                        $param[] = [$columny[$i]->kolumna, $value];
                        $i++;
                    }
                    break;
                case 'pilka_reczna':
                    foreach(PilkaReczna::select($nazwy)->where('id', $id)->get()[0]->toArray() as $value)
                    {
                        $param[] = [$columny[$i]->kolumna, $value];
                        $i++;
                    }
                    break;
                case 'siatkowka':
                    foreach(Siatkowka::select($nazwy)->where('id', $id)->get()[0]->toArray() as $value)
                    {
                        $param[] = [$columny[$i]->kolumna, $value];
                        $i++;
                    }
                    break;
                case 'koszykowka':
                    foreach(Koszykowka::select($nazwy)->where('id', $id)->get()[0]->toArray() as $value)
                    {
                        $param[] = [$columny[$i]->kolumna, $value];
                        $i++;
                    }
                    break;
                case 'tenis_ziemny':
                    foreach(TenisZiemny::select($nazwy)->where('id', $id)->get()[0]->toArray() as $value)
                    {
                        $param[] = [$columny[$i]->kolumna, $value];
                        $i++;
                    }
                    break;
                case 'tenis_stolowy':
                    foreach(TenisStolowy::select($nazwy)->where('id', $id)->get()[0]->toArray() as $value)
                    {
                        $param[] = [$columny[$i]->kolumna, $value];
                        $i++;
                    }
                    break;
            }

            return $param;
        }

        switch($nazwa)
        {
            case 'pilka-nozna':
                $produkt = PilkaNozna::where('id', $id)->get();
                $parametry = ProduktCreateParametry('pilka_nozna', $id);

                $max = PilkaNozna::max('id');
                $podobne = [];
                $posiadane = [];
                $found = 0;
                while($found != 5)
                {
                    $rand = rand(1, $max);
                    if($rand != $id && !in_array($rand, $posiadane))
                    {
                        $select = PilkaNozna::where('id', $rand)->get();
                        if($select)
                        {
                            $podobne[] = new PolecaneDane('pilka-nozna', $select);
                            $posiadane[] = $rand;
                            $found++;
                        }
                    }
                }
                break;
            case 'pilka-reczna':
                $produkt = PilkaReczna::where('id', $id)->get();
                $parametry = ProduktCreateParametry('pilka_reczna', $id);

                $max = PilkaReczna::max('id');
                $podobne = [];
                $posiadane = [];
                $found = 0;
                while($found != 5)
                {
                    $rand = rand(1, $max);
                    if($rand != $id && !in_array($rand, $posiadane))
                    {
                        $select = PilkaReczna::where('id', $rand)->get();
                        if($select)
                        {
                            $podobne[] = new PolecaneDane('pilka-reczna', $select);
                            $posiadane[] = $rand;
                            $found++;
                        }
                    }
                }
                break;
            case 'siatkowka':
                $produkt = Siatkowka::where('id', $id)->get();
                $parametry = ProduktCreateParametry('siatkowka', $id);

                $max = Siatkowka::max('id');
                $podobne = [];
                $posiadane = [];
                $found = 0;
                while($found != 5)
                {
                    $rand = rand(1, $max);
                    if($rand != $id && !in_array($rand, $posiadane))
                    {
                        $select = Siatkowka::where('id', $rand)->get();
                        if($select)
                        {
                            $podobne[] = new PolecaneDane('siatkowka', $select);
                            $posiadane[] = $rand;
                            $found++;
                        }
                    }
                }
                break;
            case 'koszykowka':
                $produkt = Koszykowka::where('id', $id)->get();
                $parametry = ProduktCreateParametry('koszykowka', $id);

                $max = Koszykowka::max('id');
                $podobne = [];
                $posiadane = [];
                $found = 0;
                while($found != 5)
                {
                    $rand = rand(1, $max);
                    if($rand != $id && !in_array($rand, $posiadane))
                    {
                        $select = Koszykowka::where('id', $rand)->get();
                        if($select)
                        {
                            $podobne[] = new PolecaneDane('koszykowka', $select);
                            $posiadane[] = $rand;
                            $found++;
                        }
                    }
                }
                break;
            case 'tenis-stolowy':
                $produkt = TenisStolowy::where('id', $id)->get();
                $parametry = ProduktCreateParametry('tenis_stolowy', $id);

                $max = TenisStolowy::max('id');
                $podobne = [];
                $posiadane = [];
                $found = 0;
                while($found != 5)
                {
                    $rand = rand(1, $max);
                    if($rand != $id && !in_array($rand, $posiadane))
                    {
                        $select = TenisStolowy::where('id', $rand)->get();
                        if($select)
                        {
                            $podobne[] = new PolecaneDane('tenis-stolowy', $select);
                            $posiadane[] = $rand;
                            $found++;
                        }
                    }
                }
                break;
            case 'tenis-ziemny':
                $produkt = TenisZiemny::where('id', $id)->get();
                $parametry = ProduktCreateParametry('tenis_ziemny', $id);

                $max = TenisZiemny::max('id');
                $podobne = [];
                $posiadane = [];
                $found = 0;
                while($found != 5)
                {
                    $rand = rand(1, $max);
                    if($rand != $id && !in_array($rand, $posiadane))
                    {
                        $select = TenisZiemny::where('id', $rand)->get();
                        if($select)
                        {
                            $podobne[] = new PolecaneDane('tenis-ziemny', $select);
                            $posiadane[] = $rand;
                            $found++;
                        }
                    }
                }
                break;
        }

        $produkt = $produkt[0];

        return view('produkt', [
            'produkt'=>$produkt,
            'parametry'=>$parametry,
            'podobne'=>$podobne
        ]);
    }
}
