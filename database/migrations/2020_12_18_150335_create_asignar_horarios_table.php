<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsignarHorariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('dias', function (Blueprint $table) {
            $table->id();
            $table->string('dia');
            $table->timestamps();
        });

        Schema::create('asignar_horarios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->time('hora');
            $table->unsignedBigInteger('id_materia');
            $table->unsignedBigInteger('id_dia');
            $table->timestamps();

            $table->foreign('id_materia')
            ->references('id')
            ->on('registrar_materias')
            ->onDelete('cascade');

            $table->foreign('id_dia')
            ->references('id')
            ->on('dias')
            ->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asignar_horarios');
    }
}
