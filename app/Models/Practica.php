<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Practica extends Model
{
    use HasFactory;
    protected $table = 'practicas'; 
    protected $fillable = ['nombre', 'cantidad_ejercicio', 'cantidad_evaluacion', 'puntos_ejercicio', 'puntos_evaluacion', 'estudio_id']; // Especifica los campos que se pueden llenar

    public function estudio()
    {
        return $this->belongsTo(Estudio::class);
    }
    public function evaluaciones()
    {
        return $this->hasMany(Evaluacion::class);
    }
    public function ejercicios()
    {
        return $this->hasMany(Ejercicio::class);
    }
}
