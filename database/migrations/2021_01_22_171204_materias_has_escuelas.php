<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MateriasHasEscuelas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('materias_has_escuelas', function (Blueprint $table) {
            $table->unsignedBigInteger('materias_id');
            $table->unsignedBigInteger('escuelas_id');
            $table->foreign('materias_id')->references('id')->on('materias');
            $table->foreign('escuelas_id')->references('id')->on('escuelas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('materias_has_escuelas');
    }
}
