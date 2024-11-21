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
        <div class="flex bg-[#f2f7fb] rounded-xl drop-shadow flex-col justify-center gap-2 py-2 p-5">
            <p>
                <strong>Descripcion:</strong>
                {{ $tarea->descripcion }}
            </p>
            <p>
                <strong>Vencimiento:</strong>
                {{ $tarea->vencimiento->format('d/m/Y') }}
            </p>
            <hr>
            @if ($activeEntregable)
                <form method="POST" action="{{ route('entregable.update') }}" class=" flex justify-center gap-4">
                    @csrf
                    <input hidden value="{{ $activeEntregable->id }}" name="idEntregable">
                    <p>
                        <strong>Calificacion:</strong>
                        <x-text-input id="calificacionEntrega" class="block mt-1 w-full" type="number" step="0.01"
                            name="calificacionEntrega" :value="old('calificacionEntrega', $activeEntregable->calificacion ?? '')" required autofocus />
                    </p>
                    <p>
                        <strong>Retroalimentacion:</strong>
                        <textarea name="retroalimentacion" class="w-full">{{ old('retroalimentacion', $activeEntregable->retroalimentacion ?? '') }}</textarea>
                    </p>
                    <a href="{{ asset('/storage/' . $activeEntregable->documento) }}"
                        class="text-blue-400 underline">Ver documento</a>
                    <x-primary-button>Enviar calificacion</x-primary-button>
                </form>
            @else
                <form method="POST" action="{{ route('entregable.register') }}" enctype="multipart/form-data"
                    class="flex flex-col gap-4 w-full items-center justify-center">
                    @csrf
                    <input hidden value="{{ $tarea->id }}" name="tarea_id">
                    <p class="w-full">Subir archivo para entregar:</p>
                    <label for="file" role="button"
                        class="flex flex-col justify-center items-center hover:opacity-50 gap-4 rounded-xl border border-black p-3 bg-gray-200 max-w-2xl w-full">
                        <i class="fa-solid fa-folder text-5xl"></i>
                        <p id="textoInput">
                            Subir Archivo para entregar
                        </p>
                        <input id="file" name="file" hidden type="file" accept=".pdf">
                    </label>

                    <script>
                        const htmlTextFile = document.getElementById('textoInput');
                        const inputFile = document.getElementById('file');

                        inputFile.addEventListener('change', function() {
                            if (inputFile.files.length > 0) {
                                // Cambia el texto del <p> al nombre del archivo
                                htmlTextFile.innerText = inputFile.files[0].name;
                            } else {
                                // Reinicia el texto si no hay archivo seleccionado
                                htmlTextFile.innerText = 'Subir Archivo para entregar';
                            }
                        });
                    </script>
                    <x-primary-button>Enviar entrega</x-primary-button>
                </form>
            @endif
        </div>
    </div>

</x-app-layout>
