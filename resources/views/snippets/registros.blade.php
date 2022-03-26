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
                <th class="{{$th}}">Nombres completos</th>
                <th class="{{$th}}">Edad</th>
                <th class="{{$th}}">Vacunador(a)</th>
                <th class="{{$th}}">Zona</th>
                <th class="{{$th}}">Módulo</th>
                <th class="{{$th}}">Acciones</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @if($registros->count()>0)     
            @foreach ($registros as $registro)
            @php
                //calcular los minutos pasados de cada registro
                $fechahora = $registro->fechahora;
                $fecha2= date("Y/m/d H:i:s"); 

                $minutos = (strtotime($fechahora)-strtotime($fecha2))/60;
                $minutos = abs($minutos); 
                $minutos = floor($minutos);

                $totalsegundos = $tiempo*60; //cantidad general por registro 1200s
                $segundostranscurridos = strtotime($fechahora) - strtotime($fecha2);
                $segundostranscurridos = abs(strtotime($fechahora) - strtotime($fecha2)); // si pasaron 200s. se deben animar 1000s nada mas
                
                
                $segundosfaltantes = $totalsegundos - $segundostranscurridos; //quedan 1000s

                $totaloffset = $segundosfaltantes*284/$totalsegundos;
                $steps = 0;
                if($minutos!=$tiempo){
                    $steps = 100/($tiempo-$minutos);
                }
                $current_percent = 0;
                $current_minute = $minutos;
                $strt = '';
                
                for ($i=$minutos; $i < $tiempo; $i++) { 
                    $current_percent+=$steps;
                    $current_minute+=1;
                    $strt.=$current_percent . '% { content: "'.$current_minute.'" }';
                }

            @endphp
            <tr class="">
                
                <td class="px-3 py-2 text-left text-sm leading-5 font-medium sm:break-all">
                    {{$registro->dni}}
                
                    @if($segundostranscurridos<$totalsegundos)
                    <style>

                        #percent-{{$registro->id}} svg circle:nth-child(2) {
                            stroke: #4f46e5;
                            animation-duration: {{$segundosfaltantes}}s;
                            animation-name: animreg{{$registro->id}};
                            animation-timing-function: linear;
                        }
                        
                        #percent-{{$registro->id}} h2:before {
                            content:"{{$minutos}}";
                            animation-duration: {{$segundosfaltantes}}s;
                            animation-timing-function: linear;
                            animation-name: alternumber{{$registro->id}};
                        }
                        @keyframes animreg{{$registro->id}} {
                            0% { stroke-dashoffset: {{$totaloffset}};}
                            100% { stroke-dashoffset: 0; }
                        }
                        @keyframes alternumber{{$registro->id}} {
                            {!!$strt!!}
                        }
                    </style>
                    @else 
                    <style>

                        #percent-{{$registro->id}} h2:before {
                            content:"{{$tiempo}}+";
                        }
                    </style>
                    @endif
                </td>
                <td class="px-3 py-2 text-left text-sm leading-5 font-medium">
                    {{$registro->apellido_paterno . ' ' . $registro->apellido_materno . ', '.$registro->nombre}}
                </td>
                <td class="px-3 py-2 text-left text-sm leading-5 font-medium">
                    {{$registro->edad}}
                </td>
                <td class="px-3 py-2 text-left text-sm leading-5 font-medium">
                    {{$registro->licenciado}}
                </td>
                <td class="px-3 py-2 text-left text-sm leading-5 font-medium">
                    {{$registro->zona}}
                </td>
                <td class="px-3 py-2 text-left text-sm leading-5 font-medium">
                    {{$registro->modulo}}
                </td>
                <td class="px-3 py-2 text-left text-sm leading-5 font-medium w-40">
                    <div class="flex items-center justify-end">
                        @if($registro->estado=='0')
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
                        <div class="percent" id="percent-{{$registro->id}}">
                            <svg>
                              <circle cx="46" cy="46" r="46"></circle>
                              <circle cx="46" cy="46" r="46"></circle>
                            </svg>
                            <div class="number">
                              <h2></h2>
                            </div>
                        </div>
                        @else 
                        <div class="bg-green-200 rounded-full py-2 px-5 font-bold text-sm text-green-700">DE ALTA</div>
                        @endif
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