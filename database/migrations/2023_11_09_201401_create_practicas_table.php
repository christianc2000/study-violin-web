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
            $table->boolean('estado');
            $table->string('nombre');
            $table->string('url');
            $table->unsignedInteger('cantidad_ejercicio');
            $table->unsignedInteger('cantidad_evaluacion');
            $table->unsignedInteger('cantidad_puntos');
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
