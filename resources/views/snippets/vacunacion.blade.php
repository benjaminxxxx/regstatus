<div class="bg-white overflow-x-auto">
    
    @php
        $input_class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md";
        $th = "px-3 py-2 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider";
        $btn = 'flex items-center px-3 py-2 rounded overflow-hidden shadow text-white w-full mb-2 mr-3';
        $input_label = 'block text-sm font-medium text-gray-700';

        
    @endphp

    <table class="min-w-full divide-y divide-gray-200">
        <thead>
            <tr>
                <th class="{{$th}}">DNI</th>
                <th class="{{$th}}">Nombres</th>
                <th class="{{$th}}">Edad</th>
                <th class="{{$th}}">Vacunador(a)</th>
                <th class="{{$th}}">Marca</th>
                <th class="{{$th}}">Lote</th>
                <th class="{{$th}}">Acciones</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @if($registros_table->count()>0)     
            @foreach ($registros_table as $registro)
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
                    {{$registro->apellido_paterno . ', '.$registro->nombre}}
                </td>
                <td class="px-3 py-2 text-left text-sm leading-5 font-medium">
                    {{$registro->edad}}
                </td>
                <td class="px-3 py-2 text-left text-sm leading-5 font-medium">
                    {{$registro->licenciado}}
                </td>
                <td class="px-3 py-2 text-left text-sm leading-5 font-medium">
                    {{$registro->marca}}
                </td>
                <td class="px-3 py-2 text-left text-sm leading-5 font-medium">
                    {{$registro->lote}}
                </td>
                <td class="px-3 py-2 text-left text-sm leading-5 font-medium w-40">
                    <div class="flex items-center justify-end">
                        <div class="pr-3">
                            <button wire:click.prevent="editar({{$registro->id}})" class="{{$btn}}  bg-green-600 hover:bg-green-700">
                                <svg aria-hidden="true" focusable="false" class="h-6 w-6 mr-2" data-prefix="fal" data-icon="edit" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="svg-inline--fa fa-edit fa-w-18 fa-3x"><path fill="currentColor" d="M417.8 315.5l20-20c3.8-3.8 10.2-1.1 10.2 4.2V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V112c0-26.5 21.5-48 48-48h292.3c5.3 0 8 6.5 4.2 10.2l-20 20c-1.1 1.1-2.7 1.8-4.2 1.8H48c-8.8 0-16 7.2-16 16v352c0 8.8 7.2 16 16 16h352c8.8 0 16-7.2 16-16V319.7c0-1.6.6-3.1 1.8-4.2zm145.9-191.2L251.2 436.8l-99.9 11.1c-13.4 1.5-24.7-9.8-23.2-23.2l11.1-99.9L451.7 12.3c16.4-16.4 43-16.4 59.4 0l52.6 52.6c16.4 16.4 16.4 43 0 59.4zm-93.6 48.4L403.4 106 169.8 339.5l-8.3 75.1 75.1-8.3 233.5-233.6zm71-85.2l-52.6-52.6c-3.8-3.8-10.2-4-14.1 0L426 83.3l66.7 66.7 48.4-48.4c3.9-3.8 3.9-10.2 0-14.1z" class=""></path></svg>
                                Editar 
                            </button>
                            <button wire:click.prevent="devolver({{$registro->id}})" class="{{$btn}}  bg-blue-400 hover:bg-blue-500">
                                <svg aria-hidden="true" focusable="false"  class="h-6 w-6 mr-2" data-prefix="fal" data-icon="undo-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-undo-alt fa-w-16 fa-3x"><path fill="currentColor" d="M256.2 8c-57 0-109.5 19.2-151.5 51.5L54.6 9.4C34.6-10.7 0 3.5 0 32v128c0 17.7 14.3 32 32 32h128c28.5 0 42.7-34.5 22.6-54.6L129 83.7C165.3 56.9 209.5 42 256 42c118.4 0 214 96 214 214 0 118.4-96 214-214 214-53.7 0-104.2-19.8-143.1-54.9-4.7-4.3-12-4-16.5.5l-7.1 7.1c-4.9 4.9-4.6 12.8.5 17.4 44 39.7 102.3 63.9 166.2 63.9 136.8 0 247.7-110.8 248-247.5S392.8 8.1 256.2 8zM160 160H32V32z" class=""></path></svg> 
                                Retornarlo a Triaje
                            </button>
                            <button wire:click.prevent="eliminar({{$registro->id}})" class="{{$btn}} bg-red-600 hover:bg-red-700">
                                <svg aria-hidden="true" class="h-6 w-6 mr-2" focusable="false" data-prefix="fal" data-icon="trash-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-trash-alt fa-w-14 fa-3x"><path fill="currentColor" d="M296 432h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zm-160 0h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zM440 64H336l-33.6-44.8A48 48 0 0 0 264 0h-80a48 48 0 0 0-38.4 19.2L112 64H8a8 8 0 0 0-8 8v16a8 8 0 0 0 8 8h24v368a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V96h24a8 8 0 0 0 8-8V72a8 8 0 0 0-8-8zM171.2 38.4A16.1 16.1 0 0 1 184 32h80a16.1 16.1 0 0 1 12.8 6.4L296 64H152zM384 464a16 16 0 0 1-16 16H80a16 16 0 0 1-16-16V96h320zm-168-32h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8z" class=""></path></svg>
                                Eliminar
                            </button>
                        </div>
                        

                        <div class="percent" id="percent-{{$registro->id}}">
                            <svg>
                              <circle cx="46" cy="46" r="46"></circle>
                              <circle cx="46" cy="46" r="46"></circle>
                            </svg>
                            <div class="number">
                              <h2></h2>
                            </div>
                        </div>
                    </div>
                    
                </td>
            </tr>    
            @endforeach                 
            
            @endif
        </tbody>
    </table>
    <div class="bg-white px-4 py-3 items-center  border-t border-gray-200 sm:px-6">
    
        {{$registros_table->links()}}
        
    </div>
</div>