<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{

    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('personaNatural_id')->unsigned()->nullable();
            $table->integer('personaEmpleado_id')->unsigned()->nullable();

            $table->rememberToken();

            $table->foreign('personaNatural_id')->references('id')->on('personas_naturales');
            $table->foreign('personaEmpleado_id')->references('id')->on('personas_empleados');
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
        Schema::dropIfExists('users');
    }
}
