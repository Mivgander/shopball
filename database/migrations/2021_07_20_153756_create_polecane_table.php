<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePolecaneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('polecane', function (Blueprint $table) {
            $table->id();
            $table->enum('tabela', ['pilka_nozna', 'pilka_reczna', 'koszykowka', 'siatkowka', 'tenis_ziemny', 'tenis_stolowy']);
            $table->bigInteger('id_produktu', false, true);

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
        Schema::dropIfExists('polecane');
    }
}
