<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Materia;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MateriaFactory extends Factory
{
    protected $model = Materia::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $materias = [
            'Matemáticas Avanzadas',
            'Álgebra Lineal',
            'Cálculo Diferencial e Integral',
            'Física Cuántica',
            'Estadística y Probabilidad',
            'Biología Molecular',
            'Química Orgánica',
            'Ecología y Medio Ambiente',
            'Anatomía Humana',
            'Genética Aplicada',
            'Introducción a la Programación',
            'Bases de Datos Avanzadas',
            'Desarrollo de Aplicaciones Web',
            'Inteligencia Artificial',
            'Redes y Ciberseguridad',
            'Psicología General',
            'Historia Universal',
            'Filosofía Moderna',
            'Sociología Aplicada',
            'Ética Profesional',
            'Microeconomía',
            'Macroeconomía',
            'Finanzas Corporativas',
            'Marketing Digital',
            'Gestión de Recursos Humanos',
            'Historia del Arte',
            'Diseño Gráfico y Multimedia',
            'Fotografía Avanzada',
            'Técnicas de Ilustración',
            'Producción Audiovisual',
        ];
        return [
            'clave' => $this->faker->unique()->numerify('######'), // Clave única de materia
            'nombre' => $this->faker->randomElement($materias),               // Nombre de la materia
            'creditos' => $this->faker->numberBetween(1, 10),       // Créditos entre 1 y 10
            'created_at' => now(),                                  // Timestamp de creación actual
            'updated_at' => now(),                                  // Timestamp de última actualización actual
        ];
    }
}
