<?php

namespace App\Http\Livewire;

use App\Models\Koszykowka;
use App\Models\PilkaNozna;
use App\Models\PilkaReczna;
use App\Models\Siatkowka;
use App\Models\TenisStolowy;
use App\Models\TenisZiemny;
use App\Http\Controllers\PolecaneDane;
use Livewire\Component;
use App\Http\Livewire\FiltryDane;

class SzukajFiltrujProdukty extends Component
{
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

    public $szukanaKategoria = '';
    public $szukanyTekst = '';
    public $szukajProdukty = [];
    public $szukajParametry = [];
    public $szukajFiltry = [];

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

    public function render()
    {
        $this->SzukajMain();
        return view('livewire.szukaj-filtruj-produkty', [
            'produkty'=>$this->szukajProdukty,
            'filtry'=>$this->FiltrujSortujFiltry($this->szukajFiltry),
            'parametry'=>$this->szukajParametry,
            'request'=>[
                'marka'=>$this->marka,
                'kolor'=>$this->kolor,
                'od'=>$this->od,
                'do'=>$this->do
            ]
        ]);
    }

    function SzukajMain()
    {
        $produktyBezFiltrow = [];
        $this->szukajProdukty = [];
        $this->szukajParametry = [];
        $this->szukajFiltry = [];

        switch($this->szukanaKategoria)
        {
            case 'wszedzie':
                $kategorie = [];

                if(PilkaNozna::where('tytul', 'LIKE', '%'.$this->szukanyTekst.'%')->get()->count() > 0)
                {
                    foreach(PilkaNozna::where('tytul', 'LIKE', '%'.$this->szukanyTekst.'%')->get() as $row)
                    {
                        $produktyBezFiltrow[] = $row;
                    }

                    foreach($this->SzukajCreateSelect('pilka-nozna', '') as $row)
                    {
                        $this->szukajProdukty[] = new PolecaneDane('pilka-nozna', $row);
                        $this->szukajParametry[] = $this->SzukajCreateParametry('pilka-nozna', $row);
                    }

                    $kategorie[] = 'pilka-nozna';
                }

                if(PilkaReczna::where('tytul', 'LIKE', '%'.$this->szukanyTekst.'%')->get()->count() > 0)
                {
                    foreach(PilkaReczna::where('tytul', 'LIKE', '%'.$this->szukanyTekst.'%')->get() as $row)
                    {
                        $produktyBezFiltrow[] = $row;
                    }

                    foreach($this->SzukajCreateSelect('pilka-reczna', '') as $row)
                    {
                        $this->szukajProdukty[] = new PolecaneDane('pilka-reczna', $row);
                        $this->szukajParametry[] = $this->SzukajCreateParametry('pilka-reczna', $row);
                    }

                    $kategorie[] = 'pilka-reczna';
                }

                if(Siatkowka::where('tytul', 'LIKE', '%'.$this->szukanyTekst.'%')->get()->count() > 0)
                {
                    foreach(Siatkowka::where('tytul', 'LIKE', '%'.$this->szukanyTekst.'%')->get() as $row)
                    {
                        $produktyBezFiltrow[] = $row;
                    }

                    foreach($this->SzukajCreateSelect('siatkowka', '') as $row)
                    {
                        $this->szukajProdukty[] = new PolecaneDane('siatkowka', $row);
                        $this->szukajParametry[] = $this->SzukajCreateParametry('siatkowka', $row);
                    }

                    $kategorie[] = 'siatkowka';
                }

                if(Koszykowka::where('tytul', 'LIKE', '%'.$this->szukanyTekst.'%')->get()->count() > 0)
                {
                    foreach(Koszykowka::where('tytul', 'LIKE', '%'.$this->szukanyTekst.'%')->get() as $row)
                    {
                        $produktyBezFiltrow[] = $row;
                    }

                    foreach($this->SzukajCreateSelect('koszykowka', '') as $row)
                    {
                        $this->szukajProdukty[] = new PolecaneDane('koszykowka', $row);
                        $this->szukajParametry[] = $this->SzukajCreateParametry('koszykowka', $row);
                    }

                    $kategorie[] = 'koszykowka';
                }

                if(TenisZiemny::where('tytul', 'LIKE', '%'.$this->szukanyTekst.'%')->get()->count() > 0)
                {
                    foreach(TenisZiemny::where('tytul', 'LIKE', '%'.$this->szukanyTekst.'%')->get() as $row)
                    {
                        $produktyBezFiltrow[] = $row;
                    }

                    foreach($this->SzukajCreateSelect('tenis-ziemny', '') as $row)
                    {
                        $this->szukajProdukty[] = new PolecaneDane('tenis-ziemny', $row);
                        $this->szukajParametry[] = $this->SzukajCreateParametry('tenis-ziemny', $row);
                    }

                    $kategorie[] = 'tenis-ziemny';
                }

                if(TenisStolowy::where('tytul', 'LIKE', '%'.$this->szukanyTekst.'%')->get()->count() > 0)
                {
                    foreach(TenisStolowy::where('tytul', 'LIKE', '%'.$this->szukanyTekst.'%')->get() as $row)
                    {
                        $produktyBezFiltrow[] = $row;
                    }

                    foreach($this->SzukajCreateSelect('tenis-stolowy', '') as $row)
                    {
                        $this->szukajProdukty[] = new PolecaneDane('tenis-stolowy', $row);
                        $this->szukajParametry[] = $this->SzukajCreateParametry('tenis-stolowy', $row);
                    }

                    $kategorie[] = 'tenis-stolowy';
                }

                $this->szukajFiltry = $this->SzukajCreateFiltry($produktyBezFiltrow, $kategorie);
                break;
            case 'pilka_nozna':
                foreach(PilkaNozna::where('tytul', 'LIKE', '%'.$this->szukanyTekst.'%')->get() as $row)
                {
                    $produktyBezFiltrow[] = $row;
                }

                foreach($this->SzukajCreateSelect('pilka-nozna', '') as $row)
                {
                    $this->szukajProdukty[] = new PolecaneDane('pilka-nozna', $row);
                    $this->szukajParametry[] = $this->SzukajCreateParametry('pilka-nozna', $row);
                }

                $this->szukajFiltry = $this->SzukajCreateFiltry($produktyBezFiltrow, ['pilka-nozna']);
                break;
            case 'pilka_reczna':
                foreach(PilkaReczna::where('tytul', 'LIKE', '%'.$this->szukanyTekst.'%')->get() as $row)
                {
                    $produktyBezFiltrow[] = $row;
                }

                foreach($this->SzukajCreateSelect('pilka-reczna', '') as $row)
                {
                    $this->szukajProdukty[] = new PolecaneDane('pilka-reczna', $row);
                    $this->szukajParametry[] = $this->SzukajCreateParametry('pilka-reczna', $row);
                }

                $this->szukajFiltry = $this->SzukajCreateFiltry($produktyBezFiltrow, ['pilka-reczna']);
                break;
            case 'siatkowka':
                foreach(Siatkowka::where('tytul', 'LIKE', '%'.$this->szukanyTekst.'%')->get() as $row)
                {
                    $produktyBezFiltrow[] = $row;
                }

                foreach($this->SzukajCreateSelect('siatkowka', '') as $row)
                {
                    $this->szukajProdukty[] = new PolecaneDane('siatkowka', $row);
                    $this->szukajParametry[] = $this->SzukajCreateParametry('siatkowka', $row);
                }

                $this->szukajFiltry = $this->SzukajCreateFiltry($produktyBezFiltrow, ['siatkowka']);
                break;
            case 'koszykowka':
                foreach(Koszykowka::where('tytul', 'LIKE', '%'.$this->szukanyTekst.'%')->get() as $row)
                {
                    $produktyBezFiltrow[] = $row;
                }

                foreach($this->SzukajCreateSelect('koszykowka', '') as $row)
                {
                    $this->szukajProdukty[] = new PolecaneDane('koszykowka', $row);
                    $this->szukajParametry[] = $this->SzukajCreateParametry('koszykowka', $row);
                }

                $this->szukajFiltry = $this->SzukajCreateFiltry($produktyBezFiltrow, ['koszykowka']);
                break;
            case 'tenis_ziemny':
                foreach(TenisZiemny::where('tytul', 'LIKE', '%'.$this->szukanyTekst.'%')->get() as $row)
                {
                    $produktyBezFiltrow[] = $row;
                }

                foreach($this->SzukajCreateSelect('tenis-ziemny', '') as $row)
                {
                    $this->szukajProdukty[] = new PolecaneDane('tenis-ziemny', $row);
                    $this->szukajParametry[] = $this->SzukajCreateParametry('tenis-ziemny', $row);
                }

                $this->szukajFiltry = $this->SzukajCreateFiltry($produktyBezFiltrow, ['tenis-ziemny']);
                break;
            case 'tenis_stolowy':
                foreach(TenisStolowy::where('tytul', 'LIKE', '%'.$this->szukanyTekst.'%')->get() as $row)
                {
                    $produktyBezFiltrow[] = $row;
                }

                foreach($this->SzukajCreateSelect('tenis-stolowy', '') as $row)
                {
                    $this->szukajProdukty[] = new PolecaneDane('tenis-stolowy', $row);
                    $this->szukajParametry[] = $this->SzukajCreateParametry('tenis-stolowy', $row);
                }

                $this->szukajFiltry = $this->SzukajCreateFiltry($produktyBezFiltrow, ['tenis-stolowy']);
                break;
        }
    }

    function SzukajCreateSelect($kategoria, $witchParamSkip)
    {
        $pytanie = null;

        switch($kategoria)
        {
            case 'pilka-nozna':
                $pytanie = PilkaNozna::where('tytul','LIKE', '%'.$this->szukanyTekst.'%');
                break;
            case 'pilka-reczna':
                $pytanie = PilkaReczna::where('tytul','LIKE', '%'.$this->szukanyTekst.'%');
                break;
            case 'siatkowka':
                $pytanie = Siatkowka::where('tytul','LIKE', '%'.$this->szukanyTekst.'%');
                break;
            case 'koszykowka':
                $pytanie = Koszykowka::where('tytul','LIKE', '%'.$this->szukanyTekst.'%');
                break;
            case 'tenis-ziemny':
                $pytanie = TenisZiemny::where('tytul','LIKE', '%'.$this->szukanyTekst.'%');
                break;
            case 'tenis-stolowy':
                $pytanie = TenisStolowy::where('tytul','LIKE', '%'.$this->szukanyTekst.'%');
                break;
        }

        if($witchParamSkip != 'marka' && $this->marka != []) $pytanie = $pytanie->whereIn('marka', $this->marka);
        if($witchParamSkip != 'kolor' && $this->kolor != []) $pytanie = $pytanie->whereIn('kolor', $this->kolor);
        if($this->od != '') $pytanie = $pytanie->where('cena', '>=', $this->od);
        if($this->do != '') $pytanie = $pytanie->where('cena', '<=', $this->do);

        return $pytanie->get();
    }

    function SzukajCreateFiltry($produktyBezFiltrow, $kategorie)
    {
        $marki = [];
        $kolory = [];

        foreach($produktyBezFiltrow as $row)
        {
            if(!in_array($row->marka, $marki)) $marki[] = $row->marka;
            if(!in_array($row->kolor, $kolory)) $kolory[] = $row->kolor;
        }

        $liczbaMarki = [];
        $liczbaKolory = [];

        for($i=0; $i<count($marki); $i++) $liczbaMarki[] = 0;
        for($i=0; $i<count($kolory); $i++) $liczbaKolory[] = 0;

        if(in_array('pilka-nozna', $kategorie))
        {
            foreach($this->SzukajCreateSelect('pilka-nozna', 'marka') as $row)
            {
                $key = array_search($row->marka, $marki);
                if($key !== false) $liczbaMarki[$key]++;
            }

            foreach($this->SzukajCreateSelect('pilka-nozna', 'kolor') as $row)
            {
                $key = array_search($row->kolor, $kolory);
                if($key !== false) $liczbaKolory[$key]++;
            }
        }
        if(in_array('pilka-reczna', $kategorie))
        {
            foreach($this->SzukajCreateSelect('pilka-reczna', 'marka') as $row)
            {
                $key = array_search($row->marka, $marki);
                if($key !== false) $liczbaMarki[$key]++;
            }

            foreach($this->SzukajCreateSelect('pilka-reczna', 'kolor') as $row)
            {
                $key = array_search($row->kolor, $kolory);
                if($key !== false) $liczbaKolory[$key]++;
            }
        }
        if(in_array('siatkowka', $kategorie))
        {
            foreach($this->SzukajCreateSelect('siatkowka', 'marka') as $row)
            {
                $key = array_search($row->marka, $marki);
                if($key !== false) $liczbaMarki[$key]++;
            }

            foreach($this->SzukajCreateSelect('siatkowka', 'kolor') as $row)
            {
                $key = array_search($row->kolor, $kolory);
                if($key !== false) $liczbaKolory[$key]++;
            }
        }
        if(in_array('koszykowka', $kategorie))
        {
            foreach($this->SzukajCreateSelect('koszykowka', 'marka') as $row)
            {
                $key = array_search($row->marka, $marki);
                if($key !== false) $liczbaMarki[$key]++;
            }

            foreach($this->SzukajCreateSelect('koszykowka', 'kolor') as $row)
            {
                $key = array_search($row->kolor, $kolory);
                if($key !== false) $liczbaKolory[$key]++;
            }
        }
        if(in_array('tenis-ziemny', $kategorie))
        {
            foreach($this->SzukajCreateSelect('tenis-ziemny', 'marka') as $row)
            {
                $key = array_search($row->marka, $marki);
                if($key !== false) $liczbaMarki[$key]++;
            }

            foreach($this->SzukajCreateSelect('tenis-ziemny', 'kolor') as $row)
            {
                $key = array_search($row->kolor, $kolory);
                if($key !== false) $liczbaKolory[$key]++;
            }
        }
        if(in_array('tenis-stolowy', $kategorie))
        {
            foreach($this->SzukajCreateSelect('tenis-stolowy', 'marka') as $row)
            {
                $key = array_search($row->marka, $marki);
                if($key !== false) $liczbaMarki[$key]++;
            }

            foreach($this->SzukajCreateSelect('tenis-stolowy', 'kolor') as $row)
            {
                $key = array_search($row->kolor, $kolory);
                if($key !== false) $liczbaKolory[$key]++;
            }
        }

        $filtry = [];
        $param = [];

        for($i=0; $i<count($marki); $i++) $param[] = ['param' => $marki[$i], 'ile' => $liczbaMarki[$i]];
        $filtry[] = new FiltryDane('marka', $param);
        $param = [];

        for($i=0; $i<count($kolory); $i++) $param[] = ['param' => $kolory[$i], 'ile' => $liczbaKolory[$i]];
        $filtry[] = new FiltryDane('kolor', $param);

        return $filtry;
    }

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

    function FiltrujSortujFiltry($filtry)
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
}
