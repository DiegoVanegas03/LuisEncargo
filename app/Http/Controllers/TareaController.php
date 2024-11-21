<?php

namespace App\Http\Controllers;

use App\Models\Entregable;
use Illuminate\Http\Request;
use App\Models\Grupo;
use App\Models\Tarea;
use App\Models\Inscripcion;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;


class TareaController extends Controller
{
    public function index(Request $request, $id, $entregableId = null)
    {
        $user = $request->user();
        $tarea = Tarea::findOrFail($id);
        if ($user->rol == 'profesor') {
            $grupos = Grupo::where('profesor_id', $user->id)->get();
            $entregables = Entregable::where('tarea_id', $tarea->id)->get();
            if ($entregableId) {
                $activeEntregable = Entregable::findOrFail($entregableId);
                return view('tarea.profesor')->with(compact('tarea', 'grupos', 'entregables', 'activeEntregable'));
            }
            return view('tarea.index')->with(compact('tarea', 'grupos', 'entregables'));
        } else {
            $inscripciones = Inscripcion::where('alumno_id', $user->id)->with('grupo')->get();
            $grupos = $inscripciones->pluck('grupo');
            $activeEntregable = $tarea->entregable();
            return view('tarea.alumno')->with(compact('tarea', 'grupos', 'activeEntregable'));
        }
    }

    public function form(Request $request, $grupo_id)
    {
        $user = $request->user();
        $grupos = Grupo::where('profesor_id', $user->id)->get();
        $tarea = null;
        return view('tarea.form')->with(compact('grupos', 'grupo_id', 'tarea'));
    }

    public function store(Request $request)
    {
        $profesor = $request->user();
        $request->validate([
            'nombre' => ['required', 'max:255', 'string'],
            'grupoId' => ['required'],
            'descripcion' => ['required', 'max:255', 'string'],
            'vencimiento' => ['required', 'date'], // Valida que sea una fecha válida
        ]);

        $tarea = Tarea::create([
            'profesor_id' => $profesor->id,
            'grupo_id' => $request->get('grupoId'),
            'nombre' => $request->get('nombre'),
            'descripcion' => $request->get('descripcion'),
            'vencimiento' => $request->get('vencimiento'),
        ]);

        $grupo = Grupo::findOrFail($request->get('grupoId'));
        $inscritos = $grupo->inscripciones();
        $titulo = $tarea->nombre;
        $descripcion = $tarea->descripcion;
        $fecha_entrega = $tarea->vencimiento->format('d/m/Y');
        $url = route('tarea.index', [$tarea->id]);

        Mail::to("correodesarrollo@gmail.com")->send(new \App\Mail\TareaNueva($titulo, $descripcion, $fecha_entrega, $url));
        foreach ($inscritos as $inscrito) {
            //Mail::to("gamesonfon@gmail.com")->send(new \App\Mail\TareaNueva($titulo, $descripcion, $fecha_entrega, $url));
        }
        return redirect()->route('dashboard.grupo', $grupo->id)->with('success', 'Tarea guardada con éxito.');
    }

    public function edit(Request $request, $grupo_id, $tarea_id)
    {
        $user = $request->user();
        $grupos = Grupo::where('profesor_id', $user->id)->get();
        $tarea = Tarea::findOrFail($tarea_id);
        return view('tarea.form')->with(compact('grupos', 'grupo_id', 'tarea'));
    }



    public function update(Request $request)
    {
        $tarea = Tarea::findOrFail($request->get('tarea_id'));
        $tarea->update([
            'nombre' => $request->get('nombre'),
            'descripcion' => $request->get('descripcion'),
            'vencimiento' => $request->get('vencimiento')
        ]);
        $grupo_id = $tarea->grupo_id;
        $grupo = Grupo::findOrFail($grupo_id);
        $inscritos = $grupo->inscripciones();
        $titulo = $tarea->nombre;
        $descripcion = $tarea->descripcion;
        $fecha_entrega = $tarea->vencimiento->format('d/m/Y');
        $url = route('tarea.index', [$tarea->id]);

        Mail::to("correodesarrollo@gmail.com")->send(new \App\Mail\TareaNueva($titulo, $descripcion, $fecha_entrega, $url));
        foreach ($inscritos as $inscrito) {
            //Mail::to("gamesonfon@gmail.com")->send(new \App\Mail\TareaNueva($titulo, $descripcion, $fecha_entrega, $url));
        }

        return redirect()->route('dashboard.grupo', $grupo_id)->with('success', 'Actualizada con exito.');
    }

    public function destroy(Request $request): RedirectResponse
    {

        $tarea = Tarea::findOrFail($request->get('tarea_id'));
        $grupo_id = $tarea->grupo_id;
        $tarea->delete();

        return redirect()->route('dashboard.grupo', $grupo_id)->with('success', 'Eliminada con exito.');
    }
}
