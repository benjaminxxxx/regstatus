<x-app-layout>
    

    <x-slot name="header">CONSENTIMIENTO</x-slot>

    <div class="p-2 md:p-5 onmain">
        
        <x-card>
            <div class="px-4 py-5 bg-white sm:p-6">
                <form id="sendRequest" class="grid grid-cols-8 gap-6">
                    
                    <div class="col-span-8 sm:col-span-4 lg:col-span-2">
                        <x-label for="documento" value="DNI del paciente" />
                        <div class="relative">
                            <x-input type="text" name="documento"  autocomplete="off" class="w-full"/>
                           
                        </div>
                    </div>
    
                    <div class="col-span-8 sm:col-span-4 lg:col-span-2">
                        <x-label for="fecha" value="FECHA" />
                        <div class="relative">
                            <x-input type="text" name="fecha"  autocomplete="off" class="w-full datepickerm"/>
                            
                        </div>
                    </div>

                    <div class="col-span-8 sm:col-span-4 lg:col-span-2">
                        <br>
                        <div class="relative">
                            <x-button type="submit">
                                Buscar
                            </x-button>
                        </div>
                    </div>
    
                </form>
            </div>
        </x-card>
        <x-panel class="mt-6 relative">
            <x-label>MANTENIMIENTO DE DOCUMENTOS</x-label>
            <form action="{{route('consentimiento.download')}}" method="post">
                @csrf
                <input type="hidden" name="fechaset">
                <div class="my-3 hidden show-controls">
                    <div class="flex">
                        <div class="pr-2">
                            <x-label>
                                Desde
                            </x-label>
                            <x-input type="text" name="desde" class="w-20" value="1"/>
                        </div>
                        <div class="pr-2">
                            <x-label>
                                Hasta
                            </x-label>
                            <x-input type="text" name="limite" class="w-20" value="1000"/>
                        </div>
                        <div class="pr-2">
                            <br>
                            <x-secondary-button type="button" class="mr-4 seleccionar">
                                Seleccionar todo
                            </x-secondary-button>
                        </div>
                        <div>
                            <br>
                            <x-button-green type="button" class="mr-4 restaurar">
                                <svg  class="hidden animation_restaurar animate-spin h-5 w-5 absolute left-3 text-white loading-docs " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                  </svg>
                                Restaurar documentos de fecha
                            </x-button-green>
                            <div class="message_restaurados"></div>
                        </div>
                    </div>
                    
                    

                    <div class="hidden onSelected my-3">
                        
                        <x-danger-button type="button" style="padding-left: 40px !important;padding-right: 40px !important" class="relative eliminar">
                            <svg class="hidden animation_depurar animate-spin h-5 w-5 absolute left-3 text-white loading-docs " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                              </svg>
                            Depurar documentos
                        </x-danger-button>
                        <x-button-pink type="submit" style="padding-left: 40px !important;padding-right: 40px !important" class="relative">
                            <svg  class="hidden animation_descargar animate-spin h-5 w-5 absolute left-3 text-white loading-docs " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                              </svg>
                            Descargar documentos
                        </x-button-pink>
                       
                        <x-button-pink type="button" style="padding-left: 40px !important;padding-right: 40px !important" class="relative changedir">
                            <svg  class="hidden animation_cambiardir animate-spin h-5 w-5 absolute left-3 text-white loading-docs " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                              </svg>
                            Cambiar directorio
                        </x-button-pink>

                    </div>
                </div>
                <div class="total_recuperados"></div>
                <div class="result">
    
                </div>
            </form>
        </x-panel>
        @section('scripts')
        <script>

            var skip = 0;

            function restaurar(){

                var totalRestaurados = 0;

                var fecha = $('[name="fecha"]').val();

                $.ajax({
                    url:"{{route('consentimiento.restaurar')}}",
                    data:{
                        fecha: fecha
                    },
                    method:"get",
                    dataType:'json',
                    beforeSend:function(xhr){
                        $('.animation_restaurar').removeClass('.hidden');
                    },
                    
                    success:function(data){
                        totalRestaurados = parseInt(data.total);
                        recuperarFrom(fecha,totalRestaurados);
                        $('.animation_restaurar').addClass('.hidden');
                    },
                    error:function(errorData){
                        console.log(errorData);
                    }
                });
            }
            function recuperarFrom(fecha,totalRestaurados){
                $('.message_restaurados').html('Restaurando archivos, no cierre la ventana');
                $.ajax({
                    url:"{{route('consentimiento.restaurar')}}",
                    data:{
                        fecha: fecha,
                        skip:skip
                    },
                    method:"get",
                    dataType:'json',
                    beforeSend:function(xhr){
                        $('.animation_restaurar').removeClass('.hidden');
                    },
                    
                    success:function(data){
                        
                        if(totalRestaurados>skip){
                            console.log(data);
                            //$('.total_recuperados').html(JSON.stringify(data.usuarios));
                            skip+=100;
                            recuperarFrom(fecha,totalRestaurados);
                            
                        }else{
                            $('.message_restaurados').html('Restauracion completa');
                        }
                        
                        $('.animation_depurar').addClass('.hidden');
                    },
                    error:function(errorData){
                        console.log(errorData);
                    }
                });
            }
            function eliminar(){

                var registrosseleccionados = [];
                $('.RegistrosSeleccionados:checked').each(function() {
                    registrosseleccionados.push($(this).val());
                });

                var elements = JSON.stringify(registrosseleccionados);
                console.log(elements);

                $.ajax({
                    url:"{{route('consentimiento.delete')}}",
                    data:{
                        registrosseleccionados: elements,
                        _token:"{{ csrf_token() }}"
                    },
                    method:"post",
                    beforeSend:function(xhr){
                        $('.animation_depurar').removeClass('.hidden');
                    },
                    
                    success:function(data){
                        console.log(data);
                        search();
                        $('.animation_depurar').addClass('.hidden');
                    },
                    error:function(errorData){
                        console.log(errorData);
                    }
                });

            }
            function search(){
                var documento = $('[name="documento"]').val();
                var fecha = $('[name="fecha"]').val();

                $('[name="fechaset"]').val($('[name="fecha"]').val());

                $.ajax({
                    url:"{{route('consentimiento.export')}}",
                    method:"get",
                    beforeSend:function(xhr){
                        $('.show-controls').addClass('hidden');
                        $('.result').html('<svg class="animate-spin h-5 w-5 absolute left-3 text-red-700 loading-docs " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"> <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle> <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path> </svg>');
                    },
                    data:{
                        documento:documento,
                        fecha:fecha,
                    },
                    success:function(data){
                        $('.show-controls').removeClass('hidden');
                        $('.result').html(data);
                    },
                    error:function(errorData){
                        console.log(errorData);
                        $('.result').html('Error: Demasiados archivos' + errorData.responseText);
                    }
                });
            }
            function verificarSeleccionados(){
                var counter  = 0;
                
                $('.RegistrosSeleccionados:checked').each(function(index,event){
                    
                    counter++;

                });

                if(counter>0){
                    $('.onSelected').removeClass('hidden');
                }else{
                    $('.onSelected').addClass('hidden');
                }
            }
            jQuery(document).ready(function($){

                $('.restaurar').on('click',function(e){
                    
                    e.preventDefault();

                    restaurar();

                });

                $('.onmain').on('change','.RegistrosSeleccionados',function(e){
                    verificarSeleccionados();
                });

                $('[name="fecha"]').on('keydown',function(){
                    $('[name="fechaset"]').val($(this).val());
                });

                $('.changedir').on('click',function(e){
                    e.preventDefault();

                    var fecha = $('[name="fechaset"]').val();
                    var registrosseleccionados = [];
                    $('.RegistrosSeleccionados:checked').each(function() {
                        registrosseleccionados.push($(this).val());
                    });


                    $.ajax({
                        url:"{{route('consentimiento.cambiardir')}}",
                        method:"post",
                        beforeSend:function(xhr){
                            $('.animation_cambiardir').removeClass('.hidden');
                        },
                        
                        data:{
                            _token:"{{csrf_token()}}",
                            registrosseleccionados:registrosseleccionados,
                            fecha:fecha,
                        },
                        success:function(data){
                            search();
                            $('.animation_cambiardir').addClass('.hidden');
                        },
                        error:function(errorData){
                            console.log(errorData);
                        }
                    });
                });

                $('.seleccionar').on('click',function(e){
                    e.preventDefault();
                    /*if($(this).html()=='Deseleccionar todo'){
                        $('.RegistrosSeleccionados').prop('checked',false);
                        $(this).html('Seleccionar todo');
                    }else{
                        $('.RegistrosSeleccionados').prop('checked',true);
                        $(this).html('Deseleccionar todo');
                    }
                        verificarSeleccionados();
                    */
                    var desde = $('[name="desde"]').val()-1;
                    var limite = $('[name="limite"]').val();

                    if(limite>0){
                        for (let index = desde; index < limite; index++) {
                            
                            if($(this).html()=='Deseleccionar todo'){
                                $('.RegistrosSeleccionados').prop('checked',false);
                            }else{
                                $('.RegistrosSeleccionados').eq(index).prop('checked',true);
                            }
                        }
                        if($(this).html()=='Deseleccionar todo'){
                                $(this).html('Seleccionar todo');
                            }else{
                                $(this).html('Deseleccionar todo');
                            }
                        verificarSeleccionados();
                    }else{
                        if($(this).html()=='Deseleccionar todo'){
                            $('.RegistrosSeleccionados').prop('checked',false);
                            $(this).html('Seleccionar todo');
                        }else{
                            $('.RegistrosSeleccionados').prop('checked',true);
                            $(this).html('Deseleccionar todo');
                        }
                        verificarSeleccionados();
                    }

                    
                });
                /*
                $('.descargarDocumentos').on('click',function(e){
                    
                    e.preventDefault();

                    var registrosseleccionados = [];
                    $('.RegistrosSeleccionados:checked').each(function() {
                        registrosseleccionados.push($(this).val());
                    });

                    var fecha = $('[name="fecha"]').val();

                    $.ajax({
                        url:"{{route('consentimiento.download')}}",
                        method:"get",
                        beforeSend:function(xhr){
                            $('.animation_descargar').removeClass('.hidden');
                        },
                        
                        data:{
                            registrosseleccionados:registrosseleccionados,
                            fecha:fecha,
                        },
                        success:function(data){
                            //search();
                            //$('.animation_descargar').addClass('.hidden');
                        },
                        error:function(errorData){
                            console.log(errorData);
                        }
                    });
                    
                });*/
                /*
                $('.onmain').on('click','.eliminar',function(e){
                    
                    e.preventDefault();

                    var registrosseleccionados = [];
                    $('.RegistrosSeleccionados:checked').each(function() {
                        registrosseleccionados.push($(this).val());
                    });

                    var elements = JSON.stringify(registrosseleccionados);
                    console.log(elements);

                    $.ajax({
                        url:"{{route('consentimiento.delete')}}",
                        data:{
                            registrosseleccionados: elements,
                        },
                        method:"get",
                        beforeSend:function(xhr){
                            $('.animation_depurar').removeClass('.hidden');
                        },
                        
                        success:function(data){
                            search();
                            $('.animation_depurar').addClass('.hidden');
                        },
                        error:function(errorData){
                            console.log(errorData);
                        }
                    });
                    
                });*/
                $('#sendRequest').on('submit',function(e){
                    e.preventDefault();

                    search();
                    
                });
                $('.eliminar').on('click',function(e){
                    e.preventDefault();

                    eliminar();
                    
                });
                $('.datepickerm').datetimepicker({
                    locale: 'es',
                    format: 'YYYY-MM-DD',
                    sideBySide: true,
                }).on('dp.change', function (ev) {
                
                    $('[name="fechaset"]').val($('[name="fecha"]').val());
                    
                });
            });

        </script>
        @endsection
    </div>
    
    
</x-app-layout>