<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrarMateriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrar_materias', function (Blueprint $table) {
            $table->id();
            $table->time('hora');
            $table->unsignedBigInteger('horas_asignadas')->nullable();
            $table->unsignedBigInteger('id_personal');
            $table->unsignedBigInteger('id_dia');
            $table->timestamps();

            $table->foreign('id_personal')
            ->references('id')
            ->on('personal_academicos')
            ->onDelete('cascade');

            $table->foreign('id_dia')
            ->references('id')
            ->on('dias')
            ->onDelete('cascade');
        });

        Schema::create('dias', function (Blueprint $table) {
            $table->id();
            $table->string('dia');
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
        Schema::dropIfExists('registrar_materias');
    }
}
