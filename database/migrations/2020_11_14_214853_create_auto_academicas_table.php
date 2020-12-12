<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutoAcademicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auto_academicas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('direccion');
            $table->string('grado');
            $table->unsignedBigInteger('id_user');

            $table->foreign('id_user')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
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
        Schema::dropIfExists('auto_academicas');
    }
}
