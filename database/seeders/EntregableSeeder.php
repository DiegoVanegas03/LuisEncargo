<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Entregable;

class EntregableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Entregable::factory(150)->create();
    }
}
