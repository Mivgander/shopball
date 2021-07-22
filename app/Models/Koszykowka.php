<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Koszykowka extends Model
{
    use HasFactory;

    protected $table = 'koszykowka';

    static function Rekordy($req)
    {
        $data = Koszykowka::where('id', '>=', '1');
        if($req->marka) $data = $data->whereIn('marka', $req->marka);
        if($req->rozmiar) $data = $data->whereIn('rozmiar', $req->rozmiar);
        if($req->przeznaczenie) $data = $data->whereIn('przeznaczenie', $req->przeznaczenie);
        if($req->kolor) $data = $data->whereIn('kolor', $req->kolor);
        if($req->od != '') $data = $data->where('cena', '>=', $req->od);
        if($req->do != '') $data = $data->where('cena', '<=', $req->do);
        $data = $data->paginate(10);
        $data = $data->withQueryString();
        return $data;
    }
}
