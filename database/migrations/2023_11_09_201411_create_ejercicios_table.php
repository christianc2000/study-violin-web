<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEjerciciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ejercicios', function (Blueprint $table) {
            $table->id();
            $table->boolean('estado');
            $table->string('nombre');
            $table->string('descripcion');
            $table->unsignedInteger('posicion');
            $table->unsignedInteger('puntos');
            $table->unsignedSmallInteger('tipo');
            $table->foreignId('practica_id')->references('id')->on('practicas')->onDelete('cascade');
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
        Schema::dropIfExists('ejercicios');
    }
}
