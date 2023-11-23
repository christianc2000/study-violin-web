<?php

namespace Database\Seeders;

use App\Models\Ejercicio;
use Illuminate\Database\Seeder;

class EvaluacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
        $ejercicios = [
        [
            'estado'=>true,
            'posicion'=>1,
            'nombre' => 'Postura General',
            'descripcion' => 'Postura recta del cuerpo, con los pies en forma de "V" a la altura de los hombros',
            'puntos' => '100',
            'tipo'=>2,
            'practica_id' => 1
        ],
        [
            'estado'=>true,
            'posicion'=>2,
            'nombre' => 'Postura mano izquierda',
            'descripcion' => 'Agarrar el violín, con la espalda recta, pies en la linea de los hombres, rodillas ligeramente flexionadas y la nariz, diapason y pie izquierdo deben estar alineados',
            'puntos' => '100',
            'tipo'=>2,
            'practica_id' => 1
        ],
        [
            'estado'=>true,
            'posicion'=>3,
            'nombre' => 'Postura mano derecha',
            'descripcion' => 'Agarra el mástil o mango colocando la mano correctamente',
            'puntos' => '200',
            'tipo'=>2,
            'practica_id' => 1
        ]
    ];
    foreach ($ejercicios as $ejercicio) {
        Ejercicio::create(
            $ejercicio
        );
    }
    }
}
