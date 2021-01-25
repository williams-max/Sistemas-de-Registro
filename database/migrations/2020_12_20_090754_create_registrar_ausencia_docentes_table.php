<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrarAusenciaDocentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrar_ausencia_docentes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fecha');
            $table->time('hora');
            $table->string('grupo');
            $table->string('materia');
            $table->string('motivo');
            $table->string('dia_reposicion');
            $table->time('hora_reposicion');
            $table->string('firma');
            $table->string('ruta_firma');
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
        Schema::dropIfExists('registrar_ausencia_docentes');
    }
}
