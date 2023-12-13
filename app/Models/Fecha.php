<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fecha extends Model
{
    use HasFactory;
    protected $table = 'fechas';
    protected $fillable = [
        'fecha', 'cantidad_ejercicio_realizados', 'cantidad_evaluacion_realizadas', 'puntos_obtenidos_ejercicios', 'puntos_obtenidos_evaluaciones'
    ];

    public function contenidos()
    {
        return $this->belongsToMany(Contenido::class, 'contenido_fechas')
            ->withPivot('puntuacion', 'prediccion')
            ->withTimestamps();
    }

    public function ejercicios()
    {
        return $this->belongsToMany(Ejercicio::class, 'ejercicio_fechas')
            ->withPivot('puntuacion')
            ->withTimestamps();
    }
}
