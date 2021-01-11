<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRespuetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respuetas', function (Blueprint $table) {
            $table->id();
            $table->string('incisos');
            $table->longText('respuesta');
            $table->integer('respuesta_correcta');
            $table->unsignedBigInteger("id_pregunta");
            $table->foreign('id_pregunta')->references('id')->on('preguntas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('respuetas');
    }
}
