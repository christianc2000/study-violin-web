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
            'url' => asset('imagenes/violinlogo.jpg'),
            'nombre' => 'Posturas',
            'puntos_requerido' => 0
        ]);
        Estudio::create([
            'url' => asset('imagenes/violinlogo.jpg'),
            'nombre' => 'Lectura Musical',
            'puntos_requerido' => 5000
        ]);
    }
}
