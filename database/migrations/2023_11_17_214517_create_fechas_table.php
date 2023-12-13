<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFechasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fechas', function (Blueprint $table) {
            $table->id();
            $table->string('fecha');
            $table->unsignedInteger('cantidad_ejercicio_realizados');
            $table->unsignedInteger('cantidad_evaluacion_realizadas');
            $table->unsignedInteger('puntos_obtenidos_ejercicios');
            $table->unsignedInteger('puntos_obtenidos_evaluaciones');
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
        Schema::dropIfExists('fechas');
    }
}
