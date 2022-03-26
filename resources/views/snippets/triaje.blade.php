<div class="bg-white overflow-x-auto">
    
    @php
        $input_class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md";
        $th = "px-3 py-2 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider";
        $btn = 'flex items-center px-3 py-2 rounded overflow-hidden shadow text-white';
        $input_label = 'block text-sm font-medium text-gray-700';

        
    @endphp

    <table class="min-w-full divide-y divide-gray-200">
        <thead>
            <tr>
                <th class="{{$th}}">DNI</th>
                <th class="{{$th}}">NOMBRES COMPLETOS</th>
                <th class="{{$th}}">EDAD</th>
                <th class="{{$th}}">TELÉFONO</th>
                <th class="{{$th}}">ZONA DE RIESGO</th>
                <th class="{{$th}}">LIC VB.CONSENTIMIENTO</th>
                <th class="{{$th}}">APTO</th>
                <th class="{{$th}}">OBSERVACIÓN</th>
                <th class="{{$th}}">Acciones</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @if($registros->count()>0)     
            @foreach ($registros as $registro)
            <tr class="">
                
                <td class="px-3 py-2 text-left text-sm leading-5 font-medium">
                    {{$registro->dni}}
                </td>
                <td class="px-3 py-2 text-left text-sm leading-5 font-medium">
                    {{$registro->apellido_paterno . ' ' . $registro->apellido_materno . ', '.$registro->nombre}}
                </td>
                <td class="px-3 py-2 text-left text-sm leading-5 font-medium">
                    {{$registro->edad}}
                </td>
                <td class="px-3 py-2 text-left text-sm leading-5 font-medium">
                    {{$registro->telefono}}
                </td>
                <td class="px-3 py-2 text-left text-sm leading-5 font-medium">
                    {{$registro->grupoderiesgo}}
                </td>
                <td class="px-3 py-2 text-left text-sm leading-5 font-medium">
                    {{$registro->consentimiento}}
                </td>
                <td class="px-3 py-2 text-left text-sm leading-5 font-medium">
                    {{$registro->apto}}
                </td>
                <td class="px-3 py-2 text-left text-sm leading-5 font-medium">
                    {{$registro->observacion}}
                </td>
                <td class="px-3 py-2 text-left text-sm leading-5 font-medium w-40">
                    <div class="flex items-center justify-end">
                       
                        <a href="{{route('dashboard')}}?registro={{$registro->id}}" class="{{$btn}} mr-2  bg-green-600 hover:bg-green-700">
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg> 
                        </a>
                        <button data-id="{{$registro->id}}" class="{{$btn}} mr-2 delete  bg-red-600 hover:bg-red-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                              </svg>
                        </button>
                    </div>
                    
                </td>
            </tr>    
            @endforeach                 
            
            @endif
        </tbody>
    </table>
    <div class="bg-white px-4 py-3 items-center  border-t border-gray-200 sm:px-6">
    
        {{$registros->links()}}
        
    </div>
</div>