<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSemanasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('semanas', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('nro');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->unsignedInteger('puntos_obtenidos');
            $table->unsignedInteger('cantidad_evaluacion');
            $table->unsignedInteger('cantidad_restante_evaluacion');
            $table->foreignId('plan_estudio_id')->references('id')->on('plan_estudios')->onDelete('cascade');
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
        Schema::dropIfExists('semanas');
    }
}
