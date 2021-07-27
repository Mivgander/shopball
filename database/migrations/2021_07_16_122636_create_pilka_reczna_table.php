<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePilkaRecznaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('pilka_reczna'))
        {
            Schema::create('pilka_reczna', function (Blueprint $table) {
                $table->id();
                $table->string("marka");
                $table->enum("rozmiar", ['0', '1', '2', '3']);
                $table->enum('łączenie', ['klejona', 'szyta maszynowo', 'szyta ręcznie', 'zgrzewana termicznie', 'brak informacji']);
                $table->string("kolor");
                $table->float('cena', 6, 2);
                $table->string('tytul');
                $table->text('opis');
                $table->string('zdjecie');
                $table->timestamps();

                $table->engine = "InnoDB";
                $table->charset = "utf8mb4";
                $table->collation = "utf8mb4_unicode_ci";
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
        Schema::dropIfExists('pilka_reczna');
    }
}
