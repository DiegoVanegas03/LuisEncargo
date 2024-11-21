<div x-data="{ open: false }" class="flex bg-gray-300 relative">
    {{-- Parte Cerrada del side bar --}}
    <div class=" z-20 px-2 flex flex-col cursor-pointer" @click="open = ! open">
        <!-- Botón de hamburguesa -->
        <button class="focus:outline-none flex items-center justify-center my-5">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
            </svg>
        </button>
        <div class="flex flex-1 items-center justify-center relative p-3">
            <p
                class="-rotate-90 absolute origin-left left-[10px] whitespace-nowrap overflow-hidden uppercase tracking-widest">
                Abre para ver tus grupos
            </p>
        </div>
    </div>
    <!-- Overlay para oscurecer el fondo -->
    <div x-show="open" @click="open = false"
        class="fixed inset-0 bg-black bg-opacity-50 z-40 transition-opacity duration-300"
        x-transition:enter="transition-opacity duration-200" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>

    <!-- Sidebar -->
    <div x-cloak x-show="open"
        class="bg-gray-200 shadow-lg flex flex-col items-center fixed h-full left-0 z-50 transition-transform duration-300 ease-in-out"
        x-transition:enter="transition ease-out duration-200" x-transition:enter-start="transform -translate-x-full"
        x-transition:enter-end="transform translate-x-0" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="transform translate-x-0" x-transition:leave-end="transform -translate-x-full">
        <div class="w-full text-end pt-2 px-2 text-lg text-gray-600">
            <i @click="open = false" class="fa-solid fa-xmark cursor-pointer"></i>
        </div>
        {{ $content }}
    </div>
</div>
