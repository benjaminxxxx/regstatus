<div>
    <x-slot name="header">FIRMAS</x-slot>
    
    <div class="p-5">
        <x-panel>
            <div class="px-4 py-5 bg-white sm:p-6">
                <x-button type="button" wire:click.prevent="cambiarprenombres()">Cambiar prenombre</x-button>
                    <br/>
                    <br/>
                <div class="bg-white overflow-x-auto border">
                    
                    
                
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <x-th value="NOMBRE" />
                                <x-th value="FIRMA" />
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @if($users->count()>0)     
                        
                            @foreach ($users as $user)
                            <tr class="">
                                    
                                <x-td>
                                    {{$user->name}}
                                </x-td>
                                <x-td>
                                    {{$user->firma}}
                                </x-td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </x-panel>
    </div>
</div>
