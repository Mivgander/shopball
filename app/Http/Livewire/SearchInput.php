<?php

namespace App\Http\Livewire;

use App\Http\Controllers\PolecaneDane;
use App\Models\Koszykowka;
use App\Models\PilkaNozna;
use App\Models\PilkaReczna;
use App\Models\Siatkowka;
use App\Models\TenisStolowy;
use App\Models\TenisZiemny;
use Livewire\Component;

class SearchInput extends Component
{
    public $search = '';
    public $select = 'wszedzie';

    public function render()
    {
        return view('livewire.search-input', [
            'produkty' => $this->Search()
        ]);
    }

    public function Search()
    {
        if($this->search == '')
        {
            return [];
        }
        else
        {
            $produkty = [];

            switch($this->select)
            {
                case 'wszedzie':
                    foreach(PilkaNozna::where('tytul','LIKE', '%'.$this->search.'%')->get() as $row)
                    {
                        $produkty[] = new PolecaneDane('pilka-nozna', $row);
                    }

                    foreach(PilkaReczna::where('tytul', 'LIKE', '%'.$this->search.'%')->get() as $row)
                    {
                        $produkty[] = new PolecaneDane('pilka-reczna', $row);
                    }

                    foreach(Siatkowka::where('tytul', 'LIKE', '%'.$this->search.'%')->get() as $row)
                    {
                        $produkty[] = new PolecaneDane('siatkowka', $row);
                    }

                    foreach(Koszykowka::where('tytul', 'LIKE', '%'.$this->search.'%')->get() as $row)
                    {
                        $produkty[] = new PolecaneDane('koszykowka', $row);
                    }

                    foreach(TenisZiemny::where('tytul', 'LIKE', '%'.$this->search.'%')->get() as $row)
                    {
                        $produkty[] = new PolecaneDane('tenis-ziemny', $row);
                    }

                    foreach(TenisStolowy::where('tytul', 'LIKE', '%'.$this->search.'%')->get() as $row)
                    {
                        $produkty[] = new PolecaneDane('tenis-stolowy', $row);
                    }
                    break;
                case 'pilka_nozna':
                    foreach(PilkaNozna::where('tytul','LIKE', '%'.$this->search.'%')->get() as $row)
                    {
                        $produkty[] = new PolecaneDane('pilka-nozna', $row);
                    }
                    break;
                case 'pilka_reczna':
                    foreach(PilkaReczna::where('tytul', 'LIKE', '%'.$this->search.'%')->get() as $row)
                    {
                        $produkty[] = new PolecaneDane('pilka-reczna', $row);
                    }
                    break;
                case 'siatkowka':
                    foreach(Siatkowka::where('tytul', 'LIKE', '%'.$this->search.'%')->get() as $row)
                    {
                        $produkty[] = new PolecaneDane('siatkowka', $row);
                    }
                    break;
                case 'koszykowka':
                    foreach(Koszykowka::where('tytul', 'LIKE', '%'.$this->search.'%')->get() as $row)
                    {
                        $produkty[] = new PolecaneDane('koszykowka', $row);
                    }
                    break;
                case 'tenis_ziemny':
                    foreach(TenisZiemny::where('tytul', 'LIKE', '%'.$this->search.'%')->get() as $row)
                    {
                        $produkty[] = new PolecaneDane('tenis-ziemny', $row);
                    }
                    break;
                case 'tenis_stolowy':
                    foreach(TenisStolowy::where('tytul', 'LIKE', '%'.$this->search.'%')->get() as $row)
                    {
                        $produkty[] = new PolecaneDane('tenis-stolowy', $row);
                    }
                    break;
            }

            return $produkty;
        }
    }
}
