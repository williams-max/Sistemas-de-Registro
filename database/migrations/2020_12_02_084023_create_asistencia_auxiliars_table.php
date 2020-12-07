<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsistenciaAuxiliarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asistencia_auxiliars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fecha');
            $table->time('hora');
            $table->string('grupo');
            $table->string('materia');
            $table->string('contenido');
            $table->string('plataforma');
            $table->string('observacion');
            $table->string('firma');
            $table->string('ruta_firma');
            $table->string('grabacion')->nullable();
            $table->string('ruta_grabacion')->nullable();
            $table->integer('enviado');
            $table->unsignedBigInteger('id_personal');
            $table->unsignedBigInteger('id_fecha_rango');
            $table->timestamps();

            $table->foreign('id_personal')
            ->references('id')
            ->on('personal_academicos')
            ->onDelete('cascade');

            $table->foreign('id_fecha_rango')
            ->references('id')
            ->on('fecha_entregas')
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
        Schema::dropIfExists('asistencia_auxiliars');
    }
}
