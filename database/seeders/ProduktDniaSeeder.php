<?php

namespace Database\Seeders;

use App\Models\ProduktDnia;
use Illuminate\Database\Seeder;

class ProduktDniaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProduktDnia::create([
            'tabela' => 'pilka_nozna',
            'id_produktu' => '5',
            'dzien' => date('Y-m-d', mktime(0, 0, 0, date('m'), date('d'), date('Y')))
        ]);
        ProduktDnia::create([
            'tabela' => 'pilka_reczna',
            'id_produktu' => '5',
            'dzien' => date('Y-m-d', mktime(0, 0, 0, date('m'), date('d')+1, date('Y')))
        ]);
        ProduktDnia::create([
            'tabela' => 'koszykowka',
            'id_produktu' => '10',
            'dzien' => date('Y-m-d', mktime(0, 0, 0, date('m'), date('d')+2, date('Y')))
        ]);
    }
}
