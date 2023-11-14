<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
    use HasFactory;
    protected $table = 'evaluacions'; // Especifica el nombre de la tabla si no sigue la convención

    protected $fillable = [
        'detalle',
        'calificacion_obtenida',
        'puntos_evaluacion',
        'puntos_obtenidos',
        'semana_id',
        'practica_id'
    ];

    public function semana()
    {
        return $this->belongsTo(Semana::class);
    }

    public function practica()
    {
        return $this->belongsTo(Practica::class);
    }
}
