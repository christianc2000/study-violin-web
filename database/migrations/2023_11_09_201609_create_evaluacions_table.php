<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluacions', function (Blueprint $table) {
            $table->id();
            $table->string('detalle');
            $table->unsignedInteger('calificacion_obtenida');
            $table->unsignedInteger('puntos_evaluacion');
            $table->unsignedInteger('puntos_obtenidos');
            $table->foreignId('semana_id')->references('id')->on('semanas')->onDelete('cascade');
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
        Schema::dropIfExists('evaluacions');
    }
}
