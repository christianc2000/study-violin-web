<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ejercicio extends Model
{
    use HasFactory;
    protected $table = 'ejercicios'; 
    protected $fillable = [
        'estado',
        'nombre', 
        'descripcion', 
        'posicion',
        'puntos', 
        'tipo',
        'practica_id']; 
    public function practica()
    {
        return $this->belongsTo(Practica::class);
    }
    
    public function contenidos()
    {
        return $this->hasMany(Contenido::class);
    }
    public function contenidosEnabled()
    {
        return $this->hasMany(Contenido::class)->where('estado', true)->orderBy('posicion', 'asc');
    }
    public function fechas()
    {
        return $this->belongsToMany(Fecha::class, 'ejercicio_fechas')
                    ->withPivot('puntuacion')
                    ->withTimestamps();
    }
}
