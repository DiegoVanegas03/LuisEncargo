<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Grupo;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Entregable>
 */
class EntregableFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        do {
            $grupo = Grupo::inRandomOrder()->first();
        } while ($grupo->inscripciones()->count() == 0 || $grupo->tareas()->count() == 0);
        $tarea = $grupo->tareas()->inRandomOrder()->first();
        $inscripcion = $grupo->inscripciones()->inRandomOrder()->first();
        return [
            'tarea_id' => $tarea->id,
            'alumno_id' => $inscripcion->alumno_id,
            'retroalimentacion' => '',
            'calificacion' => null,
            'documento' => '',
        ];
    }
}
