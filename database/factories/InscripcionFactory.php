<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Grupo;
use App\Models\Inscripcion;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inscripcion>
 */
class InscripcionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $alumno_id = User::where('rol', 'alumno')->inRandomOrder()->first()->id;
        $grupo_id = Grupo::inRandomOrder()->first()->id;
        return [
            'alumno_id' => $alumno_id,
            'grupo_id' => $grupo_id,
            'estado' => true,
        ];
    }
}
