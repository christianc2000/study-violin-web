<?php

namespace Database\Seeders;

use App\Models\Ejercicio;
use Illuminate\Database\Seeder;

class EjercicioSeeder extends Seeder
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
                'nombre' => 'Sujetar con el mentón',
                'descripcion' => 'Presionar el mentón con la clavicula para poder colocar el violín y mantenerlo en esa posición',
                'tipo'=>'E',
                'puntos' => '100',
                'practica_id' => 1
            ],
            [
                'nombre' => 'Cuerpo erguido',
                'descripcion' => 'Agarrar el violín, con la espalda recta, pies en la linea de los hombres, rodillas ligeramente flexionadas y la nariz, diapason y pie izquierdo deben estar alineados',
                'tipo'=>'E',
                'puntos' => '100',
                'practica_id' => 1
            ],
            [
                'nombre' => 'Evaluación-Practica 1',
                'descripcion' => 'Postura corporal',
                'tipo'=>'P',
                'puntos' => '200',
                'practica_id' => 1
            ]
        ];
        foreach ($ejercicios as $ejercicio) {
            Ejercicio::created([
                $ejercicio
            ]);
        }
    }
}
