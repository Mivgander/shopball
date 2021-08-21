<?php

namespace App\Http\Livewire;

use App\Models\Koszykowka;
use App\Models\PilkaNozna;
use App\Models\PilkaReczna;
use App\Models\Siatkowka;
use App\Models\TenisStolowy;
use App\Models\TenisZiemny;
use App\Rules\OpisLength;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class DodajProdukt extends Component
{
    use WithFileUploads;

    private $tekst = '';

    //Dane podstawowe
    public $marka;
    public $nazwa;
    public $opis = '';
    public $cena;
    public $zdjecie;
    public $kategoria = 'Wybierz kategorię';
    public $kolor;
    //Dane podstawowe

    //Dane szczegółowe
    public $rozmiar = 'Wybierz rozmiar';
    public $laczenie = 'Wybierz typ łączenia';
    public $przeznaczenie = "Wybierz przeznaczenie";
    public $typ = "Wybierz typ piłki";
    public $typ_nawierzchni = "Wybierz typ nawierzchni";
    //Dane szczegółowe

    public function render()
    {
        $this->WybierzTekst();
        return view('livewire.dodaj-produkt', [
            'kontent'=>$this->tekst
        ]);
    }

    function resetZmiennych()
    {
        $this->reset([
            'marka',
            'opis',
            'cena',
            'zdjecie',
            'kategoria',
            'kolor',
            'rozmiar',
            'laczenie',
            'przeznaczenie',
            'typ',
            'typ_nawierzchni'
        ]);
    }

    public function Dodaj()
    {
        $this->validate([
            'marka' => 'required|max:100',
            'nazwa' => 'required|max:100',
            'opis' => ['required', new OpisLength],
            'cena' => 'required|numeric',
            'zdjecie' => 'required|image|max:2048',
            'kategoria' => 'required|in:pilka_nozna,pilka_reczna,koszykowka,siatkowka,tenis_ziemny,tenis_stolowy'
        ],
        [
            'marka.required' => 'Nazwa marki jest wymagana',
            'marka.max' => 'Nazwa marki nie może być dłuższa niż :max znaków',
            'nazwa.required' => 'Nazwa produktu jest wymmagana',
            'nazwa.max' => 'Nazwa produktu nie może być dłuższa niż :max znaków',
            'opis.required' => 'Opis produktu jest wymagany',
            'cena.required' => 'Cena produktu jest wymagana',
            'cena.numeric' => 'Cena produktu musi być liczbą',
            'zdjecie.required' => 'Zdjęcie produktu jest wymagane',
            'zdjecie.image' => 'Zdjęcie musi być obrazem',
            'zdjecie.max' => 'Zdjęcie nie może ważyć więcej niż 2MB',
            'kategoria.required' => 'Musisz wybrać kategorię produktu',
            'kategoria.in' => 'Wybrana kategoria jest nieprawidłowa'
        ]);

        switch($this->kategoria)
        {
            case 'pilka_nozna':
                $this->validate([
                    'rozmiar' => 'bail|required_if:kategoria,pilka_nozna|in:5,4,3,1,inny',
                    'laczenie' => 'bail|required_if:kategoria,==,pilka_nozna|in:klejona,szyta maszynowo,szyta ręcznie,zgrzewana termicznie,brak informacji',
                    'przeznaczenie' => 'bail|required_if:kategoria,==,pilka_nozna|in:na asfalt/beton,na plażę,na halę,na orlik,na trawę,brak informacji',
                    'kolor' => 'required|alphaDash|max:40'
                ],
                [
                    'rozmiar.required_if' => 'Rozmiar piłki jest wymagany gdy wybrałeś kategorię "piłka nożna"',
                    'rozmiar.in' => 'Wybrany rozmiar jest nieprawidłowy',
                    'laczenie.required_if' => 'Typ łączenia jest wymagany gdy wybrałeś kategorię "piłka nożna"',
                    'laczenie.in' => 'Wybrany typ łączenia jest nieprawidłowy',
                    'przeznaczenie.required_if' => 'Przeznaczenie piłki jest wymagane gdy wybrałeś kategorię "piłka nożna"',
                    'przeznaczenie.in' => 'Wybrane przeznaczenie jest nieprawidłowe',
                    'kolor.required' => 'Kolor produktu jest wymagany',
                    'kolor.alpha_dash' => 'Nazwa koloru może zawierać tylko litery i myślniki',
                    'kolor.max' => 'Nazwa koloru nie może być dłuższa niż 40 znaków'
                ]);

                $storedImageName = $this->ZapiszZdjecie();
                $produkt = PilkaNozna::create([
                    'marka' => $this->marka,
                    'rozmiar' => $this->rozmiar,
                    'łączenie' => $this->laczenie,
                    'przeznaczenie' => $this->przeznaczenie,
                    'kolor' => $this->kolor,
                    'cena' => $this->cena,
                    'tytul' => $this->nazwa,
                    'opis' => $this->opis,
                    'zdjecie' => $storedImageName
                ]);

                $this->resetZmiennych();
                session()->flash('kategoria', 'pilka-nozna');
                session()->flash('id', $produkt->id);
                redirect('dodaj/pomyslnie');
                break;
            case 'pilka_reczna':
                $this->validate([
                    'rozmiar' => 'bail|required_if:kategoria,pilka_reczna|in:3,2,1,0,inny',
                    'laczenie' => 'bail|required_if:kategoria,==,pilka_reczna|in:klejona,szyta maszynowo,szyta ręcznie,zgrzewana termicznie,brak informacji',
                    'kolor' => 'required|alphaDash|max:40'
                ],
                [
                    'rozmiar.required_if' => 'Rozmiar piłki jest wymagany gdy wybrałeś kategorię "piłka ręczna"',
                    'rozmiar.in' => 'Wybrany rozmiar jest nieprawidłowy',
                    'laczenie.required_if' => 'Typ łączenia jest wymagany gdy wybrałeś kategorię "piłka ręczna"',
                    'laczenie.in' => 'Wybrany typ łączenia jest nieprawidłowy',
                    'kolor.required' => 'Kolor produktu jest wymagany',
                    'kolor.alpha_dash' => 'Nazwa koloru może zawierać tylko litery i myślniki',
                    'kolor.max' => 'Nazwa koloru nie może być dłuższa niż 40 znaków'
                ]);

                $storedImageName = $this->ZapiszZdjecie();
                $produkt = PilkaReczna::create([
                    'marka' => $this->marka,
                    'rozmiar' => $this->rozmiar,
                    'łączenie' => $this->laczenie,
                    'kolor' => $this->kolor,
                    'cena' => $this->cena,
                    'tytul' => $this->nazwa,
                    'opis' => $this->opis,
                    'zdjecie' => $storedImageName
                ]);


                $this->resetZmiennych();
                session()->flash('kategoria', 'pilka-reczna');
                session()->flash('id', $produkt->id);
                redirect('dodaj/pomyslnie');
                break;
            case 'koszykowka':
                $this->validate([
                    'rozmiar' => 'bail|required_if:kategoria,koszykowka|in:7,6,5,3,inny',
                    'przeznaczenie' => 'bail|required_if:kategoria,==,koszykowka|in:na asfalt/beton,na halę,na orlik,brak informacji',
                    'kolor' => 'required|alphaDash|max:40'
                ],
                [
                    'rozmiar.required_if' => 'Rozmiar piłki jest wymagany gdy wybrałeś kategorię "koszykówka"',
                    'rozmiar.in' => 'Wybrany rozmiar jest nieprawidłowy',
                    'przeznaczenie.required_if' => 'Przeznaczenie piłki jest wymagane gdy wybrałeś kategorię "koszykówka"',
                    'przeznaczenie.in' => 'Wybrane przeznaczenie jest nieprawidłowe',
                    'kolor.required' => 'Kolor produktu jest wymagany',
                    'kolor.alpha_dash' => 'Nazwa koloru może zawierać tylko litery i myślniki',
                    'kolor.max' => 'Nazwa koloru nie może być dłuższa niż 40 znaków'
                ]);

                $storedImageName = $this->ZapiszZdjecie();
                $produkt = Koszykowka::create([
                    'marka' => $this->marka,
                    'rozmiar' => $this->rozmiar,
                    'przeznaczenie' => $this->przeznaczenie,
                    'kolor' => $this->kolor,
                    'cena' => $this->cena,
                    'tytul' => $this->nazwa,
                    'opis' => $this->opis,
                    'zdjecie' => $storedImageName
                ]);


                $this->resetZmiennych();
                session()->flash('kategoria', 'koszykowka');
                session()->flash('id', $produkt->id);
                redirect('dodaj/pomyslnie');
                break;
            case 'siatkowka':
                $this->validate([
                    'rozmiar' => 'bail|required_if:kategoria,siatkowka|in:5,4,2,inny',
                    'laczenie' => 'bail|required_if:kategoria,==,siatkowka|in:klejona,szyta maszynowo,szyta ręcznie,zgrzewana termicznie,brak informacji',
                    'przeznaczenie' => 'bail|required_if:kategoria,==,siatkowka|in:na plażę,na halę,na basen,brak informacji',
                    'kolor' => 'required|alphaDash|max:40'
                ],
                [
                    'rozmiar.required_if' => 'Rozmiar piłki jest wymagany gdy wybrałeś kategorię "siatkówka"',
                    'rozmiar.in' => 'Wybrany rozmiar jest nieprawidłowy',
                    'laczenie.required_if' => 'Typ łączenia jest wymagany gdy wybrałeś kategorię "siatkowka"',
                    'laczenie.in' => 'Wybrany typ łączenia jest nieprawidłowy',
                    'przeznaczenie.required_if' => 'Przeznaczenie piłki jest wymagane gdy wybrałeś kategorię "siatkówka"',
                    'przeznaczenie.in' => 'Wybrane przeznaczenie jest nieprawidłowe',
                    'kolor.required' => 'Kolor produktu jest wymagany',
                    'kolor.alpha_dash' => 'Nazwa koloru może zawierać tylko litery i myślniki',
                    'kolor.max' => 'Nazwa koloru nie może być dłuższa niż 40 znaków'
                ]);

                $storedImageName = $this->ZapiszZdjecie();
                $produkt = Siatkowka::create([
                    'marka' => $this->marka,
                    'rozmiar' => $this->rozmiar,
                    'łączenie' => $this->laczenie,
                    'przeznaczenie' => $this->przeznaczenie,
                    'kolor' => $this->kolor,
                    'cena' => $this->cena,
                    'tytul' => $this->nazwa,
                    'opis' => $this->opis,
                    'zdjecie' => $storedImageName
                ]);


                $this->resetZmiennych();
                session()->flash('kategoria', 'siatkowka');
                session()->flash('id', $produkt->id);
                redirect('dodaj/pomyslnie');
                break;
            case 'tenis_ziemny':
                $this->validate([
                    'typ' => 'bail|required_if:kategoria,tenis_ziemny|in:bezciśnieniowe,ciśnieniowe,niskociśnieniowe,brak informacji',
                    'typ_nawierzchni' => 'bail|required_if:kategoria,==,tenis_ziemny|in:kort ceglany,kort twardy,na wszystkie nawierzchnie,brak informacji',
                    'kolor' => 'required|alphaDash|max:40'
                ],
                [
                    'typ.required_if' => 'Typ piłki jest wymagany gdy wybrałeś kategorię "tenis ziemny"',
                    'typ.in' => 'Wybrany typ jest nieprawidłowy',
                    'typ_nawierzchni.required_if' => 'Typ nawierchni jest wymagany gdy wybrałeś kategorię "tenis ziemny"',
                    'typ_nawierzchni.in' => 'Wybrany typ nawierzchni jest nieprawidłowy',
                    'kolor.required' => 'Kolor produktu jest wymagany',
                    'kolor.alpha_dash' => 'Nazwa koloru może zawierać tylko litery i myślniki',
                    'kolor.max' => 'Nazwa koloru nie może być dłuższa niż 40 znaków'
                ]);

                $storedImageName = $this->ZapiszZdjecie();
                $produkt = TenisZiemny::create([
                    'marka' => $this->marka,
                    'typ' => $this->typ,
                    'typ_nawierzchni' => $this->typ_nawierzchni,
                    'kolor' => $this->kolor,
                    'cena' => $this->cena,
                    'tytul' => $this->nazwa,
                    'opis' => $this->opis,
                    'zdjecie' => $storedImageName
                ]);

                $this->resetZmiennych();
                session()->flash('kategoria', 'tenis-ziemny');
                session()->flash('id', $produkt->id);
                redirect('dodaj/pomyslnie');
                break;
            case 'tenis_stolowy':
                $this->validate([
                    'typ' => 'bail|required_if:kategoria,tenis_ziemny|in:1 gwiazdka,2 gwiazdki,3 gwiazdki,brak informacji',
                    'kolor' => 'required|alphaDash|max:40'
                ],
                [
                    'typ.required_if' => 'Typ piłki jest wymagany gdy wybrałeś kategorię "tenis stołowy"',
                    'typ.in' => 'Wybrany typ jest nieprawidłowy',
                    'kolor.required' => 'Kolor produktu jest wymagany',
                    'kolor.alpha_dash' => 'Nazwa koloru może zawierać tylko litery i myślniki',
                    'kolor.max' => 'Nazwa koloru nie może być dłuższa niż 40 znaków'
                ]);

                $storedImageName = $this->ZapiszZdjecie();
                $produkt = TenisStolowy::create([
                    'marka' => $this->marka,
                    'typ' => $this->typ,
                    'kolor' => $this->kolor,
                    'cena' => $this->cena,
                    'tytul' => $this->nazwa,
                    'opis' => $this->opis,
                    'zdjecie' => $storedImageName
                ]);

                $this->resetZmiennych();
                session()->flash('kategoria', 'tenis-stolowy');
                session()->flash('id', $produkt->id);
                redirect('dodaj/pomyslnie');
                break;
            default:
                break;
        }
    }

    function ZapiszZdjecie()
    {
        $storedImage = '';
        if(Storage::exists($this->zdjecie->getClientOriginalName()))
        {
            $storedImage = $this->zdjecie->store('');
        }
        else
        {
            $storedImage = $this->zdjecie->storeAs('', $this->zdjecie->getClientOriginalName());
        }

        return $storedImage;
    }

    function WybierzTekst()
    {
        switch($this->kategoria)
        {
            case 'pilka_nozna':
                $this->tekst = '
                <hr class="border-t-2 border-gray-200">
                <div class="my-4">
                    <h1 class="text-2xl">Parametry</h1>
                </div>
                <div class="my-6">
                    <label class="font-bold text-lg">Rozmiar:</label>
                    <select class="outline-none p-1" wire:model="rozmiar">
                        <option value="Wybierz rozmiar" selected disabled hidden>Wybierz rozmiar</option>
                        <option value="5">5</option>
                        <option value="4">4</option>
                        <option value="3">3</option>
                        <option value="1">1</option>
                        <option value="inny">inny</option>
                    </select>
                </div>
                <div class="my-6">
                    <label class="font-bold text-lg">Łączenie:</label>
                    <select class="outline-none p-1" wire:model="laczenie">
                        <option value="Wybierz typ łączenia" selected disabled hidden>Wybierz typ łączenia</option>
                        <option value="klejona">klejona</option>
                        <option value="szyta maszynowo">szyta maszynowo</option>
                        <option value="szyta ręcznie">szyta ręcznie</option>
                        <option value="zgrzewana termicznie">zgrzewana termicznie</option>
                        <option value="brak informacji">brak informacji</option>
                    </select>
                </div>
                <div class="my-6">
                    <label class="font-bold text-lg">Przeznaczenie:</label>
                    <select class="outline-none p-1" wire:model="przeznaczenie">
                        <option value="Wybierz przeznaczenie" selected disabled hidden>Wybierz przeznaczenie</option>
                        <option value="na asfalt/beton">na asfalt/beton</option>
                        <option value="na halę">na halę</option>
                        <option value="na plażę">na plażę</option>
                        <option value="na orlik">na orlik</option>
                        <option value="na trawę">na trawę</option>
                        <option value="brak informacji">brak informacji</option>
                    </select>
                </div>
                <div class="my-6">
                    <label class="font-bold text-lg">Kolor:</label><br>
                    <input class="loginInput" type="text" wire:model="kolor" required autocomplete="off" placeholder="Podaj kolor...">
                </div>
                ';
                break;
            case 'pilka_reczna':
                $this->tekst = '
                <hr class="border-t-2 border-gray-200">
                <div class="my-4">
                    <h1 class="text-2xl">Parametry</h1>
                </div>
                <div class="my-6">
                    <label class="font-bold text-lg">Rozmiar:</label>
                    <select class="outline-none p-1" wire:model="rozmiar">
                        <option value="Wybierz rozmiar" selected disabled hidden>Wybierz rozmiar</option>
                        <option value="3">3</option>
                        <option value="2">2</option>
                        <option value="1">1</option>
                        <option value="0">0</option>
                        <option value="inny">inny</option>
                    </select>
                </div>
                <div class="my-6">
                    <label class="font-bold text-lg">Łączenie:</label>
                    <select class="outline-none p-1" wire:model="laczenie">
                        <option value="Wybierz typ łączenia" selected disabled hidden>Wybierz typ łączenia</option>
                        <option value="klejona">klejona</option>
                        <option value="szyta maszynowo">szyta maszynowo</option>
                        <option value="szyta ręcznie">szyta ręcznie</option>
                        <option value="zgrzewana termicznie">zgrzewana termicznie</option>
                        <option value="brak informacji">brak informacji</option>
                    </select>
                </div>
                <div class="my-6">
                    <label class="font-bold text-lg">Kolor:</label><br>
                    <input class="loginInput" type="text" wire:model="kolor" required autocomplete="off" placeholder="Podaj kolor...">
                </div>
                ';
                break;
            case 'koszykowka':
                $this->tekst = '
                <hr class="border-t-2 border-gray-200">
                <div class="my-4">
                    <h1 class="text-2xl">Parametry</h1>
                </div>
                <div class="my-6">
                    <label class="font-bold text-lg">Rozmiar:</label>
                    <select class="outline-none p-1" wire:model="rozmiar">
                        <option value="Wybierz rozmiar" selected disabled hidden>Wybierz rozmiar</option>
                        <option value="7">7</option>
                        <option value="6">6</option>
                        <option value="5">5</option>
                        <option value="3">3</option>
                        <option value="inny">inny</option>
                    </select>
                </div>
                <div class="my-6">
                    <label class="font-bold text-lg">Przeznaczenie:</label>
                    <select class="outline-none p-1" wire:model="przeznaczenie">
                        <option value="Wybierz przeznaczenie" selected disabled hidden>Wybierz przeznaczenie</option>
                        <option value="na asfalt/beton">na asfalt/beton</option>
                        <option value="na halę">na halę</option>
                        <option value="na orlik">na orlik</option>
                        <option value="brak informacji">brak informacji</option>
                    </select>
                </div>
                <div class="my-6">
                    <label class="font-bold text-lg">Kolor:</label><br>
                    <input class="loginInput" type="text" wire:model="kolor" required autocomplete="off" placeholder="Podaj kolor...">
                </div>
                ';
                break;
            case 'siatkowka':
                $this->tekst = '
                <hr class="border-t-2 border-gray-200">
                <div class="my-4">
                    <h1 class="text-2xl">Parametry</h1>
                </div>
                <div class="my-6">
                    <label class="font-bold text-lg">Rozmiar:</label>
                    <select class="outline-none p-1" wire:model="rozmiar">
                        <option value="Wybierz rozmiar" selected disabled hidden>Wybierz rozmiar</option>
                        <option value="5">5</option>
                        <option value="4">4</option>
                        <option value="2">2</option>
                        <option value="inny">inny</option>
                    </select>
                </div>
                <div class="my-6">
                    <label class="font-bold text-lg">Łączenie:</label>
                    <select class="outline-none p-1" wire:model="laczenie">
                        <option value="Wybierz typ łączenia" selected disabled hidden>Wybierz typ łączenia</option>
                        <option value="klejona">klejona</option>
                        <option value="szyta maszynowo">szyta maszynowo</option>
                        <option value="szyta ręcznie">szyta ręcznie</option>
                        <option value="zgrzewana termicznie">zgrzewana termicznie</option>
                        <option value="brak informacji">brak informacji</option>
                    </select>
                </div>
                <div class="my-6">
                    <label class="font-bold text-lg">Przeznaczenie:</label>
                    <select class="outline-none p-1" wire:model="przeznaczenie">
                        <option value="Wybierz przeznaczenie" selected disabled hidden>Wybierz przeznaczenie</option>
                        <option value="na asfalt/beton">na asfalt/beton</option>
                        <option value="na halę">na halę</option>
                        <option value="na plażę">na plażę</option>
                        <option value="na basen">na basen</option>
                        <option value="brak informacji">brak informacji</option>
                    </select>
                </div>
                <div class="my-6">
                    <label class="font-bold text-lg">Kolor:</label><br>
                    <input class="loginInput" type="text" wire:model="kolor" required autocomplete="off" placeholder="Podaj kolor...">
                </div>
                ';
                break;
            case 'tenis_ziemny':
                $this->tekst = '
                <hr class="border-t-2 border-gray-200">
                <div class="my-4">
                    <h1 class="text-2xl">Parametry</h1>
                </div>
                <div class="my-6">
                    <label class="font-bold text-lg">Typ:</label>
                    <select class="outline-none p-1" wire:model="typ">
                        <option value="Wybierz typ piłki" selected disabled hidden>Wybierz typ piłki</option>
                        <option value="bezciśnieniowe">bezciśnieniowe</option>
                        <option value="ciśnieniowe">ciśnieniowe</option>
                        <option value="niskociśnieniowe">niskociśnieniowe</option>
                        <option value="brak informacji">brak informacji</option>
                    </select>
                </div>
                <div class="my-6">
                    <label class="font-bold text-lg">Typ nawierzchni:</label>
                    <select class="outline-none p-1" wire:model="typ_nawierzchni">
                        <option value="Wybierz typ nawierzchni" selected disabled hidden>Wybierz typ nawierzchni</option>
                        <option value="kort ceglany">kort ceglany</option>
                        <option value="kort twardy">kort twardy</option>
                        <option value="na wszystkie nawierzchnie">na wszystkie nawierzchnie</option>
                        <option value="brak informacji">brak informacji</option>
                    </select>
                </div>
                <div class="my-6">
                    <label class="font-bold text-lg">Kolor:</label><br>
                    <input class="loginInput" type="text" wire:model="kolor" required autocomplete="off" placeholder="Podaj kolor...">
                </div>
                ';
                break;
            case 'tenis_stolowy':
                $this->tekst = '
                <hr class="border-t-2 border-gray-200">
                <div class="my-4">
                    <h1 class="text-2xl">Parametry</h1>
                </div>
                <div class="my-6">
                    <label class="font-bold text-lg">Typ:</label>
                    <select class="outline-none p-1" wire:model="typ">
                        <option value="Wybierz typ piłki" selected disabled hidden>Wybierz typ piłki</option>
                        <option value="1 gwiazdka">1 gwiazdka</option>
                        <option value="2 gwiazdki">2 gwiazdki</option>
                        <option value="3 gwiazdki">3 gwiazdki</option>
                        <option value="brak informacji">brak informacji</option>
                    </select>
                </div>
                <div class="my-6">
                    <label class="font-bold text-lg">Kolor:</label><br>
                    <input class="loginInput" type="text" wire:model="kolor" required autocomplete="off" placeholder="Podaj kolor...">
                </div>
                ';
                break;
            default:
                $this->tekst = '';
                break;
        }
    }
}
