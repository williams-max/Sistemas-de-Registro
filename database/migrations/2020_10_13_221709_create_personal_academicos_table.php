<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalAcademicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_academicos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('codigoSis');
            $table->string('email');
            $table->string('telefono');
            $table->string('password');
            $table->timestamps();
        });
        Schema::create('personal_academico_user', function (Blueprint $table) {
            $table->primary('user_id','personal_academico_id');

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('personal_academico_id');
            $table->timestamps();

            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');

            $table->foreign('personal_academico_id')
            ->references('id')
            ->on('personal_academicos')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personal_academicos');
    }
}
