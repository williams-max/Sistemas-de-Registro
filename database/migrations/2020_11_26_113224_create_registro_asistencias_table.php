<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistroAsistenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('registro_asistencias', function (Blueprint $table) {
         $table->bigIncrements('id');
         $table->date('fecha');
         $table->string('hora');
         $table->string('grupo');
         $table->string('materia');
         $table->string('contenido');
         $table->string('plataforma');
         $table->string('observacion');
         $table->string('firma')->nullable();
         $table->unsignedBigInteger('id_personal')->nullable();
         $table->timestamps();

         $table->foreign('id_personal')
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
        Schema::dropIfExists('registro_asistencias');
    }
}
