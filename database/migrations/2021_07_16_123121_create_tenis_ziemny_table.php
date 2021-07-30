<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenisZiemnyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('tenis_ziemny'))
        {
            Schema::create('tenis_ziemny', function (Blueprint $table) {
                $table->id();
                $table->string("marka");
                $table->enum("typ", ['bezciśnieniowe', 'ciśnieniowe', 'niskociśnieniowe', 'brak informacji']);
                $table->enum('typ nawierzchni', ['kort ceglany', 'kort twardy', 'na wszystkie nawierzchnie', 'brak informacji']);
                $table->string("kolor");
                $table->float('cena', 6, 2);
                $table->string('tytul');
                $table->text('opis');
                $table->string('zdjecie');
                $table->timestamps();

                $table->engine = "InnoDB";
                $table->charset = "utf8mb4";
                $table->collation = "utf8mb4_polish_ci";
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
        Schema::dropIfExists('tenis_ziemny');
    }
}
