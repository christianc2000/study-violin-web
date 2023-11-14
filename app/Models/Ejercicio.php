<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ejercicio extends Model
{
    use HasFactory;
    protected $table = 'ejercicios'; 
    protected $fillable = ['nombre', 'descripcion', 'tipo', 'puntos', 'practica_id']; 
    public function practica()
    {
        return $this->belongsTo(Practica::class);
    }
    public function ejercicioSemanas()
    {
        return $this->hasMany(EjercicioSemana::class);
    }
    public function contenidos()
    {
        return $this->hasMany(Contenido::class);
    }
}
