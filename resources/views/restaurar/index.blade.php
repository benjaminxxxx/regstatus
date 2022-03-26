<x-app-layout>
    

    <x-slot name="header">RESTAURACIÓN</x-slot>

    <div class="p-5">
        <div class="max-w-7xl mx-auto">

            <x-panel>
                <h2>Cargar Data</h2>
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Error</strong><br><br>
                        <ul class="list-unstyled list-item">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <form action="{{route('restaurar.cargardata')}}" enctype="multipart/form-data" method="post" class="flex items-center">
                    <input type="file" name="data" id="data" class="p-10">
                    @csrf
                    <x-danger-button type="submit" class="p-10">Extraer Data</x-danger-button>
                </form>
                
            </x-panel>

            <x-panel>
                <h2>Restaurar Data</h2>
                <form action="{{route('restaurar')}}" method="get" class="flex items-center">
                   
                    <x-input type="text" placeholder="dd-mm-aaaa" value="{{$fecha}}" name="fecha" id="fecha"  />
                 
                    <x-button type="submit" name="buscar" class="ml-10">Buscar Data</x-button>
                    @if($puederestaurar)
                    <div class="ml-10">
                        <x-button-green type="submit" name="restaurar"  class="restaurar  flex items-center">
                            <svg  class="hidden animation_restaurar mr-2 animate-spin h-5 w-5 text-white loading-docs " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Restaurar Data
                        </x-button-green>
                        <br/>
                        <div class="message_restaurados font-xs"></div>
                    </div>
                    @endif
                </form>
            </x-panel>
            
            <div class="p5">
                <x-table-responsive class="mt-4">
                    <thead>
                        <tr>
                            <x-th value="N°" class="text-center" />
                            <x-th value="FECHA" class="text-center" />
                            <x-th value="DNI" class="text-center" />
                            <x-th value="Paciente" class="text-left" />
                            <x-th value="Consentimiento" class="text-center"/>
                            <x-th value="Edad" class="text-center"/>
                            <x-th value="Marca" class="text-center"/>
                            <x-th value="Dosis" class="text-center"/>
                            <x-th value="Acciones" class="text-center"/>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">   
                        @if($pacientes!=null)
                            @foreach ($pacientes as $index => $paciente)
                            <tr class="">
                                <x-td class="text-center">
                                    
                                    <p>{{$index + 1}}</p>
                                </x-td>
                                <x-td class="text-center">
                                    
                                    <p>{{$paciente->fecha}}</p>
                                </x-td>
                                <x-td class="text-center">
                                    
                                    <p>{{$paciente->dni}}</p>
                                </x-td>
                                <x-td class="text-left">
                                    
                                    <p>{{$paciente->nombres}}</p>
                                </x-td>
                                @if($paciente->documentos->count()>0)
                                <x-td class="text-center">
                                    @foreach ($paciente->documentos as $docs)
                                    @if(file_exists(public_path('docs/restaurados/'.$docs->documento_nombre_1)))
                                    <a  href="{{asset('docs/restaurados/'.$docs->documento_nombre_1)}}" target="_blank">
                                        <img src="{{asset('/images/pdf.svg')}}" class="w-10 m-auto block" alt="">
                                        Consentimiento
                                    </a>   
                                    @else
                                    <a  href="{{asset('docs/restaurados/'.$docs->documento_nombre_1)}}" target="_blank">
                                        
                                        <svg aria-hidden="true" class="w-8 h-8 m-auto" focusable="false" data-prefix="fal" data-icon="file-pdf" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path fill="currentColor" d="M369.9 97.9L286 14C277 5 264.8-.1 252.1-.1H48C21.5 0 0 21.5 0 48v416c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48V131.9c0-12.7-5.1-25-14.1-34zm-22.6 22.7c2.1 2.1 3.5 4.6 4.2 7.4H256V32.5c2.8.7 5.3 2.1 7.4 4.2l83.9 83.9zM336 480H48c-8.8 0-16-7.2-16-16V48c0-8.8 7.2-16 16-16h176v104c0 13.3 10.7 24 24 24h104v304c0 8.8-7.2 16-16 16zm-22-171.2c-13.5-13.3-55-9.2-73.7-6.7-21.2-12.8-35.2-30.4-45.1-56.6 4.3-18 12-47.2 6.4-64.9-4.4-28.1-39.7-24.7-44.6-6.8-5 18.3-.3 44.4 8.4 77.8-11.9 28.4-29.7 66.9-42.1 88.6-20.8 10.7-54.1 29.3-58.8 52.4-3.5 16.8 22.9 39.4 53.1 6.4 9.1-9.9 19.3-24.8 31.3-45.5 26.7-8.8 56.1-19.8 82-24 21.9 12 47.6 19.9 64.6 19.9 27.7.1 28.9-30.2 18.5-40.6zm-229.2 89c5.9-15.9 28.6-34.4 35.5-40.8-22.1 35.3-35.5 41.5-35.5 40.8zM180 175.5c8.7 0 7.8 37.5 2.1 47.6-5.2-16.3-5-47.6-2.1-47.6zm-28.4 159.3c11.3-19.8 21-43.2 28.8-63.7 9.7 17.7 22.1 31.7 35.1 41.5-24.3 4.7-45.4 15.1-63.9 22.2zm153.4-5.9s-5.8 7-43.5-9.1c41-3 47.7 6.4 43.5 9.1z" class=""></path></svg>
                                        Consentimiento x
                                    </a> 
                                    @endif
                                    @endforeach
                                    
                                </x-td>
                                @else
                                <x-td class="text-center">
                                    -
                                </x-td>
                                
                                @endif
                                <x-td class="text-center">
                                    <p>{{$paciente->edad}}</p>
                                </x-td>
                                <x-td class="text-center">
                                    <p>{{$paciente->marca}}</p>
                                </x-td>
                                <x-td class="text-center">
                                    <p>{{$paciente->dosis}}</p>
                                </x-td>
                               <!-- <x-td  class="text-center w-40">
                                    @if($paciente->documentos->count()>0)
                                    <div class="flex items-center justify-center">
                                        {{-- <x-danger-button type="button" wire:click="autoseleccionar('{{$paciente->id}}')">
                                            Atender
                                        </x-danger-button> --}}
                                        <x-input type="checkbox" value="{{$paciente->id}}" wire:model="RegistrosSeleccionados" />
                                    </div>
                                    @endif
                                </x-td>-->
                            </tr>    
                            @endforeach   
                        @endif
                    </tbody>
                </x-table-responsive>
            </div>
            <div class="p5">
                @if(count($total))
                @foreach ($total as $cadaecha)
                    <div class="rounded h-10 m-3">
                        <div class="inline-flex items-center rounded h-10 m-3 bg-white shadow inline-block p-5">
                            {{$cadaecha->fecha}}  
                            <span class="rounded ml-3 px-2 h-7 text-center bg-red-600 text-white font-bold leading-7">{{ $cadaecha->total }}</span>
                        </div>
                    </div>
                @endforeach
                @endif
            </div>
        </div>
        @section('scripts')
        <script>

            var skip = 0;

            function restaurar(){

                var totalRestaurados = 0;
            
                var fecha = $('[name="fecha"]').val();

                $.ajax({
                    url:"{{route('restaurar.restaurar')}}",
                    data:{
                        fecha: fecha
                    },
                    method:"get",
                    dataType:'json',
                    beforeSend:function(xhr){
                        $('.animation_restaurar').removeClass('hidden');
                    },
                    
                    success:function(data){
                        totalRestaurados = parseInt(data.total);
                        recuperarFrom(fecha,totalRestaurados);
                    },
                    error:function(errorData){
                        console.log(errorData);
                    }
                });
            }
            function recuperarFrom(fecha,totalRestaurados){
                $('.message_restaurados').html('Restaurando archivos, no cierre la ventana (' + skip + '/' + totalRestaurados + ')');
                $.ajax({
                    url:"{{route('restaurar.restaurar')}}",
                    data:{
                        fecha: fecha,
                        skip:skip
                    },
                    method:"get",
                    dataType:'json',
                    beforeSend:function(xhr){
                        $('.animation_restaurar').removeClass('hidden');
                    },
                    
                    success:function(data){
                        
                        if(totalRestaurados>skip){
                            console.log(data);
                            $('.total_recuperados').html(JSON.stringify(data.usuarios));
                            skip+=5;
                            recuperarFrom(fecha,totalRestaurados);
                            
                        }else{
                            $('.message_restaurados').html('Restauracion completa');
                            $('.animation_restaurar').addClass('hidden');
                            skip = 0;
                            totalRestaurados = 0;
                        }
                        
                        
                    },
                    error:function(errorData){
                        console.log(errorData);
                    }
                });
            }
          
            jQuery(document).ready(function($){

                $('.restaurar').on('click',function(e){
                    
                    e.preventDefault();

                    restaurar();

                });


            });

        </script>
        @endsection
    </div>
    
</x-app-layout>