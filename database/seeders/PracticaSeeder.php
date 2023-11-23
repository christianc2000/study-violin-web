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
        $practicas = [
            [
                'estado'=>true,
                'nombre' => 'Postura corporal',
                'url'=>'https://rekognitions3-bucket.s3.amazonaws.com/study_violin/postura+violin.jpg',
                'cantidad_ejercicio' => '4',
                'cantidad_evaluacion' => '3',
                'cantidad_puntos' => '400',
                'estudio_id' => 1
            ],
            [
                'estado'=>true,
                'nombre' => 'Mano izquierda',
                'url'=>'https://rekognitions3-bucket.s3.amazonaws.com/study_violin/postura+mano+izquierda2.jpg',
                'cantidad_ejercicio' => '4',
                'cantidad_evaluacion' => '3',
                'cantidad_puntos' => '400',
                'estudio_id' => 1
            ],
            [
                'estado'=>true,
                'nombre' => 'Mano izquierda',
                'url'=>'https://rekognitions3-bucket.s3.amazonaws.com/study_violin/postura+arco.jpeg',
                'cantidad_ejercicio' => '4',
                'cantidad_evaluacion' => '3',
                'cantidad_puntos' => '400',
                'estudio_id' => 1
            ],
           
        ];
        foreach ($practicas as $practica) {
            Practica::create(
                $practica
            );
        }
    }
}
