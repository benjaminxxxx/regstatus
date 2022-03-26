<div>
    <x-confirmation-modal wire:model="mostraralta">
        <x-slot name="title">
            Notificación
        </x-slot>
        <x-slot name="content">
            Desea realmente dar de alta al paciente?
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button type="button" wire:click.pevent="$toggle('mostraralta')" wire:loading.attr="disabled">
                NO
            </x-secondary-button>
            <x-button type="button" wire:click.pevent="alta({{$pordardealta}})" wire:loading.attr="disabled">
                DAR DE ALTA
            </x-button>
        </x-slot>
    </x-confirmation-modal>
    <x-panel>
        
            <div class="flex">
                <div class="mr-12">
                    <x-label>Buscar por módulo</x-label>
                    
                    <x-input type="text" autocomplete="off" wire:model="modulo" class="uppercase" />
                </div>
                <div>
                    <br>
                    <x-button type="button" wire:click="render()" autocomplete="off" class="uppercase" >
                        Actualizar
                    </x-button>
                </div>
            </div>
            <div>
                <x-table-responsive class="mt-10" >
                    <thead>
                        <tr>
                            <x-th value="DNI" class="text-center"/>
                            <x-th value="Nombres completos" />
                            <x-th value="Edad" class="text-center"/>
    
                            <x-th value="Vacunador(a)" />
    
                            <x-th value="Admisión" class="text-center" />
                            <x-th value="Vacunatorio" class="text-center"/>
    
                            <x-th value="Fecha de vacunación" class="text-center"/>
                            <x-th value="Acciones" class="text-center"/>
                        </tr>
                    </thead>
                    <tbody>
                        @if($registros->count()>0)
                            @foreach ($registros as $registro)
                                @php
                                    //calcular los minutos pasados de cada registro
                                    $fechahora = $registro->fechahora;
                                    $fecha2= date("Y/m/d H:i:s"); 
    
                                    $minutos = (strtotime($fechahora)-strtotime($fecha2))/60;
                                    //dd($minutos);
                                    $minutos = abs($minutos); 
                                    $minutos = floor($minutos);

                                    
    
                                    $totalsegundos = $tiempo*60; //cantidad general por registro 1200s
                                    $segundostranscurridos = strtotime($fechahora) - strtotime($fecha2);
                                    $segundostranscurridos = abs(strtotime($fechahora) - strtotime($fecha2)); // si pasaron 200s. se deben animar 1000s nada mas
                                    
                                    
                                    $segundosfaltantes = $totalsegundos - $segundostranscurridos; //quedan 1000s
                                    //dd($segundosfaltantes);
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
                                    
                                    <td class="px-3 py-2 text-center text-sm leading-5 font-medium">
                                        {{$registro->documento}}
                                        @if($segundostranscurridos<$totalsegundos)
                                        <style>
    
                                            #percent-{{$registro->id}} svg circle:nth-child(2) {
                                                stroke: #4f46e5;
                                                animation-duration: {{$segundosfaltantes}}s;
                                                animation-name: animreg{{$registro->id}};
                                                animation-timing-function: linear;
                                                animation-fill-mode:forwards;
                                            }
                                            
                                            #percent-{{$registro->id}} h2:before {
                                                content:"{{$minutos}}";
                                                animation-duration: {{$segundosfaltantes}}s;
                                                animation-timing-function: linear;
                                                animation-name: alternumber{{$registro->id}};
                                                animation-fill-mode:forwards;
                                            }
                                            @keyframes animreg{{$registro->id}} {
                                                0% { stroke-dashoffset: {{$totaloffset}};}
                                                100% { stroke-dashoffset: 0;}
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
                                        {{$registro->nombres}}
                                    </td>
                                    
                                    <td class="px-3 py-2 text-center text-sm leading-5 font-medium">
                                        {{$registro->edad}}
                                    </td>
    
    
                                    <td class="px-3 py-2 text-left text-sm leading-5 font-medium">
                                        {{$registro->licenciado}}
                                    </td>
    
                                    <td class="px-3 py-2 text-center text-sm leading-5 font-medium">
                                        {{$registro->modulo_admision}}
                                    </td>
                                    <td class="px-3 py-2 text-center text-sm leading-5 font-medium">
                                        {{$registro->modulo_vacunatorio}}
                                    </td>
    
                                    <td class="px-3 py-2 text-center text-sm leading-5 font-medium">
                                        {{$registro->fechahora}}
                                    </td>
                                    <td class="px-3 py-2 text-center text-sm leading-5 font-medium w-40">
                                        <div class="flex items-center justify-end">
                                            
                                            @php
    
                                            $class_hidden = 'hidden';
    
                                            if ($minutos>=$tiempo) {
                                                $class_hidden='';
                                            }
                                                
                                            @endphp
                                            <x-button-green class="{{$class_hidden}} mr-2" wire:click.prevent="preguntaralta({{$registro->id}})">
                                                
                                                <svg aria-hidden="true" class="w-6 h-6" focusable="false" data-prefix="fal" data-icon="arrow-alt-circle-up" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-arrow-alt-circle-up fa-w-16 fa-3x"><path fill="currentColor" d="M256 504c137 0 248-111 248-248S393 8 256 8 8 119 8 256s111 248 248 248zM40 256c0-118.7 96.1-216 216-216 118.7 0 216 96.1 216 216 0 118.7-96.1 216-216 216-118.7 0-216-96.1-216-216zm88 32h64v104c0 13.2 10.8 24 24 24h80c13.2 0 24-10.8 24-24V288h64c28.4 0 42.8-34.5 22.6-54.6l-128-128c-12.5-12.5-32.8-12.5-45.3 0l-128 128c-20 20.1-5.8 54.6 22.7 54.6zm128-160l128 128h-96v128h-64V256h-96l128-128z" class=""></path></svg>
                                            </x-button-green>
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
                        @else
                        <tr>
                            <td class="p-5">Sin Resultados</td>
                        </tr>
                        @endif
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="100%" class="p-5">
                                {{$registros->links()}}
                            </th>
                        </tr>
                    </tfoot>
                    
    
                </x-table-responsive>
            </div>
            
    </x-panel>
    <x-panel class="mt-6">
        <x-label>Mis altas</x-label>
        <div>
            <x-table-responsive class="mt-4" >
                <thead>
                    <tr>
                        <x-th value="DNI"  class="text-center"/>
                        <x-th value="Nombres completos" />
                        <x-th value="Edad" class="text-center" />

                        <x-th value="Vacunador(a)" />

                        <x-th value="Admisión" class="text-center"/>
                        <x-th value="Vacunatorio" class="text-center" />

                        <x-th value="Fecha de vacunación" class="text-center" />
                        <x-th value="Hora de alta" class="text-center" />
                    </tr>
                </thead>
                <tbody>
                    @if($misregistros->count()>0)
                        @foreach ($misregistros as $registro2)
                            
                            <tr class="">
                                
                                <td class="px-3 py-2 text-center text-sm leading-5 font-medium">
                                    {{$registro2->documento}}
                                  
                                </td>
                                <td class="px-3 py-2 text-left text-sm leading-5 font-medium">
                                    {{$registro2->nombres}}
                                </td>
                                
                                <td class="px-3 py-2 text-center text-sm leading-5 font-medium">
                                    {{$registro2->edad}}
                                </td>


                                <td class="px-3 py-2 text-left text-sm leading-5 font-medium">
                                    {{$registro2->licenciado}}
                                </td>

                                <td class="px-3 py-2 text-center text-sm leading-5 font-medium">
                                    {{$registro2->modulo_admision}}
                                </td>
                                <td class="px-3 py-2 text-center text-sm leading-5 font-medium">
                                    {{$registro2->modulo_vacunatorio}}
                                </td>

                                <td class="px-3 py-2 text-center text-sm leading-5 font-medium">
                                    {{$registro2->fechahora}}
                                </td>
                                <td class="px-3 py-2 text-center text-sm leading-5 font-medium">
                                    {{$registro2->horaalta}}
                                </td>
                            </tr>    
                        @endforeach 
                    @else
                    <tr>
                        <td class="p-5">Sin Resultados aún</td>
                    </tr>
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <th>
                            {{$misregistros->links()}}
                        </th>
                    </tr>
                </tfoot>
                

            </x-table-responsive>
        </div>
    </x-panel>
</div>
