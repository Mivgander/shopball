<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKoszykTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('koszyk'))
        {
            Schema::create('koszyk', function (Blueprint $table) {
                $table->id();
                $table->enum('tabela', ['pilka_nozna', 'pilka_reczna', 'siatkowka', 'koszykowka', 'tenis_ziemny', 'tenis_stolowy']);
                $table->bigInteger('id_produktu');
                $table->bigInteger('id_klienta');
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
        Schema::dropIfExists('koszyk');
    }
}
