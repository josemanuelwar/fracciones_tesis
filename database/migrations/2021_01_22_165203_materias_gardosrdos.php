<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MateriasGardosrdos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('materias_has_grados', function (Blueprint $table) {
            $table->unsignedBigInteger('materias_id');
            $table->unsignedBigInteger('grados_id');
            $table->foreign('materias_id')->references('id')->on('materias');
            $table->foreign('grados_id')->references('id')->on('grados');
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
        Schema::dropIfExists('materias_has_grados');
    }
}
