<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddmateriasToMaterias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('materias', function (Blueprint $table) {
            //
            $table->string("urlimagenmat")->after('siglasmaterias');
            $table->integer("Eliminarmat")->after('urlimagenMat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('materias', function (Blueprint $table) {
            //
            $table->dropColumn('urlimagenmat');
            $table->dropColumn('Eliminarmat');
        });
    }
}
