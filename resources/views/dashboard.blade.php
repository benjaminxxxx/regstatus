@php
    $input_class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block shadow-sm sm:text-sm border-gray-300 rounded-md";
    $input_class_b = "mt-1 focus:ring-indigo-500 focus:border-indigo-500 inline-block shadow-sm sm:text-sm border-gray-300 rounded-md";
@endphp
<x-app-layout>
    <style>
        .w-dias{
            padding: 0px 8px;
            width: 56px;
            text-align: center;
            margin-right: 6px;
        }
        .w-meses{
            padding: 0px 8px;
            width: 72px;
            text-align: center;
            margin-right: 6px;
        }
    </style>
    <x-slot name="header">Registro de datos</x-slot>

    <div class="p-5">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
              
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <form action="{{route('registro.store')}}" id="registroform" method="POST">
                        @csrf
                        <input type="hidden" name="registro_id" value="{{$registro_id}}">
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-8 gap-6">
                                    
                                    <div class="col-span-8 sm:col-span-4 lg:col-span-2">
                                        <label for="dni" class="block text-sm font-medium text-gray-700">DNI</label>
                                        <input type="text" required pattern="\d{8}" value="{{isset($registro->dni)?$registro->dni:''}}" maxlength="8" title="Solo 8 números"  name="dni" id="dni" autocomplete="off" class="w-full {{$input_class}}">
                                        <div class="message"></div>
                                    </div>

                                    <div class="col-span-8 sm:col-span-4 lg:col-span-2">
                                        <label for="nombre" class="block text-sm font-medium text-gray-700">Nombres</label>
                                        <input type="text" name="nombre" value="{{isset($registro->nombre)?$registro->nombre:''}}" id="nombre" autocomplete="given-name" class="uppercase w-full {{$input_class}}">
                                    </div>
                    
                                    <div class="col-span-8 sm:col-span-4 lg:col-span-2">
                                        <label for="apellido_paterno" class="block text-sm font-medium text-gray-700">Apellido paterno</label>
                                        <input type="text" name="apellido_paterno" value="{{isset($registro->apellido_paterno)?$registro->apellido_paterno:''}}" id="apellido_paterno" class="uppercase w-full {{$input_class}}">
                                    </div>

                                    <div class="col-span-8 sm:col-span-4 lg:col-span-2">
                                        <label for="apellido_materno" class="block text-sm font-medium text-gray-700">Apellido materno</label>
                                        <input type="text" name="apellido_materno" value="{{isset($registro->apellido_materno)?$registro->apellido_materno:''}}" id="apellido_materno" class="uppercase w-full {{$input_class}}">
                                    </div>
                    
                                    <div class="col-span-8 sm:col-span-4 lg:col-span-2">
                                        <label for="email_address" class="block text-sm font-medium text-gray-700">Fecha de nacimiento</label>
                                        <div class="flex">
                                            <select name="day" id="day" class="{{$input_class}} w-dias">
                                                @for ($d=1;$d<=31;$d++)
                                                    <option value="{{substr(str_repeat(0, 2).$d, - 2)}}" {{($old->day==$d)?'selected':''}}>{{substr(str_repeat(0, 2).$d, - 2)}}</option>
                                                @endfor
                                            </select>
                                            <select name="month" id="month" class="{{$input_class}} w-meses">
                                                <option value="01" {{($old->month=='01')?'selected':''}}>Ene</option>
                                                <option value="02" {{($old->month=='02')?'selected':''}}>Feb</option>
                                                <option value="03" {{($old->month=='03')?'selected':''}}>Mar</option>
                                                <option value="04" {{($old->month=='04')?'selected':''}}>Abr</option>
                                                <option value="05" {{($old->month=='05')?'selected':''}}>May</option>
                                                <option value="06" {{($old->month=='06')?'selected':''}}>Jun</option>
                                                <option value="07" {{($old->month=='07')?'selected':''}}>Jul</option>
                                                <option value="08" {{($old->month=='08')?'selected':''}}>Ago</option>
                                                <option value="09" {{($old->month=='09')?'selected':''}}>Sep</option>
                                                <option value="10" {{($old->month=='10')?'selected':''}}>Oct</option>
                                                <option value="11" {{($old->month=='11')?'selected':''}}>Nov</option>
                                                <option value="12" {{($old->month=='12')?'selected':''}}>Dic</option>
                                            </select>
                                            @php
                                                $edad_maxima = date('Y') - 100;
                                                $edad_minima = date('Y') - 17;
                                            @endphp
                                            <select name="year" id="year" class="{{$input_class}}">
                                                @for ($y=(int)$edad_minima;$y>=(int)$edad_maxima;$y--)
                                                    <option value="{{$y}}" {{($old->year==$y)?'selected':''}}>{{$y}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-span-8 sm:col-span-4 lg:col-span-2">
                                        <label for="last_name" class="block text-sm font-medium text-gray-700">Vacunador(a)</label>
                                        
                                            @if ($licenciados->count()>0)
                                            <select name="licenciado" id="licenciado" class="{{$input_class}} w-full">
                                                @foreach ($licenciados as $lic)
                                                    <option value="{{$lic->nombre}}" {{($old->licenciado==$lic->nombre)?'selected':''}}>{{$lic->nombre}}</option>
                                                @endforeach
                                            </select>
                                            @else
                                                <input type="text" name="licenciado" class="{{$input_class}} w-full">
                                            @endif
                                        
                                    </div>
                                    <div class="col-span-8 sm:col-span-4 lg:col-span-2">
                                        <label for="zona" class="block text-sm font-medium text-gray-700">Zona</label>
                                        
                                            @if ($zonas->count()>0)
                                            <select name="zona" id="zona" class="{{$input_class}} w-full">
                                                <option value="">Elegir Zona</option>
                                                @foreach ($zonas as $zona)
                                                    <option value="{{$zona->zona}}" {{($zona->zona==$old->zona)?'selected':''}}>{{$zona->zona}}</option>
                                                @endforeach
                                            </select>
                                            @endif
                                        
                                    </div>
                                    <div class="col-span-8 sm:col-span-4 lg:col-span-2">
                                        
                                        <label for="modulo" class="block text-sm font-medium text-gray-700">Módulo</label>
                                        
                                        <select name="modulo" id="modulo" required class="{{$input_class}} w-full">
                                            <option value="">Elegir Módulo</option>
                                            @if($old->modulos!=null)
                                            @foreach ($old->modulos as $modulo)
                                            
                                            <option value="{{$modulo['modulo']}}" {{($modulo['modulo']==$old->modulo)?'selected':''}}>{{$modulo['modulo']}}</option>
                                            @endforeach
                                            
                                            @endif
                                        </select>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                @if($marcas->count()>0)
                                <select name="marca" id="marca" required class="{{$input_class_b}}">
                                    <option value="">Elegir Marca</option>
                                    
                                    @foreach ($marcas as $marca)
                                    
                                    <option value="{{$marca->marca}}" {{($marca->marca==$old->marca)?'selected':''}}>{{$marca->marca}}</option>
                                    @endforeach
                                    
                                </select>
                                @else
                                    <input type="text" placeholder="Marca" name="marca" value="{{$old->marca}}" class="{{$input_class_b}}">
                                @endif
                                <input type="text" name="lote" placeholder="Lote" value="{{isset($registro->lote)?$registro->lote:''}}" class="{{$input_class_b}}">
                                <input type="number" name="dosis" placeholder="Dosis" value="{{isset($registro->dosis)?$registro->dosis:''}}" class="{{$input_class_b}} w-24">
                                <input type="text" name="fechahora" placeholder="Seleccionar la hora" value="{{isset($registro->fechahora)?$registro->fechahora:''}}" required class="{{$input_class_b}} fechahora">

                                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    {{$textbtn}}
                                </button>
                                @if($registro_id!='')
                                <a href="{{route('dashboard')}}" class="cancelar inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    CANCELAR
                                </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>

            </div>
            <div id="table_data" class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-5">
                
                @include('snippets.registros')
                
            </div>
        </div>
    </div>
    @section('scripts')
    <script>
        function refrescarLista(){
            
            //clearInputs
            $('[name="registro_id"]').val('');

            $('[name="dni"]').val('');
            $('[name="nombre"]').val('');
            $('[name="apellido_paterno"]').val('');
            $('[name="apellido_materno"]').val('');
            $('[name="licenciado"]').val('');
            $('[name="zona"]').val('');
            $('[name="modulo"]').val('');
            $('[name="fechahora"]').val('');
            

            var data = {};

            $.ajax({
                url:"{{route('registro.get')}}",
                method:"get",
                data:data,
                success:function(data){
                    $('#table_data').html(data);
                },
                error: function(errordata){
                    console.log(errordata);
                }
            });
        }
        jQuery(document).ready(function($){

            var buscandopordni = false;

            $('#registroform').on('submit',function(e){
                
                e.preventDefault();

                var data = $(this).serializeArray();
                var form = $(this);
               
                $.ajax({
                    url:"{{route('registro.store')}}",
                    method:"post",
                    dataType:"json",
                    data:data,
                    success:function(data){
                        console.log(data);
                        if(data.success){
                            $('.cancelar').remove();
                            refrescarLista();
                        }
                    },
                    error: function(errordata){
                        console.log(errordata);
                    }
                });
            });

            $('input[name="dni"]').on('keyup',function(e){
                
                var length = $(this).val().length;
                var dni = $(this).val();
                
                if(length==8){
                    if(buscandopordni==false){
                        buscandopordni = true;
                        $.ajax({
                            url:"{{route('registro.buscarpordni')}}/" + dni,
                            method:"get",
                            dataType:"json",
                            beforeSend:function(){
                                //cargando...
                                $('.message').html('<svg class="h-4 w-4 animate-spin" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="spinner" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-spinner fa-w-16 fa-3x"><path fill="currentColor" d="M304 48c0 26.51-21.49 48-48 48s-48-21.49-48-48 21.49-48 48-48 48 21.49 48 48zm-48 368c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.49-48-48-48zm208-208c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.49-48-48-48zM96 256c0-26.51-21.49-48-48-48S0 229.49 0 256s21.49 48 48 48 48-21.49 48-48zm12.922 99.078c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48c0-26.509-21.491-48-48-48zm294.156 0c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48c0-26.509-21.49-48-48-48zM108.922 60.922c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.491-48-48-48z" class=""></path></svg>');
                            },
                            success:function(data){
                                buscandopordni = false;
                                if(data.success){
                                    $('.message').html(data.data.nombre_completo);
                                }
                            },
                            error: function(errordata){
                                console.log(errordata);
                            }
                        });
                    }
                }
                
            });

            $(document).on('click','.delete',function(e){
                
                var id = $(this).data('id');
                var element = $(this);

                $.ajax({
                    url:"{{route('registro.delete')}}/" + id,
                    method:"get",
                    success:function(data){
                        refrescarLista();
                    },
                    error: function(errordata){
                        console.log(errordata);
                    }
                });
                
            });

            $('select[name="zona"]').on('change',function(){
                var zona_id = $(this).val();
                $('select[name="modulo"]').find('option').remove();
                $('select[name="modulo"]').append($('<option>').val('').text('Elegir Módulo'));

                $.ajax({
                    url:"{{route('registro.getmodulos')}}",
                    method:"get",
                    dataType:"json",
                    data:{
                        id:zona_id
                    },
                    success:function(data){
                        console.log(data);
                        if(data.length>0){
                            
                            for (let index = 0; index < data.length; index++) {
                                const modulo = data[index];
                                $('select[name="modulo"]').append($('<option>').val(modulo.modulo).text(modulo.modulo));    
                            }
                        }
                    },
                    error: function(errordata){
                        console.log(errordata);
                    }
                });
            });

            $('.fechahora').datetimepicker({
                locale: 'es',
                format: 'YYYY-MM-DD hh:mm A',
                sideBySide: true,
                //keepOpen:true,
              //debug: true,
            }).on('dp.show', function (ev) {
                //var current_date = dateFormat(new Date(), 'm-d-Y h:i:s');
                
                //var fechastreaming = ev.date.format('YYYY-MM-DD hh:mm A');
                //$('.fechahora').val(fechastreaming);
            }).on('dp.change', function (ev) {
                var fechastreaming = ev.date.format('YYYY-MM-DD hh:mm A');
                $('.fechahora').val(fechastreaming);
            });
        });
    </script>
    @endsection 
</x-app-layout>
