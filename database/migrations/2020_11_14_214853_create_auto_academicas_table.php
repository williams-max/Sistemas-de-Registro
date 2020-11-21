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


            $table->timestamps();
        });

        Schema::create('auto_academica_user', function (Blueprint $table) {
            $table->primary('user_id','auto_academica_id');

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('auto_academica_id');
            $table->timestamps();

            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');

            $table->foreign('auto_academica_id')
            ->references('id')
            ->on('auto_academicas')
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
        Schema::dropIfExists('auto_academicas');
    }
}
