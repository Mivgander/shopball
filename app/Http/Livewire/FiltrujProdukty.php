<?php

namespace App\Http\Livewire;

use App\Models\Koszykowka;
use App\Models\PilkaNozna;
use App\Models\PilkaReczna;
use App\Models\Siatkowka;
use App\Models\TenisStolowy;
use App\Models\TenisZiemny;
use Livewire\Component;
use Livewire\WithPagination;

class FiltryDane
{
    function __construct($nazwa, $query)
    {
        $this->nazwa = $nazwa;
        $this->query = $query;
    }
}

class FiltrujProdukty extends Component
{
    use WithPagination;

    public $nazwa = '';
    public $tytul = '';

    /* FILTRY */
    public $marka = [];
    public $rozmiar = [];
    public $typ = [];
    public $łączenie = [];
    public $przeznaczenie = [];
    public $typ_nawierzchni = [];
    public $kolor = [];
    public $od = '';
    public $do = '';
    /* FILTRY */

    protected $queryString = [
        'marka' => ['except' => []],
        'rozmiar' => ['except' => []],
        'typ' => ['except' => []],
        'łączenie' => ['except' => []],
        'przeznaczenie' => ['except' => []],
        'typ_nawierzchni' => ['except' => []],
        'kolor' => ['except' => []],
        'od' => ['except' => ''],
        'do' => ['except' => '']
    ];

    public function FiltryReset()
    {
        $this->marka = [];
        $this->rozmiar = [];
        $this->typ = [];
        $this->łączenie = [];
        $this->przeznaczenie = [];
        $this->typ_nawierzchni = [];
        $this->kolor = [];
        $this->od = '';
        $this->do = '';
    }

    public function render()
    {
        switch($this->nazwa)
        {
            case 'pilka-nozna':
                $filtry = $this->FiltrujCreateFiltry($this->nazwa);
                return view('livewire.filtruj-produkty', [
                    'produkty'=>$this->FiltrujCreateSelect(PilkaNozna::where('id', '>=', '1'), $this->nazwa, true),
                    'filtry'=>$this->FiltrujSortujFiltry($filtry),
                    'parametry'=>$this->FiltrujCreateParametry($this->nazwa),
                    'tytul'=>$this->tytul,
                    'request'=>[
                        'marka' => $this->marka,
                        'rozmiar' => $this->rozmiar,
                        'typ' => $this->typ,
                        'łączenie' => $this->łączenie,
                        'przeznaczenie' => $this->przeznaczenie,
                        'typ_nawierzchni' => $this->typ_nawierzchni,
                        'kolor' => $this->kolor,
                        'od' => $this->od,
                        'do' => $this->do
                    ]
                ]);
                break;
            case 'pilka-reczna':
                $filtry = $this->FiltrujCreateFiltry($this->nazwa);
                return view('livewire.filtruj-produkty', [
                    'produkty'=>$this->FiltrujCreateSelect(PilkaReczna::where('id', '>=', '1'), $this->nazwa, true),
                    'filtry'=>$this->FiltrujSortujFiltry($filtry),
                    'parametry'=>$this->FiltrujCreateParametry($this->nazwa),
                    'tytul'=>$this->tytul,
                    'request'=>[
                        'marka' => $this->marka,
                        'rozmiar' => $this->rozmiar,
                        'typ' => $this->typ,
                        'łączenie' => $this->łączenie,
                        'przeznaczenie' => $this->przeznaczenie,
                        'typ_nawierzchni' => $this->typ_nawierzchni,
                        'kolor' => $this->kolor,
                        'od' => $this->od,
                        'do' => $this->do
                    ]
                ]);
                break;
            case 'siatkowka':
                $filtry = $this->FiltrujCreateFiltry($this->nazwa);
                return view('livewire.filtruj-produkty', [
                    'produkty'=>$this->FiltrujCreateSelect(Siatkowka::where('id', '>=', '1'), $this->nazwa, true),
                    'filtry'=>$this->FiltrujSortujFiltry($filtry),
                    'parametry'=>$this->FiltrujCreateParametry($this->nazwa),
                    'tytul'=>$this->tytul,
                    'request'=>[
                        'marka' => $this->marka,
                        'rozmiar' => $this->rozmiar,
                        'typ' => $this->typ,
                        'łączenie' => $this->łączenie,
                        'przeznaczenie' => $this->przeznaczenie,
                        'typ_nawierzchni' => $this->typ_nawierzchni,
                        'kolor' => $this->kolor,
                        'od' => $this->od,
                        'do' => $this->do
                    ]
                ]);
                break;
            case 'koszykowka':
                $filtry = $this->FiltrujCreateFiltry($this->nazwa);
                return view('livewire.filtruj-produkty', [
                    'produkty'=>$this->FiltrujCreateSelect(Koszykowka::where('id', '>=', '1'), $this->nazwa, true),
                    'filtry'=>$this->FiltrujSortujFiltry($filtry),
                    'parametry'=>$this->FiltrujCreateParametry($this->nazwa),
                    'tytul'=>$this->tytul,
                    'request'=>[
                        'marka' => $this->marka,
                        'rozmiar' => $this->rozmiar,
                        'typ' => $this->typ,
                        'łączenie' => $this->łączenie,
                        'przeznaczenie' => $this->przeznaczenie,
                        'typ_nawierzchni' => $this->typ_nawierzchni,
                        'kolor' => $this->kolor,
                        'od' => $this->od,
                        'do' => $this->do
                    ]
                ]);
                break;
            case 'tenis-ziemny':
                $filtry = $this->FiltrujCreateFiltry($this->nazwa);
                return view('livewire.filtruj-produkty', [
                    'produkty'=>$this->FiltrujCreateSelect(TenisZiemny::where('id', '>=', '1'), $this->nazwa, true),
                    'filtry'=>$this->FiltrujSortujFiltry($filtry),
                    'parametry'=>$this->FiltrujCreateParametry($this->nazwa),
                    'tytul'=>$this->tytul,
                    'request'=>[
                        'marka' => $this->marka,
                        'rozmiar' => $this->rozmiar,
                        'typ' => $this->typ,
                        'łączenie' => $this->łączenie,
                        'przeznaczenie' => $this->przeznaczenie,
                        'typ_nawierzchni' => $this->typ_nawierzchni,
                        'kolor' => $this->kolor,
                        'od' => $this->od,
                        'do' => $this->do
                    ]
                ]);
                break;
            case 'tenis-stolowy':
                $filtry = $this->FiltrujCreateFiltry($this->nazwa);
                return view('livewire.filtruj-produkty', [
                    'produkty'=>$this->FiltrujCreateSelect(TenisStolowy::where('id', '>=', '1'), $this->nazwa, true),
                    'filtry'=>$this->FiltrujSortujFiltry($filtry),
                    'parametry'=>$this->FiltrujCreateParametry($this->nazwa),
                    'tytul'=>$this->tytul,
                    'request'=>[
                        'marka' => $this->marka,
                        'rozmiar' => $this->rozmiar,
                        'typ' => $this->typ,
                        'łączenie' => $this->łączenie,
                        'przeznaczenie' => $this->przeznaczenie,
                        'typ_nawierzchni' => $this->typ_nawierzchni,
                        'kolor' => $this->kolor,
                        'od' => $this->od,
                        'do' => $this->do
                    ]
                ]);
                break;
            default:
                return "Nie ma!";
                break;
        }
    }

    private function FiltrujCreateSelect($select, $nazwa, $paginate)
    {
        if($this->marka) $select = $select->whereIn('marka', $this->marka);

        if(in_array($nazwa, ['pilka-nozna', 'pilka-reczna', 'koszykowka', 'siatkowka']) && $this->rozmiar) $select = $select->whereIn('rozmiar', $this->rozmiar);
        else if(in_array($nazwa, ['tenis-ziemny', 'tenis_stolowy']) && $this->typ) $select = $select->whereIn('typ', $this->typ);

        if(in_array($nazwa, ['pilka-nozna', 'pilka-reczna', 'siatkowka']) && $this->łączenie) $select = $select->whereIn('łączenie', $this->łączenie);

        if(in_array($nazwa, ['koszykowka', 'pilka-nozna', 'siatkowka']) && $this->przeznaczenie) $select = $select->whereIn('przeznaczenie', $this->przeznaczenie);
        else if($nazwa == 'tenis-ziemny' && $this->typ_nawierzchni) $select = $select->whereIn('typ_nawierzchni', $this->typ_nawierzchni);

        if($this->kolor) $select = $select->whereIn('kolor', $this->kolor);

        if($this->od != '') $select = $select->where('cena', '>=', $this->od);
        if($this->do != '') $select = $select->where('cena', '<=', $this->do);

        if($paginate)
        {
            $select = $select->paginate(10);
            $select = $select->withQueryString();
            return $select;
        }
        else
        {
            return $select->get();
        }
    }

    private function FiltrujCreateParametry($nazwa)
    {
        $parametry = [];
        switch($nazwa)
        {
            case 'pilka-nozna':
                $data = $this->FiltrujCreateSelect(PilkaNozna::where('id', '>=', '1'), $nazwa, true);
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
                $data = $this->FiltrujCreateSelect(Siatkowka::where('id', '>=', '1'), $nazwa, true);
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
                $data = $this->FiltrujCreateSelect(PilkaReczna::where('id', '>=', '1'), $nazwa, true);
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
                $data = $this->FiltrujCreateSelect(Koszykowka::where('id', '>=', '1'), $nazwa, true);
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
                $data = $this->FiltrujCreateSelect(TenisZiemny::where('id', '>=', '1'), $nazwa, true);
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
                $data = $this->FiltrujCreateSelect(TenisStolowy::where('id', '>=', '1'), $nazwa, true);
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

    private function FiltrujSortujFiltry($filtry)
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

    private function FiltrujCreateFiltry($nazwa)
    {
        $filtry = [];
        switch($nazwa)
        {
            case 'pilka-nozna':
                /* PRZYGOTOWYWANIE ZMIENNYCH */
                $przedmiotyBezFiltrow = PilkaNozna::all();
                $marki = [];
                $rozmiary = [];
                $laczenia = [];
                $przeznaczenia = [];
                $kolory = [];
                /* PRZYGOTOWYWANIE ZMIENNYCH */

                /* POBIERANIE WSZYSTKICH MOŻLIWYCH FILTRÓW */
                foreach($przedmiotyBezFiltrow as $row)
                {
                    if(!in_array($row->marka, $marki)) $marki[] = $row->marka;
                    if(!in_array($row->rozmiar, $rozmiary)) $rozmiary[] = $row->rozmiar;
                    if(!in_array($row->łączenie, $laczenia)) $laczenia[] = $row->łączenie;
                    if(!in_array($row->przeznaczenie, $przeznaczenia)) $przeznaczenia[] = $row->przeznaczenie;
                    if(!in_array($row->kolor, $kolory)) $kolory[] = $row->kolor;
                }
                /* POBIERANIE WSZYSTKICH MOŻLIWYCH FILTRÓW */

                /* PRZYGOTOWYWANIE TABLIC LICZĄCYCH */
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
                /* PRZYGOTOWYWANIE TABLIC LICZĄCYCH */

                /* LICZENIE FILTRÓW */
                foreach($this->CreateSubselect(PilkaNozna::where('id', '>=', '1'), $nazwa, 'marka', false) as $row)
                {
                    $key = array_search($row->marka, $marki);
                    if($key !== false) $liczbaMarki[$key]++;
                }

                foreach($this->CreateSubselect(PilkaNozna::where('id', '>=', '1'), $nazwa, 'rozmiar', false) as $row)
                {
                    $key = array_search($row->rozmiar, $rozmiary);
                    if($key !== false) $liczbaRozmiary[$key]++;
                }

                foreach($this->CreateSubselect(PilkaNozna::where('id', '>=', '1'), $nazwa, 'łączenie', false) as $row)
                {
                    $key = array_search($row->łączenie, $laczenia);
                    if($key !== false) $liczbaLaczenia[$key]++;
                }

                foreach($this->CreateSubselect(PilkaNozna::where('id', '>=', '1'), $nazwa, 'przeznaczenie', false) as $row)
                {
                    $key = array_search($row->przeznaczenie, $przeznaczenia);
                    if($key !== false) $liczbaPrzeznaczenia[$key]++;
                }

                foreach($this->CreateSubselect(PilkaNozna::where('id', '>=', '1'), $nazwa, 'kolor', false) as $row)
                {
                    $key = array_search($row->kolor, $kolory);
                    if($key !== false) $liczbaKolory[$key]++;
                }
                /* LICZENIE FILTRÓW */

                /* UPOrzĄDKOWYWANIE WSZYSTKIEGO */
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
                /* UPOrzĄDKOWYWANIE WSZYSTKIEGO */

                break;
            case 'pilka-reczna':
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

                /* LICZENIE FILTRÓW */
                foreach($this->CreateSubselect(PilkaReczna::where('id', '>=', '1'), $nazwa, 'marka', false) as $row)
                {
                    $key = array_search($row->marka, $marki);
                    if($key !== false) $liczbaMarki[$key]++;
                }

                foreach($this->CreateSubselect(PilkaReczna::where('id', '>=', '1'), $nazwa, 'rozmiar', false) as $row)
                {
                    $key = array_search($row->rozmiar, $rozmiary);
                    if($key !== false) $liczbaRozmiary[$key]++;
                }

                foreach($this->CreateSubselect(PilkaReczna::where('id', '>=', '1'), $nazwa, 'łączenie', false) as $row)
                {
                    $key = array_search($row->łączenie, $laczenia);
                    if($key !== false) $liczbaLaczenia[$key]++;
                }

                foreach($this->CreateSubselect(PilkaReczna::where('id', '>=', '1'), $nazwa, 'kolor', false) as $row)
                {
                    $key = array_search($row->kolor, $kolory);
                    if($key !== false) $liczbaKolory[$key]++;
                }
                /* LICZENIE FILTRÓW */

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

                /* LICZENIE FILTRÓW */
                foreach($this->CreateSubselect(Siatkowka::where('id', '>=', '1'), $nazwa, 'marka', false) as $row)
                {
                    $key = array_search($row->marka, $marki);
                    if($key !== false) $liczbaMarki[$key]++;
                }

                foreach($this->CreateSubselect(Siatkowka::where('id', '>=', '1'), $nazwa, 'rozmiar', false) as $row)
                {
                    $key = array_search($row->rozmiar, $rozmiary);
                    if($key !== false) $liczbaRozmiary[$key]++;
                }

                foreach($this->CreateSubselect(Siatkowka::where('id', '>=', '1'), $nazwa, 'łączenie', false) as $row)
                {
                    $key = array_search($row->łączenie, $laczenia);
                    if($key !== false) $liczbaLaczenia[$key]++;
                }

                foreach($this->CreateSubselect(Siatkowka::where('id', '>=', '1'), $nazwa, 'przeznaczenie', false) as $row)
                {
                    $key = array_search($row->przeznaczenie, $przeznaczenia);
                    if($key !== false) $liczbaPrzeznaczenia[$key]++;
                }

                foreach($this->CreateSubselect(Siatkowka::where('id', '>=', '1'), $nazwa, 'kolor', false) as $row)
                {
                    $key = array_search($row->kolor, $kolory);
                    if($key !== false) $liczbaKolory[$key]++;
                }
                /* LICZENIE FILTRÓW */

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

                /* LICZENIE FILTRÓW */
                foreach($this->CreateSubselect(Koszykowka::where('id', '>=', '1'), $nazwa, 'marka', false) as $row)
                {
                    $key = array_search($row->marka, $marki);
                    if($key !== false) $liczbaMarki[$key]++;
                }

                foreach($this->CreateSubselect(Koszykowka::where('id', '>=', '1'), $nazwa, 'rozmiar', false) as $row)
                {
                    $key = array_search($row->rozmiar, $rozmiary);
                    if($key !== false) $liczbaRozmiary[$key]++;
                }

                foreach($this->CreateSubselect(Koszykowka::where('id', '>=', '1'), $nazwa, 'przeznaczenie', false) as $row)
                {
                    $key = array_search($row->przeznaczenie, $przeznaczenia);
                    if($key !== false) $liczbaPrzeznaczenia[$key]++;
                }

                foreach($this->CreateSubselect(Koszykowka::where('id', '>=', '1'), $nazwa, 'kolor', false) as $row)
                {
                    $key = array_search($row->kolor, $kolory);
                    if($key !== false) $liczbaKolory[$key]++;
                }
                /* LICZENIE FILTRÓW */

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
            case 'tenis-ziemny':
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

                /* LICZENIE FILTRÓW */
                foreach($this->CreateSubselect(TenisZiemny::where('id', '>=', '1'), $nazwa, 'marka', false) as $row)
                {
                    $key = array_search($row->marka, $marki);
                    if($key !== false) $liczbaMarki[$key]++;
                }

                foreach($this->CreateSubselect(TenisZiemny::where('id', '>=', '1'), $nazwa, 'typ', false) as $row)
                {
                    $key = array_search($row->typ, $typy);
                    if($key !== false) $liczbaTypy[$key]++;
                }

                foreach($this->CreateSubselect(TenisZiemny::where('id', '>=', '1'), $nazwa, 'typ_nawierzchni', false) as $row)
                {
                    $key = array_search($row->typ_nawierzchni, $typy_nawierzchni);
                    if($key !== false) $liczbaTypyNawierzchni[$key]++;
                }

                foreach($this->CreateSubselect(TenisZiemny::where('id', '>=', '1'), $nazwa, 'kolor', false) as $row)
                {
                    $key = array_search($row->kolor, $kolory);
                    if($key !== false) $liczbaKolory[$key]++;
                }
                /* LICZENIE FILTRÓW */

                $filtry = [];
                $param = [];

                for($i=0; $i<count($marki); $i++) $param[] = ['param' => $marki[$i], 'ile' => $liczbaMarki[$i]];
                $filtry[] = new FiltryDane('marka', $param);
                $param = [];

                for($i=0; $i<count($typy); $i++) $param[] = ['param' => $typy[$i], 'ile' => $liczbaTypy[$i]];
                $filtry[] = new FiltryDane('typ', $param);
                $param = [];

                for($i=0; $i<count($typy_nawierzchni); $i++) $param[] = ['param' => $typy_nawierzchni[$i], 'ile' => $liczbaTypyNawierzchni[$i]];
                $filtry[] = new FiltryDane('typ_nawierzchni', $param);
                $param = [];

                for($i=0; $i<count($kolory); $i++) $param[] = ['param' => $kolory[$i], 'ile' => $liczbaKolory[$i]];
                $filtry[] = new FiltryDane('kolor', $param);
                break;
            case 'tenis-stolowy':
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
                $liczbaKolory = [];

                for($i=0; $i<count($marki); $i++) $liczbaMarki[] = 0;
                for($i=0; $i<count($typy); $i++) $liczbaTypy[] = 0;
                for($i=0; $i<count($kolory); $i++) $liczbaKolory[] = 0;

                /* LICZENIE FILTRÓW */
                foreach($this->CreateSubselect(TenisStolowy::where('id', '>=', '1'), $nazwa, 'marka', false) as $row)
                {
                    $key = array_search($row->marka, $marki);
                    if($key !== false) $liczbaMarki[$key]++;
                }

                foreach($this->CreateSubselect(TenisStolowy::where('id', '>=', '1'), $nazwa, 'typ', false) as $row)
                {
                    $key = array_search($row->typ, $typy);
                    if($key !== false) $liczbaTypy[$key]++;
                }

                foreach($this->CreateSubselect(TenisStolowy::where('id', '>=', '1'), $nazwa, 'kolor', false) as $row)
                {
                    $key = array_search($row->kolor, $kolory);
                    if($key !== false) $liczbaKolory[$key]++;
                }
                /* LICZENIE FILTRÓW */

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

    function CreateSubselect($select, $nazwa, $whichParamSkip, $paginate)
    {
        if($whichParamSkip != 'marka' && $this->marka) $select = $select->whereIn('marka', $this->marka);

        if($whichParamSkip != 'rozmiar' && in_array($nazwa, ['pilka-nozna', 'pilka-reczna', 'koszykowka', 'siatkowka']) && $this->rozmiar) $select = $select->whereIn('rozmiar', $this->rozmiar);
        else if($whichParamSkip != 'typ' && in_array($nazwa, ['tenis-ziemny', 'tenis_stolowy']) && $this->typ) $select = $select->whereIn('typ', $this->typ);

        if($whichParamSkip != 'łączenie' && in_array($nazwa, ['pilka-nozna', 'pilka-reczna', 'siatkowka']) && $this->łączenie) $select = $select->whereIn('łączenie', $this->łączenie);

        if($whichParamSkip != 'przeznaczenie' && in_array($nazwa, ['koszykowka', 'pilka-nozna', 'siatkowka']) && $this->przeznaczenie) $select = $select->whereIn('przeznaczenie', $this->przeznaczenie);
        else if($whichParamSkip != 'typ_nawierzchni' && $nazwa == 'tenis-ziemny' && $this->typ_nawierzchni) $select = $select->whereIn('typ_nawierzchni', $this->typ_nawierzchni);

        if($whichParamSkip != 'kolor' && $this->kolor) $select = $select->whereIn('kolor', $this->kolor);

        if($this->od != '') $select = $select->where('cena', '>=', $this->od);
        if($this->do != '') $select = $select->where('cena', '<=', $this->do);

        if($paginate)
        {
            $select = $select->paginate(10);
            $select = $select->withQueryString();
            return $select;
        }
        else
        {
            return $select->get();
        }
    }
}
