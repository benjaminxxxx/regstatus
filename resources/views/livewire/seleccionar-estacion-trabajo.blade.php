<div>
    @php
        $title="font-bold  mt-5 text-2xl";
        $card_class_2 = "bg-white text-center shadow-md block rounded-lg p-5  text-center ";
        $card_class = "bg-white hover:bg-indigo-100 text-center shadow-md block rounded-lg p-5  text-center hover:shadow-lg transition duration-700 mt-3";
        $input_label = 'block text-sm font-medium text-gray-700 text-left mb-2';
        $btn = 'flex items-center px-3 py-2 rounded overflow-hidden shadow ';
        $th = "px-3 py-2 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider";
        $input_class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm";
    @endphp
    <style>
        .dropdown:focus-within .dropdown-menu {
          opacity:1;
          transform: translate(0) scale(1);
          visibility: visible;
        }
    </style>
    <x-center>    
        <div class="max-w-3xl mx-auto">
            @if($seleccionado==null)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            <a href="#" wire:click.prevent="choose('admision')" class="{{$card_class}} col-span-1">
                <img src="{{asset('images/triaje.png')}}" alt="Triaje" class="w-20 m-auto">
                <p class="mt-2">ADMISIÓN</p>
            </a>
            <a href="#" wire:click.prevent="choose('vacunatorio')" class="{{$card_class}} col-span-1">
                <img src="{{asset('images/vacunacion.png')}}" alt="Triaje" class="w-20 m-auto">
                <P class="mt-2">VACUNATORIO</P>
            </a>
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
        @else
        <div class="{{$card_class_2}}">

            @if($seleccionado=='admision')
                <form action="#" wire:submit.prevent="entrarAdmision()">
                    <img src="{{asset('images/triaje.png')}}" alt="Triaje" class="w-20 m-auto">
                    <p class="mt-2">ADMISIÓN</p>
                    @if($modotolerante==true)
                    <label for="establecimiento_id" class="{{$input_label}} mt-3">SELECCIONAR SEDE</label>
                    <select wire:model="establecimiento_id" wire:change="getadmision()" class="{{$input_class}}">
                        <option value="">ELEGIR</option>
                        @if($establecimientos->count()>0)
                        @foreach ($establecimientos as $establecimiento)
                            <option value="{{$establecimiento->id}}">{{mb_strtoupper($establecimiento->nombre)}}</option>
                        @endforeach
                        @endif
                    </select>
                    @else
                    <label for="establecimiento_id" class="{{$input_label}} mt-3">SEDE</label>
                    <p class="text-left">{{$nombre_sede}}</p>
                    @endif
                    <label for="estacion_id" class="{{$input_label}} mt-3">ESTACIÓN DE TRABAJO </label>
                    <select wire:model="estacion_id" required  class="{{$input_class}}">
                        <option value="">ELEGIR</option>
                        @IF($modulos_admision!=null)
                        @if($modulos_admision->count()>0)
                        @foreach ($modulos_admision as $modulo_admision)
                            <option value="{{$modulo_admision->id}}">{{mb_strtoupper($modulo_admision->nombre_modulo)}}</option>
                        @endforeach
                        @endif
                        @endif
                    </select>
                    <div class="flex items-center justify-center mt-10">
                        <button type="button" wire:click="volver()" class="{{$btn}} mr-2 border border-indigo-600 text-indigo-600 bg-white hover:bg-gray-200">
                            VOLVER
                        </button>
                        <button type="submit" class="{{$btn}} text-white ml-2  bg-indigo-600 hover:bg-indigo-700">
                            INGRESAR
                        </button>
                    </div>
                </form> 
            @else
            <form action="#" wire:submit.prevent="entrarVacunatorio()">
                <img src="{{asset('images/vacunacion.png')}}" alt="Triaje" class="w-20 m-auto">
                <p class="mt-2">VACUNATORIO</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mt-10">
                    <div class="col-span-1">
                       
                        @if($modotolerante==true)
                        <label for="establecimiento_id" class="{{$input_label}} mt-3">SELECCIONAR SEDE</label>
                        <select wire:model="establecimiento_id" wire:change="getvacunatorio()" class="{{$input_class}}">
                            <option value="">ELEGIR</option>
                            @if($establecimientos->count()>0)
                            @foreach ($establecimientos as $establecimiento)
                                <option value="{{$establecimiento->id}}">{{mb_strtoupper($establecimiento->nombre)}}</option>
                            @endforeach
                            @endif
                        </select>
                        @else
                        <label for="establecimiento_id" class="{{$input_label}} mt-3">SEDE</label>
                        <p class="text-left">{{$nombre_sede}}</p>
                        @endif
                    </div>
                    <div class="col-span-1">
                        <label for="estacion_id" class="{{$input_label}} mt-3">ESTACIÓN DE TRABAJO</label>
                        <select wire:model.defer="estacion_id" required wire:change="getvacunatorio()" class="{{$input_class}}">
                            <option value="">ELEGIR</option>
                            @if($modulos_vacunatorio!=null)
                            @if($modulos_vacunatorio->count()>0)
                            @foreach ($modulos_vacunatorio as $modulo_vacunatorio)
                                <option value="{{$modulo_vacunatorio->id}}">{{mb_strtoupper($modulo_vacunatorio->nombre_vacunatorio)}}</option>
                            @endforeach
                            @endif
                            @endif
                        </select>
                    </div>
                    <div class="col-span-1">
                        <label for="estacion_id" class="{{$input_label}} mt-3">SELECCIONAR VACUNADOR(A)</label>
                        <div class=" relative inline-block text-left dropdown w-full">
                            <span class="rounded-md shadow-sm"
                                ><button class="inline-flex justify-left w-full px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800" 
                                type="button" aria-haspopup="true" aria-expanded="true" aria-controls="headlessui-menu-items-117">
                                <span>{{$textvacunador}}</span>
                                <svg class="w-5 h-5 ml-2 -mr-1" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                </button
                            ></span>
                            <div class="opacity-0 invisible dropdown-menu transition-all duration-300 transform origin-top-right -translate-y-2 scale-95">
                                <div class="absolute right-0 w-auto mt-2 origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg outline-none" aria-labelledby="headlessui-menu-button-1" id="headlessui-menu-items-117" role="menu">
                                    <div class="px-4 py-3">   
                                        <div class="pb-5 pt-3">
                                            <x-label value="Buscar por DNI o Nombres"/>
                                            <x-input type="text" wire:model="filtro" class="w-full" />
                                        </div>
                                        <div class="bg-white overflow-x-auto border">
                                            <table class="min-w-full divide-y divide-gray-200">
                                                <thead>
                                                    <tr>
                                                        <th class="{{$th}} whitespace-nowrap">APELLIDOS Y NOMBRES</th>
                                                        <th class="{{$th}}">ESTADO</th>
                                                        <th class="{{$th}}">ACCIÓN</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if($vacunadores!=null)
                                                        @if($vacunadores->count()>0)
                                                            @php
                                                                $cont_vacunador = 0;
                                                            @endphp
                                                            @foreach ($vacunadores as $vacunador)
                                                            @php
                                                                $cont_vacunador++;
                                                            @endphp
                                                            <tr>
                                                                <td class="px-3 py-2 text-left text-sm leading-5 font-medium break-all md:whitespace-nowrap">
                                                                    {{mb_strtoupper($vacunador->name)}}
                                                                </td>
                                                                <td class="px-3 py-2 text-center text-sm leading-5 font-medium break-all md:whitespace-nowrap">
                                                                    {{$vacunador->estado_labor}}
                                                                </td>
                                                                <td class="px-3 py-2 text-center text-sm leading-5 font-medium sm:break-all">
                                                                    
                                                                    @if($vacunador->estado_labor=='DISPONIBLE' || $vacunador->estado_labor==null  || $vacunador->ocupado_con==Auth::id())
                                                                    <input type="radio" @if($cont_vacunador==1) required @endif wire:change="elegirVacunador('{{$vacunador->name}}')" wire:model.defer="vacunador_id" value="{{$vacunador->id}}" name="vacunador_id">
                                                                    @endif

                                                                    
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        @endif
                                                    @endif
                                                </tbody>
                                            </table> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-1">
                        <label for="establecimiento_id" class="{{$input_label}} mt-3">CÓDIGO AUTENTICADOR</label>
                        <input type="text" wire:model.defer="codigo_autenticador" required class="{{$input_class}}" >
                    </div>
                    <div class="col-span-1 md:col-span-2 mt-5">
                        @if($message!=null)
                        <p class="w-full text-right pb-2">{{$message}}</p>
                        @endif
                        <p class="w-full text-right pb-2" wire:loading wire:target="entrarVacunatorio">Procesando...</p>
                        <div class="w-full flex items-center justify-end">
                            
                            <x-secondary-button type="button" wire:click="volver()">
                                VOLVER
                            </x-secondary-button>
                            <x-button class="ml-3">
                                INGRESAR
                            </x-button>
                        </div>
                    </div>
                </div>
                
            </form>
            @endif
        </div>
            
        @endif
        </div>
    </x-center>
</div>
