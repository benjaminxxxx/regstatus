<div>
    <x-center>
        <div class="w-full max-w-4xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 ">
                <x-box class=" col-span-1">
                   
                    @if(Auth::user()->firma!=null && Auth::user()->establecimiento_id!=null)
                    <a href="#" wire:click.prevent="choose('triaje')" class="w-full" >
                        <img src="{{asset('images/triaje.png')}}" alt="Triaje" class="w-20 m-auto">
                        
                        <x-label class="mt-2">TRIAJE</x-label>
                    </a>
                    @else
                    <div class="w-full" >
                        <img src="{{asset('images/triaje.png')}}" alt="Triaje" class="w-20 m-auto">
                        
                        <x-label class="mt-2">TRIAJE</x-label>
                        <p class="text-sm text-red-400">No puedes acceder aquí si no tienes una firma o registrado en una sede</p>
                    </div>
                    @endif
                </x-box>
                <x-box class=" col-span-1">
                    <!---->
                    @if(Auth::user()->establecimiento_id!=null)
                    <a href="#" wire:click.prevent="choose('monitoreo')" class="w-full" >
                        <img src="{{asset('images/monitoreo.svg')}}" alt="Triaje" class="w-20 m-auto">
                        
                        <x-label class="mt-2">MONITOREO</x-label>
                    </a>
                    @else
                    <div class="w-full" >
                        <img src="{{asset('images/monitoreo.svg')}}" alt="Triaje" class="w-20 m-auto">
                        
                        <x-label class="mt-2">MONITOREO</x-label>
                        <p class="text-sm text-red-400">No tienes una sede configurada</p>
                    </div>
                    @endif
                </x-box>
                <div class="col-span-1 md:col-span-2 text-center">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-jet-dropdown-link class="underline" href="{{ route('logout') }}"
                                 onclick="event.preventDefault();
                                        this.closest('form').submit();">
                            Salir
                        </x-jet-dropdown-link>
                    </form>
                </div>
            </div>
        </div>
        
    </x-center>
    
</div>
