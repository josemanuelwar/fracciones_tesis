<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddelimiToTemas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('temas', function (Blueprint $table) {
            //
            $table->string('rutavideo')->after('numerodepreguntas');
            $table->integer('eliminartemas')->after('rutavideo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('temas', function (Blueprint $table) {
            //
            $table->dropColumn('rutavideo');
            $table->dropColumn('eliminartemas');
        });
    }
}
