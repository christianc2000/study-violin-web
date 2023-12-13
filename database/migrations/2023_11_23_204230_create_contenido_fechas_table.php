<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContenidoFechasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contenido_fechas', function (Blueprint $table) {
            $table->unsignedInteger('puntuacion');
            $table->float('prediccion',8,2);
            $table->foreignId('contenido_id')->references('id')->on('contenidos');
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
        Schema::dropIfExists('contenido_fechas');
    }
}
