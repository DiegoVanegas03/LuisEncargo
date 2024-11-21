<x-app-layout>
    @slot('menuLateral')
        <ul class="flex flex-col gap-4 items-center">
            @foreach ($grupos as $item)
                <li onclick="window.location.href='{{ route('dashboard.grupo', $item->id) }}'" role="button"
                    class="py-4 rounded-lg hover:opacity-50 bg-[#414e6e] w-full flex gap-4 items-center flex-col text-[#f2f7fb]">
                    <span><strong>Grupo: </strong>{{ $item->materia->nombre }}</span>
                    <div class="flex gap-2">
                        <span><strong>Inscritos: </strong>{{ $item->inscripciones()->count() }}</span>
                        <span><strong>Tareas: </strong>{{ $item->tareas()->count() }}</span>
                    </div>
                </li>
            @endforeach
        </ul>
    @endslot
    <div class="w-full py-4 px-5 space-y-4">
        <h1 class="text-3xl text-center">Tarea:
            <em class="text-2xl">
                {{ $tarea->nombre }}
            </em>
        </h1>
        <div class="flex flex-col justify-center gap-2">
            <h2>Entregas:</h2>
            @foreach ($entregables as $entregable)
                <a href="{{ route('tarea.entrega', [$tarea->id, $entregable->id]) }}"
                    class="bg-[#f2f7fb] rounded-lg hover:opacity-50 py-4 px-5 shadow-md">
                    <p class="w-full text-center text-xl">
                        {{ $entregable->alumno->nombreCompleto() }}
                    </p>
                    <div class="grid grid-cols-2 gap-3">
                        <p class="text-center">
                            <strong>Retroalimentacion:</strong>
                            {{ $tarea->retroalimentacion ?? 'Sin retroalimentacion' }}
                        </p>
                        <p class="text-ceter">
                            <strong>Calificacion:</strong>
                            {{ $tarea->calificacion ?? 'Sin calificacion' }}
                        </p>
                    </div>
                </a>
            @endforeach
            @if ($entregables->count() <= 0)
                <div class="text-center w-full italic font-bold text-sm">
                    No hay entregables por el momento
                </div>
            @endif
        </div>
    </div>

</x-app-layout>
