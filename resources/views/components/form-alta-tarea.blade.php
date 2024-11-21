@props(['activeGrupo', 'activeTarea'])
<div {{ $attributes->merge(['class' => 'p-4 flex  flex-col justify-center']) }}>
    @if ($activeTarea)
        <h1 class="text-center tracking-widest uppercase text-2xl md:text-4xl mb-4 text-yellow-400">Edicion de tarea</h1>
    @else
        <h1 class="text-center tracking-widest uppercase text-2xl md:text-4xl mb-4">Nueva Tarea</h1>
    @endif
    <form action="{{ route(isset($activeTarea->id) ? 'tarea.update' : 'tarea.register') }}" method="POST"
        class="grid gap-4">
        @if (isset($activeTarea->id))
            @method('patch');
            <input name="tarea_id" value="{{ $activeTarea->id ?? 'null' }}" hidden>
        @else
            <input name="grupoId" value="{{ $activeGrupo->id ?? 'null' }}" hidden>
        @endif
        @csrf
        <!-- Nombre de la tarea -->
        <div>
            <x-input-label for="nombreTarea" :value="__('Nombre de la tarea')" />
            <x-text-input id="nombreTarea" class="block mt-1 w-full" type="text" name="nombreTarea" :value="old('nombreTarea', $activeTarea ? $activeTarea->nombre : '')"
                required autofocus :disabled="$activeGrupo == null" />
            <x-input-error :messages="$errors->get('nombreTarea')" class="mt-2" />
        </div>
        <!-- Descripcion de la tarea -->
        <div>
            <x-input-label for="descripcionTarea" :value="__('Descripción de la tarea')" />
            <textarea id="descripcionTarea" name="descripcionTarea" class="w-full border-gray-300 border-dashed rounded-2xl p-2"
                rows="10" placeholder="Descripción de la tarea" {{ $activeGrupo == null ? 'disabled' : '' }} required>{{ old('descripcionTarea', $activeTarea ? $activeTarea->descripcion : '') }}</textarea>
            <x-input-error :messages="$errors->get('descripcionTarea')" class="mt-2" />
        </div>
        <!-- Vencimiento de la tarea -->
        <div>
            <x-input-label for="vencimientoTarea" :value="__('Vencimiento de la tarea')" />
            <x-text-input id="vencimientoTarea" class="block mt-1 w-full" type="datetime-local" name="vencimientoTarea"
                :value="old('vencimientoTarea', $activeTarea ? $activeTarea->vencimiento : '')" required autofocus :disabled="$activeGrupo == null" />
            <x-input-error :messages="$errors->get('vencimientoTarea')" class="mt-2" />
        </div>
        @if ($activeTarea)
            <div class="grid grid-cols-2 gap-4 w-full ">
                <x-secondary-button class="h-10 w-full justify-center"
                    onclick="window.location.href='{{ route('dashboard.grupo', $activeGrupo->id) }}'">
                    Cancelar Edición
                </x-secondary-button>
                <x-primary-button class="justify-center h-10 bg-green-600 hover:bg-green-800">
                    {{ __('Guardar Cambios') }}
                </x-primary-button>
            </div>
        @else
            <x-primary-button class=" justify-center h-10" :disabled="$activeGrupo == null">
                {{ __('Subir tarea') }}
            </x-primary-button>
        @endif

    </form>
</div>
