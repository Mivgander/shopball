<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PilkaReczna extends Model
{
    use HasFactory;

    protected $table = 'pilka_reczna';

    static function Rekordy($req)
    {
        $data = PilkaReczna::where('id', '>=', '1');
        if($req->marka) $data = $data->whereIn('marka', $req->marka);
        if($req->rozmiar) $data = $data->whereIn('rozmiar', $req->rozmiar);
        if($req->łączenie) $data = $data->whereIn('łączenie', $req->łączenie);
        if($req->kolor) $data = $data->whereIn('kolor', $req->kolor);
        if($req->od != '') $data = $data->where('cena', '>=', $req->od);
        if($req->do != '') $data = $data->where('cena', '<=', $req->do);
        $data = $data->paginate(10);
        $data = $data->withQueryString();
        return $data;
    }
}
