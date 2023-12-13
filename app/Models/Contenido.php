<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contenido extends Model
{
    use HasFactory;
    protected $table = 'contenidos';
    protected $fillable = [
        'estado',
        'url', 
        'descripcion', 
        'posicion', 
        'url_teachable_model',
        'ejercicio_id'];
     
    public function ejercicio()
    {
        return $this->belongsTo(Ejercicio::class);
    }

    public function fechas()
    {
        return $this->belongsToMany(Fecha::class, 'contenido_fechas')
                    ->withPivot('puntuacion', 'prediccion')
                    ->withTimestamps();
    }
}
