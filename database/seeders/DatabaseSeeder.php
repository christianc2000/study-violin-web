<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UserSeeder::class);
        $this->call(EstudioSeeder::class);
        $this->call(PracticaSeeder::class);
        $this->call(EjercicioSeeder::class);
        $this->call(EvaluacionSeeder::class);
        $this->call(ContenidoSeeder::class);
        // $this->call(PlanEstudioSeeder::class);
        // $this->call(SemanaSeeder::class);
        // $this->call(EvaluacionSeeder::class);
        // $this->call(EjercicioSemanaSeeder::class);
    }
}
