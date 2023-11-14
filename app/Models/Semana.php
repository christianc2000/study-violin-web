<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semana extends Model
{
    use HasFactory;
    protected $table = 'semanas';
    protected $fillable = [
        'nro',
        'fecha_inicio',
        'fecha_fin',
        'puntos_obtenidos',
        'cantidad_evaluacion',
        'cantidad_restante_evaluacion',
        'plan_estudio_id'
    ];

    public function planEstudio()
    {
        return $this->belongsTo(PlanEstudio::class);
    }
    public function evaluaciones()
    {
        return $this->hasMany(Evaluacion::class);
    }
    public function ejercicioSemanas()
    {
        return $this->hasMany(EjercicioSemana::class);
    }
}
