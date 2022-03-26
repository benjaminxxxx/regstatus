@php
    $input_class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block shadow-sm sm:text-sm border-gray-300 rounded-md";
    $input_class_b = "mt-1 focus:ring-indigo-500 focus:border-indigo-500 inline-block shadow-sm sm:text-sm border-gray-300 rounded-md";
@endphp
<x-app-layout>
    

    <x-slot name="header">Vacunación</x-slot>

    <div class="p-5">
        <div class="max-w-7xl mx-auto">

            @livewire('vacunacion')
            
        </div>
    </div>
</x-app-layout>
