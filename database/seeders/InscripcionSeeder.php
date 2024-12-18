<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Inscripcion;

class InscripcionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Inscripcion::factory()->count(200)->create();
    }
}
