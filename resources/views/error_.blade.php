
<x-app-layout>
    

    <x-slot name="header">Error encontrado</x-slot>

    
    <div class="p-5">
        <div class="max-w-7xl mx-auto">
            <div wire:id="uLReaboyNl9YDhQQU26B" class="max-w-7xl mx-auto ">
                <div class="bg-red-600 text-white overflow-hidden shadow-xl sm:rounded-lg p-2 md:p-7">
                    {{$message}} 
                </div>
            </div>        
        </div>
    </div>
</x-app-layout>