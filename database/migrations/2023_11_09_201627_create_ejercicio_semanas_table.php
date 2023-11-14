<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEjercicioSemanasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ejercicio_semanas', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('completado');
            $table->unsignedInteger('puntos_obtenidos');
            $table->foreignId('semana_id')->references('id')->on('semanas')->onDelete('cascade');
            $table->foreignId('ejercicio_id')->references('id')->on('ejercicios')->onDelete('cascade');
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
        Schema::dropIfExists('ejercicio_semanas');
    }
}
