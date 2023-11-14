<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePracticasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('practicas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->unsignedInteger('cantidad_ejercicio');
            $table->unsignedInteger('cantidad_evaluacion');
            $table->unsignedInteger('puntos_ejercicio');
            $table->unsignedInteger('puntos_evaluacion');
            $table->foreignId('estudio_id')->references('id')->on('estudios')->onDelete('cascade');
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
        Schema::dropIfExists('practicas');
    }
}
