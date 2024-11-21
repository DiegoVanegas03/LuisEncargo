<?php

namespace App\Http\Controllers;

use App\Models\Entregable;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class EntregableController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'file' => 'required|mimes:pdf|max:5120', // 5120 KB = 5 MB
        ]);
        $user = $request->user();
        $nombreArchivo = 'entrega_' . $user->id . '_' . time() . '.' . $request->file('file')->getClientOriginalExtension();
        $path = $request->file('file')->storeAs('entregas', $nombreArchivo, 'public');
        $entrega = Entregable::create([
            'alumno_id' => $user->id,
            'tarea_id' => $request->get('tarea_id'),
            'documento' => $path
        ]);
        $nombre_alumno = $user->nombreCompleto();
        $fecha_entrega = $entrega->created_at->format('Y-m-d');
        $hora_entrega = $entrega->created_at->format('H:i');
        $url = route('tarea.entrega', [$entrega->tarea->id, $entrega->id]);
        Mail::to("correodesarrollo@gmail.com")->send(new \App\Mail\EntregaNueva($nombre_alumno, $fecha_entrega, $hora_entrega, $url));
        return redirect()->back()->with('success', 'Entrega enviada con éxito.');
    }

    public function update(Request $request)
    {
        $entregable = Entregable::findOrFail($request->get('idEntregable'));
        $entregable->update([
            'retroalimentacion' => $request->get('retroalimentacion'),
            'calificacion' => $request->get('calificacionEntrega'),
        ]);
        return redirect()->back()->with('success', 'Se califico con éxito.');
    }
}
