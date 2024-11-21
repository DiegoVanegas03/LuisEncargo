<div {{ $attributes->merge(['class' => 'block transition-all ease-out duration-200']) }} x-data="{ open: false }"
    @click.outside="open = false" @close.stop="open = false">
    <div class="w-full" @click="open = ! open">
        {{ $trigger }}
    </div>

    <div x-show="open" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95" class="mt-2 rounded-md shadow-lg" style="display: none;">
        {{ $slot }}
    </div>
</div>
