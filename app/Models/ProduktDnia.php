<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProduktDnia extends Model
{
    use HasFactory;

    protected $table = "produkt_dnia";

    public $timestamps = false;

    protected $fillable = [
        'tabela',
        'id_produktu',
        'dzien'
    ];
}
