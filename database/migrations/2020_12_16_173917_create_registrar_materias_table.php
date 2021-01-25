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
            $table->bigIncrements('id');
            $table->string('materia');
            $table->string('grupo');
            $table->unsignedBigInteger('id_personal');
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
        Schema::dropIfExists('registrar_materias');
    }
}
