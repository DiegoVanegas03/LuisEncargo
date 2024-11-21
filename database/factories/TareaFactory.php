<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Grupo;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tarea>
 */
class TareaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $grupo = Grupo::inRandomOrder()->first();
        $tareas = [
            ['nombre' => 'Resolver ejercicios de álgebra lineal', 'descripcion' => 'Completa los ejercicios del capítulo 3 relacionados con matrices y determinantes.'],
            ['nombre' => 'Investigar sobre la fotosíntesis en plantas', 'descripcion' => 'Realiza un resumen sobre cómo las plantas convierten la luz solar en energía química.'],
            ['nombre' => 'Diseñar un logo para un proyecto escolar', 'descripcion' => 'Crea un logo atractivo usando herramientas como Canva o Photoshop.'],
            ['nombre' => 'Escribir un ensayo sobre la Revolución Francesa', 'descripcion' => 'Desarrolla un texto de 2 páginas explicando las causas y consecuencias de la Revolución.'],
            ['nombre' => 'Crear una presentación sobre inteligencia artificial', 'descripcion' => 'Diseña una presentación de 5 diapositivas sobre las aplicaciones actuales de la IA.'],
            ['nombre' => 'Resolver problemas de cálculo diferencial', 'descripcion' => 'Trabaja los ejercicios del libro, páginas 56-60, relacionados con derivadas.'],
            ['nombre' => 'Realizar una encuesta sobre hábitos de consumo', 'descripcion' => 'Crea una encuesta de 10 preguntas para entender las preferencias de los consumidores.'],
            ['nombre' => 'Analizar un poema de Pablo Neruda', 'descripcion' => 'Escribe un análisis literario sobre el simbolismo y los temas principales del poema.'],
            ['nombre' => 'Programar una calculadora en JavaScript', 'descripcion' => 'Desarrolla una calculadora funcional que realice operaciones básicas con HTML, CSS y JS.'],
            ['nombre' => 'Crear un plan de negocios para una startup', 'descripcion' => 'Elabora un esquema con la misión, visión y estrategia financiera de una empresa ficticia.'],
            ['nombre' => 'Dibujar un retrato a lápiz', 'descripcion' => 'Realiza un retrato de un compañero o familiar utilizando técnicas básicas de sombreado.'],
            ['nombre' => 'Estudiar los principios básicos de la termodinámica', 'descripcion' => 'Lee el capítulo 4 del libro y resume los tres principios fundamentales.'],
            ['nombre' => 'Leer y resumir el libro *1984* de George Orwell', 'descripcion' => 'Prepara un resumen de una página destacando los temas principales del libro.'],
            ['nombre' => 'Preparar un experimento de química básica', 'descripcion' => 'Realiza un experimento sencillo para demostrar la reacción ácido-base.'],
            ['nombre' => 'Configurar un servidor web con Apache', 'descripcion' => 'Instala Apache en tu máquina local y configura un sitio web básico con HTML.'],
            ['nombre' => 'Hacer una infografía sobre cambio climático', 'descripcion' => 'Crea una infografía que explique las causas y consecuencias del cambio climático.'],
            ['nombre' => 'Completar un mapa mental de ética profesional', 'descripcion' => 'Diseña un mapa mental destacando los principios clave de la ética en el trabajo.'],
            ['nombre' => 'Grabar un video explicando una receta de cocina', 'descripcion' => 'Prepara y graba un video corto mostrando cómo hacer tu receta favorita.'],
            ['nombre' => 'Resolver ejercicios de estadística descriptiva', 'descripcion' => 'Trabaja con tablas de frecuencias y calcula la media, mediana y moda de los datos.'],
            ['nombre' => 'Construir un prototipo de puente con palitos de madera', 'descripcion' => 'Diseña y ensambla un puente pequeño usando palitos y pegamento.'],
            ['nombre' => 'Redactar un artículo sobre avances tecnológicos recientes', 'descripcion' => 'Escribe un artículo breve sobre los avances más recientes en tecnología.'],
            ['nombre' => 'Investigar sobre los derechos humanos en tu país', 'descripcion' => 'Prepara un informe de una página sobre los derechos humanos más relevantes.'],
            ['nombre' => 'Modelar un diseño 3D usando Blender', 'descripcion' => 'Crea un modelo básico en Blender, como una taza o un cubo con texturas.'],
            ['nombre' => 'Resolver un caso práctico de microeconomía', 'descripcion' => 'Analiza la oferta y demanda en un mercado ficticio y responde las preguntas.'],
            ['nombre' => 'Escribir un código para ordenar una lista en Python', 'descripcion' => 'Implementa un algoritmo de ordenamiento, como el método de burbuja o selección.'],
            ['nombre' => 'Preparar un discurso para una presentación en público', 'descripcion' => 'Escribe y practica un discurso de 3 minutos sobre un tema de tu elección.'],
            ['nombre' => 'Hacer un collage de imágenes sobre el Renacimiento', 'descripcion' => 'Reúne imágenes representativas del Renacimiento y crea un collage en cartulina.'],
            ['nombre' => 'Escribir una historia corta de 500 palabras', 'descripcion' => 'Crea una narrativa original con un inicio, desarrollo y desenlace claros.'],
            ['nombre' => 'Planificar un itinerario para un viaje educativo', 'descripcion' => 'Diseña un plan de actividades para un viaje de un día a un museo local.'],
            ['nombre' => 'Diseñar una base de datos para un sistema de biblioteca', 'descripcion' => 'Crea un diagrama entidad-relación con tablas para libros, usuarios y préstamos.'],
        ];
        $tarea = $this->faker->randomElement($tareas);
        return [
            'profesor_id' => $grupo->profesor_id,
            'grupo_id' => $grupo->id,
            'nombre' => $tarea['nombre'],
            'descripcion' => $tarea['descripcion'],
            'vencimiento' => $this->faker->dateTimeBetween('now', '+20 days'),
        ];
    }
}
