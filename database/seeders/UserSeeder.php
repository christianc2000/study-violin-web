<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::created([
            'name' => 'Christian Celso',
            'email' => 'christian@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
    }
}
