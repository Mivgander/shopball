<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKoszykowkaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('koszykowka', function (Blueprint $table) {
            $table->id();
            $table->string("marka");
            $table->enum("rozmiar", ['3', '5', '6', '7']);
            $table->enum('przeznaczenie', ['na asfalt, beton', 'na halę', 'na orlik', 'brak informacji']);
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

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('koszykowka');
    }
}
