<?php

namespace Database\Seeders;

use App\Models\Contenido;
use Illuminate\Database\Seeder;

class ContenidoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
        $contenidos = [
            [
                'estado'=>true,
                'url'=>'https://rekognitions3-bucket.s3.amazonaws.com/study_violin/Ejercicios/Postura+erguida+1.jpg',
                'descripcion'=>'',
                'posicion'=>1,
                'ejercicio_id'=>1
            ],
            [
                'estado'=>true,
                'url'=>'https://rekognitions3-bucket.s3.amazonaws.com/study_violin/Ejercicios/Postura+erguida+2.jpg',
                'descripcion'=>'',
                'posicion'=>2,
                'ejercicio_id'=>1
            ],
            [
                'estado'=>true,
                'url'=>'https://rekognitions3-bucket.s3.amazonaws.com/study_violin/Ejercicios/Postura+erguida+3.jpg',
                'descripcion'=>'',
                'posicion'=>3,
                'ejercicio_id'=>1
            ],
            [
                'estado'=>true,
                'url'=>'https://rekognitions3-bucket.s3.amazonaws.com/study_violin/Ejercicios/Postura+erguida+1.jpg',
                'descripcion'=>'',
                'posicion'=>1,
                'url_teachable_model'=>'https://teachablemachine.withgoogle.com/models/73BIrLdUQ/',
                'ejercicio_id'=>2
            ],
        ];
        foreach ($contenidos as $contenido) {
            Contenido::create($contenido);
        }
    }
}
