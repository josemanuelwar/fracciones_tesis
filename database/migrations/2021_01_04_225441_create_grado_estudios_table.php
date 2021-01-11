<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradoEstudiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grado_estudios', function (Blueprint $table) {
            $table->unsignedBigInteger('grado_id');
            $table->unsignedBigInteger('profesor_id');
            // $table->foreign('grado_id')->references('id')->on('grado_primarias');
            $table->foreign('profesor_id')->references('id')->on('users');
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
        Schema::dropIfExists('grado_estudios');
    }
}
