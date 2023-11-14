<?php

namespace Database\Seeders;

use App\Models\Practica;
use Illuminate\Database\Seeder;

class PracticaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Postura corporal en parado
        //Postura corporal en sentado
        //Postura mano izquierda
        //Postura mano derecha
        $practicas = [
            [
                'nombre' => 'Postura corporal en parado',
                'cantidad_ejercicio' => '4',
                'cantidad_evaluacion' => '3',
                'puntos_ejercicio' => '400',
                'puntos_evaluacion' => '200',
                'estudio_id' => 1
            ],
            [
                'nombre' => 'Postura corporal en sentado',
                'cantidad_ejercicio' => '4',
                'cantidad_evaluacion' => '3',
                'puntos_ejercicio' => '400',
                'puntos_evaluacion' => '200',
                'estudio_id' => 1
            ],
            [
                'nombre' => 'Postura mano izquierda',
                'cantidad_ejercicio' => '4',
                'cantidad_evaluacion' => '3',
                'puntos_ejercicio' => '400',
                'puntos_evaluacion' => '200',
                'estudio_id' => 1
            ],
            [
                'nombre' => 'Postura mano derecha',
                'cantidad_ejercicio' => '4',
                'cantidad_evaluacion' => '3',
                'puntos_ejercicio' => '400',
                'puntos_evaluacion' => '200',
                'estudio_id' => 1
            ]
        ];
        foreach ($practicas as $practica) {
            Practica::created([
                $practica
            ]);
        }
    }
}
