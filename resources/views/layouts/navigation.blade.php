@php
    $colorsText = ['alumno' => 'text-sky-400', 'profesor' => 'text-lime-400'];
@endphp
<header x-data="{ open: false }" class="bg-[#9cb6dd] sticky top-0 border-b z-50">
    <!-- Primary Navigation Menu -->
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex flex-shrink-0 items-center">
                    <a href="{{ route('dashboard') }}" class="flex gap-4 items-center">
                        <p>Moddle</p>
                    </a>
                </div>
            </div>

            <div class="px-4 flex items-center justify-center text-sm gap-3 h-full cursor-pointer">
                <p class="flex flex-col items-center">
                    <span class="uppercase">
                        {{ Auth::user()->nombre }}
                    </span>
                    <span
                        class="{{ $colorsText[Auth::user()->rol] }} italic font-extrabold text-xs">{{ Auth::user()->rol }}
                    </span>
                </p>
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <x-danger-button class="w-full justify-center"> Cerrar Session </x-danger-button>
                </form>
            </div>
        </div>
    </div>
</header>
