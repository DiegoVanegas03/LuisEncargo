<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Insertar manualmente los administradores
        DB::table('users')->insert([
            [
                'nombre' => 'Ana María',
                'apellidoP' => 'Gómez',
                'apellidoM' => 'Ruiz',
                'email' => 'admin@admin.com',
                'email_verified_at' => Carbon::now(),
                'clave' => '409874',
                'rol' => 'admin',
                'password' => bcrypt('password'),
            ],
        ]);

        // Generar 15 profesores
        User::factory()->count(20)->create([
            'rol' => 'profesor',
        ]);

        // Generar 200 alumnos
        User::factory()->count(200)->create([
            'rol' => 'alumno',
        ]);
    }
}
