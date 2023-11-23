<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Practica extends Model
{
    use HasFactory;
    protected $table = 'practicas';
    protected $fillable = [
        'estado',
        'nombre',
        'url',
        'cantidad_ejercicio',
        'cantidad_evaluacion',
        'cantidad_puntos',
        'estudio_id'
    ]; // Especifica los campos que se pueden llenar

    public function estudio()
    {
        return $this->belongsTo(Estudio::class);
    }

    public function ejercicios()
    {
        return $this->hasMany(Ejercicio::class)->where('tipo', 1);
    }
    public function ejerciciosEnabled()
    {
        return $this->hasMany(Ejercicio::class)->where('tipo', 1)->where('estado', true)->orderBy('posicion', 'asc');
    }
    public function evaluaciones()
    {
        return $this->hasMany(Ejercicio::class)->where('tipo', 2);
    }
    public function evaluacionesEnabled()
    {
        return $this->hasMany(Ejercicio::class)->where('tipo', 2)->where('estado', true)->orderBy('posicion', 'asc');
    }
}
