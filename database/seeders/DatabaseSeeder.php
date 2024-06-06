<?php

namespace Database\Seeders;

use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        /* User::factory()->create([
             'name' => 'Test User',
             'email' => 'test@example.com',
         ]);*/

        /*LLamamos el Seeder de Roles*/
        $this->call([RoleSeeder::class]);

        //Usuario Administrador
        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678'),
        ])->assignRole('admin');
        //Usuario Funcionario
        User::create([
            'name' => 'funcionario',
            'email' => 'funcionario@admin.com',
            'password' => Hash::make('12345678'),
        ])->assignRole('usuario');
        //Usuario Visualizador
        User::create([
            'name' => 'visor',
            'email' => 'visor@admin.com',
            'password' => Hash::make('12345678'),
        ])->assignRole('usuario');


    }
}
