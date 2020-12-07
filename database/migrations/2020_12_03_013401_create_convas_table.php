<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConvasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('convas', function (Blueprint $table) {
            $table->id();
            
            $table->date('fecha')->nullable();
         $table->string('hora')->nullable();
         $table->string('grupo')->nullable();
         $table->string('materia')->nullable();
        


            $table->string('contenido');
            $table->string('plataforma');
            $table->string('observacion')->nullable();
            $table->Integer('id_personal')->nullable();
           
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
        Schema::dropIfExists('convas');
    }
}
