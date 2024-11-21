<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tarea;


class TareaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tarea::factory()->count(150)->create();
    }
}
