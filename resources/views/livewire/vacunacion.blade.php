<div>
    @php
        $input_class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block shadow-sm sm:text-sm border-gray-300 rounded-md";
        $input_class_b = "mt-1 focus:ring-indigo-500 focus:border-indigo-500 inline-block shadow-sm sm:text-sm border-gray-300 rounded-md";
        $input_class_c = "mt-1 inline-block shadow-sm sm:text-sm border-gray-300 bg-gray-200 rounded-md cursor-not-allowed select-none";
     
    @endphp
    <div class="messages absolute right-3 top-3">
        @if ($message_error!=null)
            <div class="bg-red-100 notification border-l-4 border-red-500 text-red-700 rounded overflow-hidden shadow-lg relative p-4">
                <a href="#" wire:click.prevent="eliminar_error()" class="bg-red-200 text-2xl absolute right-0 top-0 px-2 hover:bg-red-300 text-red-700 ">&times;</a>
                <p class="font-bold">Alerta del sistema</p><p>{{$message_error}}</p>
            </div>
        @endif
        @if ($message_success!=null)
            <div class="bg-green-100 notification border-l-4 border-green-500 text-green-700 rounded overflow-hidden shadow-lg relative p-4">
                <a href="#" wire:click.prevent="eliminar_success()" class="bg-green-200 text-2xl absolute right-0 top-0 px-2 hover:bg-green-300 text-green-700 ">&times;</a>
                <p class="font-bold">Mensaje del sistema</p><p>{{$message_success}}</p>
            </div>
        @endif
    </div>
    @if ($registros!=null && $registros->count()>1)
    <div class="fixed inset-0 bg-black bg-opacity-70" style="z-index: 9999">
        <div class="min-h-screen flex items-center px-4">
            <div class='overflow-x-auto w-full'>
        
                <!-- Table -->
                <table class='mx-auto max-w-4xl w-full whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
                    <thead class="bg-gray-50">
                        <tr class="text-gray-600 text-left">
                            <th class="font-semibold text-sm uppercase px-6 py-4">
                                NOMBRES COMPLETOS
                            </th>
                            <th class="font-semibold text-sm uppercase px-6 py-4">
                                APTO
                            </th>
                            <th class="font-semibold text-sm uppercase px-6 py-4">
                                ESTADO
                            </th>
                            
                            <th class="font-semibold text-sm uppercase px-6 py-4 text-center">
                                GRUPO DE RIESGO
                            </th>
                            <th class="font-semibold text-sm uppercase px-6 py-4 text-center">
                                TRIAJE
                            </th>
                            <th class="font-semibold text-sm uppercase px-6 py-4 text-center">
                                DOSIS N°
                            </th>
                            <th class="font-semibold text-sm uppercase px-6 py-4">
                                
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($registros as $registro)
                        <tr>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="">
                                        {{$registro->nombre . ', ' . $registro->apellido_paterno . ' ' . $registro->apellido_materno}}
                                    </p>
                                    <p class="text-gray-500 text-sm font-semibold tracking-wide">
                                        {{$registro->observacion}}
                                    </p>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                
                                <p>{{$registro->apto}}</p>
                            </td>
                            <td class="px-6 py-4">
                                
                                @if($registro->estado==0)
                                <span class="text-red-800 bg-red-200 font-semibold px-2 rounded-full">
                                    EN TRIAJE
                                </span>
                                @endif
                                @if($registro->estado==2)
                                <span class="text-yellow-800 bg-yellow-200 font-semibold px-2 rounded-full">
                                    EN VACUNACIÓN
                                </span>
                                @endif
                                @if($registro->estado==1)
                                <span class="text-green-800 bg-green-200 font-semibold px-2 rounded-full">
                                    DE ALTA
                                </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                
                                <p style="max-width: 200px; white-space: pre-wrap; font-size: 11px;">{{$registro->grupoderiesgo}}</p>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <p>{{$registro->zona}}</p>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <p>{{$registro->dosis}}</p>
                                <p class="text-gray-500 text-sm font-semibold tracking-wide">
                                    Marca: {{$registro->marca}} 
                                    Lote: {{$registro->lote}}
                                </p>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($registro->apto=='SI')
                                <a href="#" wire:click.prevent="seleccionar({{$registro->id}})" class="text-purple-800 hover:underline">Elegir este registro</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
        
            </div>
        </div>
        
    </div>
    @endif
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
              
        <div class="mt-5 md:mt-0 md:col-span-2">
            <form action="{{route('registro.store.vacunacion')}}" id="registroform" method="POST">
                @csrf
                <input type="hidden" wire:model="registro_id" name="registro_id">
                <div class="shadow overflow-hidden sm:rounded-md">
                    
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="">
                            <div class="grid grid-cols-8 gap-6">
                                <div class="col-span-8 sm:col-span-4 lg:col-span-2">
                                    
                                    <label for="dni" class="block text-sm font-medium text-gray-700">DNI</label>
                                    <div class="relative">
                                        <input type="text" wire:model="dni" name="dni" placeholder="Buscar por dni en Triaje" required pattern="\d{8}" maxlength="8" title="Solo 8 números"  autocomplete="off" class="w-full {{$input_class}}">
                                    <a href="#" wire:click.prevent="search()" class="underline text-sm text-blue-500 mt-2 absolute right-2 top-0">
                                        <svg aria-hidden="true" class="w-6 h-6" focusable="false" data-prefix="fal" data-icon="search" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-search fa-w-16 fa-3x"><path fill="currentColor" d="M508.5 481.6l-129-129c-2.3-2.3-5.3-3.5-8.5-3.5h-10.3C395 312 416 262.5 416 208 416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c54.5 0 104-21 141.1-55.2V371c0 3.2 1.3 6.2 3.5 8.5l129 129c4.7 4.7 12.3 4.7 17 0l9.9-9.9c4.7-4.7 4.7-12.3 0-17zM208 384c-97.3 0-176-78.7-176-176S110.7 32 208 32s176 78.7 176 176-78.7 176-176 176z" class=""></path></svg>
                                    </a>
                                    </div>
                                    
                                </div>
                                
                                <div class="col-span-8 sm:col-span-4 lg:col-span-2">
                                    <label for="nombre" class="block text-sm font-medium text-gray-700">NOMBRES</label>
                                    <input type="text" wire:model="field_nombre" disabled class="uppercase w-full {{$input_class_c}}">
                                </div>
                                <div class="col-span-8 sm:col-span-4 lg:col-span-2">
                                    <label for="nombre" class="block text-sm font-medium text-gray-700">APELLIDO PATERNO</label>
                                    <input type="text" wire:model="field_apellido_paterno" disabled class="uppercase w-full {{$input_class_c}}">
                                </div>
                                <div class="col-span-8 sm:col-span-4 lg:col-span-2">
                                    <label for="nombre" class="block text-sm font-medium text-gray-700">APELLIDO MATERNO</label>
                                    <input type="text" wire:model="field_apellido_materno" disabled class="uppercase w-full {{$input_class_c}}">
                                </div>
                                <div class="col-span-8 sm:col-span-4 lg:col-span-2">
                                    <label for="nombre" class="block text-sm font-medium text-gray-700">EDAD</label>
                                    <input type="text" wire:model="field_edad" disabled class="uppercase w-full {{$input_class_c}}">
                                </div>
                                <div class="col-span-8 sm:col-span-4 lg:col-span-2">
                                    <label for="nombre" class="block text-sm font-medium text-gray-700">TELEFONO</label>
                                    <input type="text" wire:model="field_telefono" disabled class="uppercase w-full {{$input_class_c}}">
                                </div>
                                <div class="col-span-8 sm:col-span-4 lg:col-span-2">
                                    <label for="nombre" class="block text-sm font-medium text-gray-700">GRUPO DE RIESGO</label>
                                    <input type="text" wire:model="field_grupoderiesgo" disabled class="uppercase w-full {{$input_class_c}}">
                                </div>
                                <div class="col-span-8 sm:col-span-4 lg:col-span-2">
                                    <label for="nombre" class="block text-sm font-medium text-gray-700">LIC VB. CONSENTIMIENTO</label>
                                    <input type="text" wire:model="field_consentimiento" disabled class="uppercase w-full {{$input_class_c}}">
                                </div>
                                <div class="col-span-8 sm:col-span-4 lg:col-span-2">
                                    <label for="nombre" class="block text-sm font-medium text-gray-700">APTO</label>
                                    <input type="text" wire:model="field_apto" disabled class="uppercase w-full {{$input_class_c}}">
                                </div>
                                <div class="col-span-8 sm:col-span-4 lg:col-span-2">
                                    <label for="nombre" class="block text-sm font-medium text-gray-700">OBSERVACIÓN</label>
                                    <input type="text" wire:model="field_observacion" disabled class="uppercase w-full {{$input_class_c}}">
                                </div>

                                <div class="col-span-8 sm:col-span-4 lg:col-span-2">
                                    <label for="last_name" class="block text-sm font-medium text-gray-700">Vacunador(a)</label>
                                    
                                    @if ($licenciados->count()==1)
                                    <select wire:model.defer="licenciado" class="{{$input_class}} w-full">
                                        @foreach ($licenciados as $lic)
                                            <option value="{{$lic->nombre}}" selected>{{$lic->nombre}}</option>
                                        @endforeach
                                    </select>
                                    @else
                                    <select wire:model.defer="licenciado" class="{{$input_class}} w-full">
                                        <option value="">ELEGIR EL VACUNADOR</option>
                                        @if ($licenciados->count()>0)
                                        @foreach ($licenciados as $lic)
                                            <option value="{{$lic->nombre}}">{{$lic->nombre}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    @endif
                                    
                                </div>
                                <div class="col-span-8 sm:col-span-4 lg:col-span-2">
                                    
                                    <label for="modulo" class="block text-sm font-medium text-gray-700">MARCA</label>
                                        
                                    <select wire:model.defer="marca" id="marca" required class="{{$input_class_b}}">
                                        <option value="">Elegir Marca</option>
                                        @if($marcas->count()>0)
                                        @foreach ($marcas as $marca)
                                        
                                        <option value="{{$marca->marca}}">{{$marca->marca}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-span-8 sm:col-span-4 lg:col-span-2">
                                    
                                    <label for="lote" class="block text-sm font-medium text-gray-700">LOTE</label>
                                        
                                    <input type="text" wire:model.defer="lote" class="{{$input_class_b}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($registro_id!=null)
                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6 fields">
                        
                        
                        @if($field_apto=='SI')
                        <button type="button" wire:click.prevent="store()" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{$textbtn}}
                        </button>
                        @endif
                        <button type="button" wire:click.prevent="cancelar()" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            CANCELAR
                        </button>
                        
                    </div> 
                    @endif
                    
                </div>
            </form>
        </div>

    </div>
    <div id="table_data" class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-5">
          @include('snippets.vacunacion')     
    </div>
    <script>
        document.addEventListener('livewire:load', function () {
            // Your JS here.
           
            $('[name="dni"]').on('keyup',function(){
                var length = $('input[name="dni"]').val().length;
                
                
                if(length==8)
                {
                    
                    Livewire.emit('search');
                }
            });
        })
    </script>
</div>
