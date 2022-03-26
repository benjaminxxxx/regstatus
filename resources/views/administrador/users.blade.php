<x-app-layout>
    
    <x-slot name="header">Registro de usuarios del sistema</x-slot>

    <div class="p-5">
        <div class="max-w-7xl mx-auto">
            @livewire('user-table')
        </div>
    </div>
</x-app-layout>
