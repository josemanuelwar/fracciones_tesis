<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForaneasToUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->unsignedBigInteger("roles_id")->after('password')->nullable();
            $table->unsignedBigInteger("personas_id")->after('roles_id')->nullable();
            $table->unsignedBigInteger("users_id")->after('personas_id')->nullable();
            $table->foreign("roles_id")->references('id')->on("roles");
            $table->foreign("personas_id")->references('id')->on("personas");
            $table->foreign('users_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user', function (Blueprint $table) {
            //
        });
    }
}
