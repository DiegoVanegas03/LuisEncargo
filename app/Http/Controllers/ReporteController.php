<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Grupo;
use App\Models\Entregable;

class ReporteController extends Controller
{
    public function index($id)
    {
        $grupo = Grupo::findOrFail($id);
        $tareas = $grupo->tareas()->get();
        $inscritos = $grupo->inscripciones()->get();
        $data = [];
        foreach ($inscritos as $inscrito) {
            $alumno = $inscrito->alumno;
            $data[$alumno->nombreCompleto()] = [];
            foreach ($tareas as $tarea) {
                $entrega = Entregable::where('alumno_id', $alumno->id)->where('tarea_id', $tarea->id)->first();
                $data[$alumno->nombreCompleto()][] = $entrega && $entrega->calificacion != null ? $entrega->calificacion : 0;
            }
        }
        $pdf = Pdf::loadView('reporte', compact('data', 'tareas'))->setPaper('a4', 'landscape');
        return $pdf->download('calificaciones-' . $grupo->materia->nombre . '.pdf');
    }

    public function download()
    {
        $data = [
            ['producto' => 'Laptop', 'precio' => 800, 'cantidad' => 1, 'descuento' => 50, 'total' => 750],
            ['producto' => 'Smartphone', 'precio' => 500, 'cantidad' => 2, 'descuento' => 30, 'total' => 970],
            ['producto' => 'Teclado Mecánico', 'precio' => 100, 'cantidad' => 3, 'descuento' => 15, 'total' => 285],
            ['producto' => 'Mouse Inalámbrico', 'precio' => 40, 'cantidad' => 2, 'descuento' => 5, 'total' => 75],
            ['producto' => 'Monitor 24"', 'precio' => 200, 'cantidad' => 1, 'descuento' => 20, 'total' => 180],
            ['producto' => 'Audífonos Bluetooth', 'precio' => 60, 'cantidad' => 4, 'descuento' => 10, 'total' => 230],
            ['producto' => 'Impresora Multifunción', 'precio' => 150, 'cantidad' => 1, 'descuento' => 15, 'total' => 135],
            ['producto' => 'Tablet', 'precio' => 300, 'cantidad' => 2, 'descuento' => 25, 'total' => 575],
            ['producto' => 'Silla Ergonomica', 'precio' => 120, 'cantidad' => 1, 'descuento' => 10, 'total' => 110],
            ['producto' => 'USB 64GB', 'precio' => 15, 'cantidad' => 5, 'descuento' => 5, 'total' => 70],
            ['producto' => 'Disco Duro Externo 1TB', 'precio' => 80, 'cantidad' => 2, 'descuento' => 10, 'total' => 150],
            ['producto' => 'Router WiFi', 'precio' => 60, 'cantidad' => 1, 'descuento' => 5, 'total' => 55],
            ['producto' => 'Cámara Web HD', 'precio' => 50, 'cantidad' => 3, 'descuento' => 10, 'total' => 140],
            ['producto' => 'Parlantes Bluetooth', 'precio' => 90, 'cantidad' => 2, 'descuento' => 15, 'total' => 165],
            ['producto' => 'Cargador Portátil', 'precio' => 30, 'cantidad' => 3, 'descuento' => 5, 'total' => 85],
            ['producto' => 'Estación de Carga', 'precio' => 25, 'cantidad' => 2, 'descuento' => 2, 'total' => 48],
            ['producto' => 'Smartwatch', 'precio' => 150, 'cantidad' => 1, 'descuento' => 20, 'total' => 130],
            ['producto' => 'Cables HDMI', 'precio' => 10, 'cantidad' => 6, 'descuento' => 3, 'total' => 57],
            ['producto' => 'Tarjeta de Memoria 128GB', 'precio' => 40, 'cantidad' => 3, 'descuento' => 8, 'total' => 112],
            ['producto' => 'Micrófono USB', 'precio' => 70, 'cantidad' => 1, 'descuento' => 10, 'total' => 60]
        ];
        $descarga = true;
        $pdf = Pdf::loadView('invoice', compact('data', 'descarga'));
        return $pdf->download('invoice.pdf');
    }
}
