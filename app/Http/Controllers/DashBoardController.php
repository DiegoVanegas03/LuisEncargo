<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\Grupo;
use App\Models\Inscripcion;
use App\Models\Tarea;

class DashBoardController extends Controller
{
    public function index(Request $request, $grupo_id = null): View
    {
        $user = $request->user();

        $activeGrupo = $grupo_id != null ? Grupo::findOrFail($grupo_id) : [];

        $grupos = [];
        $tareas = [];

        if ($user->rol == 'profesor') {

            $grupos = Grupo::where('profesor_id', $user->id)->get();
            if ($activeGrupo) {
                $tareas = Tarea::where('profesor_id', $user->id)->where('grupo_id', $activeGrupo->id)->orderBy('created_at', 'desc')->get();
            }
        } elseif ($user->rol == "alumno") {
            $inscripciones = Inscripcion::where('alumno_id', $user->id)->with('grupo')->get();
            $grupos = $inscripciones->pluck('grupo');
            if (!$activeGrupo) {
                $tareas = $grupos->flatMap(function ($grupo) {
                    return $grupo
                        ? $grupo->tareas->filter(function ($tarea) {
                            return $tarea->getEstado() == 'Por caducar';
                        })
                        : collect();
                });
                return view('dashboard.alumno')->with(compact('grupos', 'activeGrupo', 'tareas'));
            } else {
                $tareas = $activeGrupo->tareas()->get();
            }
        }
        return view('dashboard.index')->with(compact('grupos', 'activeGrupo', 'tareas'));
    }
}
