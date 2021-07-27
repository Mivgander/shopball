<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduktDniaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('produkt_dnia'))
        {
            Schema::create('produkt_dnia', function (Blueprint $table) {
                $table->id();
                $table->enum('tabela', ['pilka_nozna', 'pilka_reczna', 'siatkowka', 'koszykowka', 'tenis_ziemny', 'tenis_stolowy']);
                $table->bigInteger('id_produktu');
                $table->date('dzien');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produkt_dnia');
    }
}
