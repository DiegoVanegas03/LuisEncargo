<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Tarea extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'profesor_id',
        'grupo_id',
        'nombre',
        'descripcion',
        'vencimiento',
    ];
    protected $casts = [
        'vencimiento' => 'datetime',
    ];

    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'grupo_id');
    }
    // Definir la relación de Tarea a Entregables
    public function entregables()
    {
        return $this->hasMany(Entregable::class);
    }

    // Método para contar entregables asociados a la tarea
    public function contarEntregables()
    {
        return $this->entregables()->count();
    }

    public function entregaAlumno()
    {
        return $this->entregables()->where('alumno_id', Auth::user()->id);
    }

    public function entregable()
    {
        return $this->entregaAlumno()->first();
    }



    public function getEstado()
    {
        $now = Carbon::now()->setTimezone('UTC');
        $vencimiento = Carbon::parse($this->vencimiento)->setTimezone('UTC');
        if (Auth::user()->rol == 'profesor') {
            $calificados = $this->entregables->every(function ($entregable) {
                return $entregable->calificacion;
            });
            if ($calificados && $this->contarEntregables() != 0) {
                return 'Calificados';
            }
            return 'Por calificar';
        }

        if ($this->entregaAlumno()->exists()) {
            return 'Entregado';
        }
        // Verificar si el vencimiento es en los próximos 3 días y aún no ha pasado.
        if ($now->lessThanOrEqualTo($vencimiento) && $now->diffInDays($vencimiento, false) <= 3) {
            return 'Por caducar';
        }

        // Verificar si ya ha pasado la fecha y hora de vencimiento.
        if ($now->greaterThan($vencimiento)) {
            return 'Vencida';
        }
        // Si no está en las condiciones anteriores, aún no está por caducar.
        return 'En espera';
    }
}
