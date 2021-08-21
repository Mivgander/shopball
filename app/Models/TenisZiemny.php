<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenisZiemny extends Model
{
    use HasFactory;

    protected $table = 'tenis_ziemny';

    protected $fillable = [
        'marka',
        'typ',
        'typ_nawierzchni',
        'kolor',
        'cena',
        'tytul',
        'opis',
        'zdjecie'
    ];

    static function Rekordy($req)
    {
        $data = TenisZiemny::where('id', '>=', '1');
        if($req->marka) $data = $data->whereIn('marka', $req->marka);
        if($req->typ) $data = $data->whereIn('typ', $req->typ);
        if($req->typ_nawierzchni) $data = $data->whereIn('typ_nawierzchni', $req->typ_nawierzchni);
        if($req->kolor) $data = $data->whereIn('kolor', $req->kolor);
        if($req->od != '') $data = $data->where('cena', '>=', $req->od);
        if($req->do != '') $data = $data->where('cena', '<=', $req->do);
        $data = $data->paginate(10);
        $data = $data->withQueryString();
        return $data;
    }
}
