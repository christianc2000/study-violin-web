<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EjercicioSemana extends Model
{
    use HasFactory;
    protected $table = 'ejercicio_semanas'; // Especifica el nombre de la tabla si no sigue la convención

    protected $fillable = [
        'completado',
        'puntos_obtenidos',
        'semana_id',
        'ejercicio_id'
    ];

    public function semana()
    {
        return $this->belongsTo(Semana::class);
    }

    public function ejercicio()
    {
        return $this->belongsTo(Ejercicio::class);
    }
}
