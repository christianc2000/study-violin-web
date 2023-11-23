<?php

namespace Database\Seeders;

use App\Models\Estudio;
use Illuminate\Database\Seeder;

class EstudioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Estudio::create([
            'estado'=>true,
            'url' => "https://rekognitions3-bucket.s3.amazonaws.com/study_violin/violinlogo.jpg",
            'nombre' => 'Técnicas',
            'puntos_requerido' => 0
        ]);
        Estudio::create([
            'estado'=>true,
            'url' => "https://rekognitions3-bucket.s3.amazonaws.com/study_violin/violinlogo.jpg",
            'nombre' => 'Lectura Musical',
            'puntos_requerido' => 15000
        ]);
    }
}
