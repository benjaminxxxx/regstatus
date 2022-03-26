@php
    $input_class="border-b border-gray-300 border-t-0 border-l-0 border-r-0 focus:shadow-none focus:ring-0 w-full";
    $label_css='block text-sm font-medium text-gray-700';
   
@endphp
<x-app-layout>

    <x-slot name="header">Reporte de registros</x-slot>

    <div class="p-5">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
              
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <form action="{{route('reporte')}}" id="registroform" method="POST">
                        @csrf
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="">
                                    <x-label for="establecimiento_id">Sede</x-label>
                                   
                                    @if(Auth::user()->establecimiento_id==null)
                    
                                    <x-select required name="establecimiento_id" class="w-full">
                                        <option value="">TODAS LAS SEDES</option>
                                        @if($sedes->count()>0)
                                            @foreach ($sedes as $sedev)
                                                <option value="{{$sedev->id}}" {{ $establecimiento_id == $sedev->id ? "selected" : "" }}>{{mb_strtoupper($sedev->nombre)}}</option>
                                            @endforeach
                                        @endif
                                    </x-select>
                                    @else

                                        <input type="hidden" name="establecimiento_id" value="{{$establecimiento_id}}">
                                        <p>{{$sede_nombre}}</p>
                                    
                                    @endif
                                </div>
                                <div class="grid grid-cols-8 gap-10 mt-5">
                                    
                                    <div class="col-span-8 sm:col-span-2 ">
                                        <label for="fecha" class="{{$label_css}}">Fecha</label>
                                        <div class="flex items-center {{$input_class}}">
                                            <input type="text" autocomplete="off" name="fecha" value="{{ $fecha }}" class="focus:ring-0 relative w-full fecha border-none">
                                            <img src="{{asset('images/calendar.svg')}}" class="w-5 h-5 mr-2" alt="">
                                        </div>
                                        
                                    </div>

                                    <div class="col-span-8 sm:col-span-2 ">
                                        <label for="fechahasta" class="{{$label_css}}">Fecha hasta</label>
                                        <div class="flex items-center {{$input_class}}">
                                            <input type="text" autocomplete="off" name="fechahasta" value="{{ $fechahasta }}" class="focus:ring-0 relative w-full fechahasta border-none">
                                            <img src="{{asset('images/calendar.svg')}}" class="w-5 h-5 mr-2" alt="">
                                        </div>
                                        
                                    </div>

                                    <div class="col-span-8 sm:col-span-2">
                                        <label for="riesgo" class="{{$label_css}}">Grupo de Riesgo</label>
                                        <select name="riesgo" id="riesgo" class="{{$input_class}}">
                                            <option value="">Filtrar por riesgo</option>
                                            @if ($riesgos->count()>0)
                                            @foreach ($riesgos as $riesgo)
                                                <option value="{{$riesgo->riesgo}}" {{ $riesgo_request == $riesgo->riesgo ? "selected" : "" }}>{{$riesgo->riesgo}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    <div class="col-span-8 sm:col-span-2 ">
                                        <label for="licenciado" class="{{$label_css}}">Vacunador</label>
                                        <select name="licenciado" id="licenciado" class="{{$input_class}}">
                                            <option value="">Filtrar por vacunador</option>
                                            @if ($licenciados->count()>0)
                                            @foreach ($licenciados as $lic)
                                                <option value="{{$lic->name}}" {{ $licenciado == $lic->name ? "selected" : "" }}>{{$lic->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    <div class="col-span-8 sm:col-span-2 ">
                                        <x-label for="dosis">Dosis</x-label>
                                        <input type="number" name="dosis" value="{{$dosis_request}}" class="{{$input_class}}">
                                    </div>
                                    
                                    
                                    
                    
                    
                                    <div class="col-span-8 sm:col-span-2">
                                        <label for="email_address" class="{{$label_css}}">Estado</label>
                                      
                                        <select name="estado" id="month" class="{{$input_class}}">
                                            <option value="">Filtrar por estado</option>
                                            <option value="ADMISIÓN" {{ $estadol == 'ADMISIÓN' ? "selected" : "" }}>ADMISIÓN</option>
                                            <option value="TRIAJE" {{ $estadol == 'TRIAJE' ? "selected" : "" }}>TRIAJE</option>
                                            <option value="VACUNADO" {{ $estadol == 'VACUNADO' ? "selected" : "" }}>VACUNADO</option>
                                        </select>
                                    </div>

                                    <div class="col-span-8 sm:col-span-4 lg:col-span-2 ">
                                        <div class="flex">
                                            <button type="submit" name="send" value="search" class="inline-flex items-center justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                Buscar 
                                                <svg aria-hidden="true" class="h-6 w-6 ml-2" focusable="false" data-prefix="fal" data-icon="search" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-search fa-w-16 fa-3x"><path fill="currentColor" d="M508.5 481.6l-129-129c-2.3-2.3-5.3-3.5-8.5-3.5h-10.3C395 312 416 262.5 416 208 416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c54.5 0 104-21 141.1-55.2V371c0 3.2 1.3 6.2 3.5 8.5l129 129c4.7 4.7 12.3 4.7 17 0l9.9-9.9c4.7-4.7 4.7-12.3 0-17zM208 384c-97.3 0-176-78.7-176-176S110.7 32 208 32s176 78.7 176 176-78.7 176-176 176z" class=""></path></svg>
                                            </button>

                                            <button type="submit" name="send" value="export" class="inline-flex ml-2 items-center justify-center py-2 px-4 border border-green-600 shadow-sm text-sm font-medium rounded-md text-green-600 bg-white hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-grenn-600">
                                                Exportar 
                                                <img src="{{asset('images/excel.svg')}}" class="w-6 h-6 ml-2" alt="Reportes">
                                            </button>
                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="mt-10 border-gray-300 rounded-lg overflow-hidden">
                                    <div class="bg-white overflow-x-auto border ">
    
                                        @php
                                            $input_class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md";
                                            $th = "px-3 py-2 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider";
                                            $btn = 'flex items-center px-3 py-2 rounded overflow-hidden shadow text-white';
                                            $input_label = '{{$label_css}}';
                                    
                                            
                                        @endphp
                                    
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead>
                                                <tr>

                                                    <x-th value="FECHA" class="text-center" />
                                                    <x-th value="DNI" class="text-center" />
                                                    <x-th value="NOMBRES Y APELLIDOS" class="text-left" />
                                                    <x-th value="GRUPO DE RIESGO" class="text-left" />
                                                    <x-th value="EDAD" class="text-center" />
                                                    <x-th value="DOSIS" class="text-center" />

                                                    <x-th value="MARCA" class="text-center" />
                                                    <x-th value="LOTE" class="text-center" />

                                                    <x-th value="HORA DE REGISTRO" class="text-center" />
                                                    <x-th value="DIGITADOR DE ADMISIÓN" class="text-left" />
                                                    <x-th value="MÓDULO DE ADMISIÓN" class="text-center" />
                                                    <x-th value="HORA DE TRIAJE" class="text-center" />
                                                    <x-th value="ENF. TRIAJE" class="text-left" />
                                                    <x-th value="HORA DE VACUNACIÓN" class="text-center" />
                                                    <x-th value="ENF. VACUNACIÓN" class="text-left" />

                                                    <x-th value="MÓDULO DE VACUNACIÓN" class="text-center" />
                                                    <x-th value="HORA DE SALIDA" class="text-center" />
                                                    <x-th value="LIC. MONITOREO" class="text-left" />
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-200">
                                                @if($registros->count()>0)     
                                                @foreach ($registros as $registro)
                                              
                                                <tr class="">
                                                    @if($registro->fechahora!=null)
                                                    <x-td class="text-center whitespace-nowrap">{{date('d-m-Y',strtotime($registro->fechahora))}}</x-td>
                                                    @else
                                                    <x-td class="text-center whitespace-nowrap">{{date('d-m-Y',strtotime($registro->created_at))}}</x-td>
                                                    @endif
                                                    <x-td class="text-center whitespace-nowrap">{{$registro->documento}}</x-td>
                                                    <x-td class="text-left">{{$registro->nombres}}</x-td>
                                                    <x-td class="text-left whitespace-nowrap">{{substr($registro->grupoderiesgo,0,8)}}...</x-td>
                                                    <x-td class="text-center">{{$registro->edad}}</x-td>
                                                    <x-td class="text-center">{{$registro->dosis}}</x-td>

                                                    <x-td class="text-center whitespace-nowrap">{{$registro->marca}}</x-td>
                                                    <x-td class="text-center whitespace-nowrap">{{$registro->lote}}</x-td>

                                                    <x-td class="text-center whitespace-nowrap">{{$registro->horaregistro}}</x-td>
                                                    <x-td class="text-left">{{$registro->admision_nombre}}</x-td>
                                                    <x-td class="text-center">{{$registro->modulo_admision}}</x-td>
                                                    <x-td class="text-center whitespace-nowrap">{{$registro->horatriaje}}</x-td>
                                                    <x-td class="text-left">{{$registro->triaje}}</x-td>
                                                    @if($registro->fechahora!=null && $registro->fechahora!='')
                                                    <x-td class="text-center">{{date('g:i A',strtotime($registro->fechahora))}}</x-td>
                                                    @else
                                                    <x-td class="text-center">-</x-td>
                                                    @endif
                                                    <x-td class="text-left">{{$registro->licenciado}}</x-td>

                                                    <x-td class="text-center">{{$registro->modulo_vacunatorio}}</x-td>
                                                    <x-td class="text-center">{{$registro->horaalta}}</x-td>
                                                    <x-td class="text-left">{{$registro->lector}}</x-td>
                  
                                                    
                                                </tr>    
                                                @endforeach                 
                                                
                                                @endif
                                            </tbody>
                                        </table>
                                        <div class="bg-white px-4 py-3 items-center  border-t border-gray-200 sm:px-6">
                                        
                                            {{$registros->links()}}
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    @section('scripts')
    <script>
       
        jQuery(document).ready(function($){

            


            $('.fecha').datetimepicker({
                locale: 'es',
                format: 'YYYY-MM-DD',
                sideBySide: true,
            });/*.on('dp.change', function (ev) {
                var fechastreaming = ev.date.format('YYYY-MM-DD');
                $('.fecha').val(fechastreaming);
            });*/

            $('.fechahasta').datetimepicker({
                useCurrent: false, //Important! See issue #1075
                locale: 'es',
                format: 'YYYY-MM-DD',
                sideBySide: true,
            });

            $(".fecha").on("dp.change", function (e) {
                $('.fechahasta').data("DateTimePicker").minDate(e.date);
            });
            $(".fechahasta").on("dp.change", function (e) {
                $('.fecha').data("DateTimePicker").maxDate(e.date);
            });
        });
    </script>
    @endsection 
</x-app-layout>
