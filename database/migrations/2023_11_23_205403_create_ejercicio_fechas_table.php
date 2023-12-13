<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEjercicioFechasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ejercicio_fechas', function (Blueprint $table) {
            $table->unsignedInteger('puntuacion');
            $table->foreignId('ejercicio_id')->references('id')->on('ejercicios');
            $table->foreignId('fecha_id')->references('id')->on('fechas');
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
        Schema::dropIfExists('ejercicio_fechas');
    }
}
