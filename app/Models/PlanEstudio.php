<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanEstudio extends Model
{
    use HasFactory;
    protected $table = 'plan_estudios'; 
    protected $fillable = ['descripcion', 'fecha_inicio', 'hora_inicio', 'cantidad_semana', 'status', 'user_id']; // Especifica los campos que se pueden llenar

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function semanas()
    {
        return $this->hasMany(Semana::class);
    }
}
