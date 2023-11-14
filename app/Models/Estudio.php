<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudio extends Model
{
    use HasFactory;
    protected $table = 'estudios'; 
    protected $fillable = ['url', 'nombre', 'puntos_requerido']; 

    public function practicas()
    {
        return $this->hasMany(Practica::class);
    }
}
