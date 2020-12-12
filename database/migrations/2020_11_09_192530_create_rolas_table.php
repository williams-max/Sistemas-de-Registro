<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rolas', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            //$table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->enum('full-access',['yes','no'])->nullable();
            $table->enum('full-auto',['yes','no'])->nullable();
            $table->enum('rol',['yes','no'])->nullable();

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
        Schema::dropIfExists('rolas');
    }
}
