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
        <h1 class="text-3xl text-center">{{ $tarea ? 'Editar Tarea' : 'Agregar Nueva Tarea' }}</h1>
        <form action="{{ $tarea ? route('tarea.update') : route('tarea.register') }}" method="POST" class=" space-y-4">
            @csrf
            @if ($tarea)
                @method('patch')
                <input name="tarea_id" value="{{ $tarea->id ?? 'null' }}" hidden>
            @else
                <input name="grupoId" hidden value="{{ $grupo_id }}">
            @endif
            <!-- Nombre Tarea -->
            <div>
                <x-input-label for="nombre" :value="__('Nombre')" />
                <x-text-input id="nombre" class="block mt-1 w-full" type="text" name="nombre" :value="old('nombre', $tarea->nombre ?? '')"
                    required autofocus />
                <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
            </div>
            <!-- Descripcion -->
            <div>
                <x-input-label for="descripcion" :value="__('Descripcion')" />
                <textarea name="descripcion" class="w-full">{{ old('descripcion', $tarea->descripcion ?? '') }}</textarea>
                <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="vencimiento" :value="__('Vencimiento')" />
                <x-text-input id="vencimiento" class="block mt-1 w-full" type="datetime-local" name="vencimiento"
                    :value="old('vencimiento', $tarea->vencimiento ?? '')" required autofocus />
                <x-input-error :messages="$errors->get('vencimiento')" class="mt-2" />
            </div>
            <div class="flex justify-end h-10">
                <x-primary-button>Subir nueva tarea</x-primary-button>
            </div>
        </form>
    </div>

</x-app-layout>
