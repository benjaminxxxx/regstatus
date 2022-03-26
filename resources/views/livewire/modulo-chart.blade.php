<div class="p-2 md:p-5">
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        <div class="col-span-1 md:col-span-3">
            <x-panel>
                <form wire:submit.prevent="filtrar" action="#" class="mt-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                    
                    @if(Auth::user()->establecimiento_id==null)
                    <div class="col-span-1">
                        <x-label for="sede">Sede</x-label>
                        <x-select class="w-full uppercase" wire:model="establecimiento_id">
                            <option value="">Todos</option>
                            @if($sedes->count()>0)
                            @foreach ($sedes as $sede)
                                <option value="{{$sede->id}}">{{$sede->nombre}}</option>
                            @endforeach
                            @endif
                        </x-select>
                    </div>
                    @else
                    <div class="col-span-1">
                        <x-label for="sede">Sede</x-label>
                        <p>{{mb_strtoupper($sede_nombre)}}</p>
                    </div>
                    @endif
                    @if(Auth::user()->type!='digitador')
                    <div class="col-span-1">
                        <x-label>Módulo</x-label>
                        <x-input type="text" class="w-full uppercase" wire:model="modulo" />
                    </div>
                    @endif
                    <div class="col-span-1">
                        <x-label>Fecha</x-label>
                        <x-input type="text" class="w-full datepickerm" wire:model="fechahora" />
                    </div>
                    @if(Auth::user()->type=='digitador')
                    <div class="col-span-1">
                        <br>
                        <button type="button" wire:click="exportar" class="inline-flex ml-2 items-center justify-center py-2 px-4 border border-green-600 shadow-sm text-sm font-medium rounded-md text-green-600 bg-white hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-grenn-600">
                            Exportar 
                            <img src="{{asset('images/excel.svg')}}" class="w-6 h-6 ml-2" alt="Reportes">
                        </button>
                    </div>
                    @endif
                    @if(Auth::user()->type!='digitador')
                    <div class="col-span-1">
                        <x-label>Licenciado(a)</x-label>
                        <x-select class="w-full uppercase" wire:model="licenciado">
                            <option value="">Todos</option>
                            @if($licenciados->count()>0)
                            @foreach ($licenciados as $licenciado)
                                <option value="{{$licenciado->name}}">{{$licenciado->name}}</option>
                            @endforeach
                            @endif
                        </x-select>
                    </div>
                    @endif
                    <div class="col-span-1 md:col-span-3">
                        
                        
                            <div class="rounded-full bg-yellow-300 mr-5 inline-block py-2 px-3 border-0 mt-3">Total dosis: {{$total_dosis}}</div>
                        
                            <div class="rounded-full bg-yellow-300 mr-5 inline-block py-2 px-3 border-0 mt-3">Total 1° dosis: {{$total_dosis_1}}</div>
                        
                            <div class="rounded-full bg-yellow-300 mr-5 inline-block py-2 px-3 border-0 mt-3">Total 2° dosis: {{$total_dosis_2}}</div>
                        
                    </div>
                    
                </form>
            </x-panel>
        </div>
        <div class="col-span-1">
            <x-panel>
                <x-label>Vacunas por edades</x-label>
                @if(is_array($vacunasPorEdades))
                @if(count($vacunasPorEdades)>0)
                @foreach ($vacunasPorEdades as $vacunasPorEdad)
                    <div class="block md:flex mt-3">
                        <div class="w-24">
                            <img src="{{asset('firmas/grupoderiesgo/' . $vacunasPorEdad['logo'])}}" alt="">
                        </div>
                        <x-table-responsive class="w-full">
                            <thead>
                                <tr>
                                    <x-th colspan="2" class="text-center" value="{{$vacunasPorEdad['riesgo']}}" />
                                </tr>
                                <tr>
                                    <x-th class="text-center" value="1 DOSIS" />
                                    <x-th class="text-center" value="2 DOSIS" />
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <x-td class="text-center">{{$vacunasPorEdad['dosis_1']}}</x-td>
                                    <x-td class="text-center">{{$vacunasPorEdad['dosis_2']}}</x-td>
                                </tr>
                            </tbody>
                        </x-table-responsive>
                    </div>
                @endforeach
                @endif
                @endif
            </x-panel>
        </div>
        <div class="col-span-1 md:col-span-2">
            <x-panel>
                <x-label>Vacunas por grupo de riesgo</x-label>
                @if(is_array($vacunasPorRiesgos))
                @if(count($vacunasPorRiesgos)>0)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    @foreach ($vacunasPorRiesgos as $vacunaPorRiesgo)
                        <div class="col-span-1 mt-5">
                            <div class="flex">
                               <div class="w-24">
                                <img src="{{asset('firmas/grupoderiesgo/' . $vacunaPorRiesgo['logo'])}}" alt="">
                                </div>
                                <x-table-responsive class="w-full">
                                    <thead>
                                        <tr>
                                            <x-th colspan="2" class="text-center" value="{{$vacunaPorRiesgo['riesgo']}}" />
                                        </tr>
                                        <tr>
                                            <x-th class="text-center" value="1 DOSIS" />
                                            <x-th class="text-center" value="2 DOSIS" />
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <x-td class="text-center">{{$vacunaPorRiesgo['dosis_1']}}</x-td>
                                            <x-td class="text-center">{{$vacunaPorRiesgo['dosis_2']}}</x-td>
                                        </tr>
                                    </tbody>
                                </x-table-responsive> 
                            </div>
                            
                        </div>
                    @endforeach
                </div>
                @endif
                @endif
            </x-panel>
        </div>
    </div>
    <script>

        document.addEventListener('livewire:load', function () {
                jQuery(document).ready(function($){



                    $('.datepickerm').datetimepicker({
                        locale: 'es',
                        format: 'YYYY-MM-DD',
                        sideBySide: true,
                    }).on('dp.change', function (ev) {
                       
                        var fechastreaming = ev.date.format('YYYY-MM-DD');
                        
                        @this.set('fechahora', fechastreaming);
                    });
                });
            
        });
    </script>
</div>
