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
        'ejercicio_id'];
     
    public function ejercicio()
    {
        return $this->belongsTo(Ejercicio::class);
    }
}
