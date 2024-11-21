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
                    @if (Auth::user()->rol == 'alumno')
                        <span><strong>Profesor: </strong>{{ $item->profesor->nombreCompleto() }}</span>
                    @endif
                </li>
            @endforeach
        </ul>
    @endslot
    <div class="w-full py-4 px-5 space-y-4">
        <h1 class="text-3xl text-center">Tareas del grupo :
            <em class="text-2xl">
                {{ $activeGrupo ? $activeGrupo->materia->nombre : 'Grupo no seleccionado' }}
            </em>
        </h1>
        @if (Auth::user()->rol == 'profesor')
            <x-secondary-button :disabled="$activeGrupo ? false : true"
                onclick="if ({{ $activeGrupo ? 'true' : 'false' }}) { window.location.href='{{ route('tarea.form', $activeGrupo->id ?? '') }}'; }"
                class="w-full h-12 justify-center">
                Agregar una nueva tarea
            </x-secondary-button>
        @endif
        <div class="flex flex-col justify-center gap-2">
            @foreach ($tareas as $tarea)
                <div class="bg-[#f2f7fb]  rounded-lg py-4 relative px-5 shadow-md">
                    <a href="{{ route('tarea.index', $tarea->id) }}" class="hover:opacity-50">
                        <p class="w-full text-center text-xl">
                            {{ $tarea->nombre }}
                        </p>
                        <div class="grid grid-cols-3 gap-3">
                            <p>
                                <strong>Descripcion:</strong>
                                {{ $tarea->descripcion }}
                            </p>
                            <div>
                                @if (Auth::user()->rol == 'profesor')
                                    <p class="text-center">
                                        <strong>Entregadas:</strong>
                                        {{ $tarea->contarEntregables() }}
                                    </p>
                                @endif
                                <p class="text-center">
                                    <strong>Vencimiento:</strong>
                                    {{ $tarea->vencimiento->format('m/d/Y') }}

                                </p>
                            </div>

                        </div>
                    </a>
                    @if (Auth::user()->rol == 'profesor')
                        <div class="flex gap-4 items-center justify-center text-2xl z-20 absolute right-5 top-5">
                            <i class="fa-solid fa-pen-to-square" role="button"
                                onclick="window.location.href='{{ route('grupo.tarea.edit', [$activeGrupo->id, $tarea->id]) }}'">
                            </i>
                            <form action="{{ route('tarea.destroy') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="tarea_id" value="{{ $tarea->id }}">
                                <i class="fa-solid fa-trash" role="button" onclick="this.closest('form').submit();"
                                    style="cursor: pointer;"></i>
                            </form>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

</x-app-layout>
