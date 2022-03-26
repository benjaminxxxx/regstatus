<div>
    <style>
        .error{
            font-size: 12px;
            color: red;
        }
    </style>
    @php
        $select_class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm";
        $input_class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md";
        $th = "px-3 py-2 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider";
        $btn = 'flex items-center px-3 py-2 rounded overflow-hidden shadow text-white w-full text-center mr-3';
        $input_label = 'block text-sm font-medium text-gray-700';

    @endphp
    
    @if($selectGerencia)

    @endif
    <form wire:submit.prevent="store">
        <div class="shadow sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div class="col-span-1">
                        <label for="rede_id" class="block text-sm font-medium text-gray-700">RED / GERENCIA</label>
                        <input type="text" wire:click="openred()" autocomplete="off" id="outred" wire:model.defer="rede_id" class="{{$input_class}}">
                        <div class="list relative">
                         
                            @if($optionsopened==true)
                            <ul class="absolute bg-white z-50  shadow-lg right-0">
                                @foreach ($establecimientos as $reg)
                                <li class="font-medium text-gray-700 flex items-center hover:bg-gray-200 pointer">
                                    <a href="#sel-this" wire:click.prevent="set_red_id('{{$reg->redgerencia}}')" class="block py-2 px-6 underline ">{{$reg->redgerencia}}</a> 
                                    @if($reg->establecimientos->count()==0)
                                    <a href="#eliminar" wire:click.prevent="eliminarreg({{$reg->id}})" class="error py-2 px-6 hover:bg-red-600 hover:text-white">Eliminar</a>
                                    @endif
                                </li>
                                @endforeach
                            </ul>
                            @endif
                        </div>
                        @error('rede_id') <span class="error">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-span-1">
                        <label for="nombre" class="block text-sm font-medium text-gray-700">ESTABLECIMIENTO DE SALUD</label>
                        <input type="text" wire:model.defer="nombre" class="{{$input_class}}">
                        @error('nombre') <span class="error">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-span-1">
                        <label for="tiempoespera" class="block text-sm font-medium text-gray-700">TIEMPO DE MONITOREO</label>
                        <input type="text" wire:model.defer="tiempoespera" class="{{$input_class}}">
                        @error('tiempoespera') <span class="error">{{ $message }}</span> @enderror
                    </div>

                </div>
            </div>
            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                GUARDAR CAMBIOS
                </button>
            </div>
        </div>
    </form>
    <div class="shadow overflow-hidden sm:rounded-md mt-5">
        <div class="px-4 py-5 bg-white sm:p-6">
            <div class="bg-white overflow-x-auto border">
            
            
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="{{$th}}">RED / GERENCIA</th>
                            <th class="{{$th}}">ESTABLECIMIENTO DE SALUD</th>
                            <th class="{{$th}}">TIEMPO DE MONITOREO</th>
                            <th class="{{$th}}">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @if($establecimientos->count()>0)     
                    
                        @foreach ($establecimientos as $sedes)
                            @php
                                $red = $sedes->redgerencia;
                                $establecimiento = $sedes->establecimientos;
                                
                            @endphp
                            @if($establecimiento->count()>0)
                                @foreach ($establecimiento as $sede)
                                <tr class="">
                                
                                    <td class="px-3 py-2 text-left text-sm leading-5 font-medium sm:break-all">
                                        {{$red}}
                                    
                                    </td>
                                    <td class="px-3 py-2 text-left text-sm leading-5 font-medium sm:break-all">
                                        {{$sede->nombre}}
                                    
                                    </td>
                                    <td class="px-3 py-2 text-left text-sm leading-5 font-medium">
                                        {{$sede->tiempoespera}}
                                    </td>
                                    
                                    <td class="px-3 py-2 text-left text-sm leading-5 font-medium w-40">
                                        <div class="flex items-center justify-end">
                                                @if ($sede->estado=="1")
                                                <button wire:click.prevent="active({{$sede->id}},'0')" class="{{$btn}}  bg-green-600 hover:bg-green-700">
                                                    <svg aria-hidden="true" class="h-6 w-6 m-auto" focusable="false" data-prefix="fal" data-icon="check-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-check-circle fa-w-16 fa-3x"><path fill="currentColor" d="M256 8C119.033 8 8 119.033 8 256s111.033 248 248 248 248-111.033 248-248S392.967 8 256 8zm0 464c-118.664 0-216-96.055-216-216 0-118.663 96.055-216 216-216 118.664 0 216 96.055 216 216 0 118.663-96.055 216-216 216zm141.63-274.961L217.15 376.071c-4.705 4.667-12.303 4.637-16.97-.068l-85.878-86.572c-4.667-4.705-4.637-12.303.068-16.97l8.52-8.451c4.705-4.667 12.303-4.637 16.97.068l68.976 69.533 163.441-162.13c4.705-4.667 12.303-4.637 16.97.068l8.451 8.52c4.668 4.705 4.637 12.303-.068 16.97z" class=""></path></svg>
                                                </button>
                                                @else
                                                <button wire:click.prevent="active({{$sede->id}},'1')" class="{{$btn}}  bg-pink-600 hover:bg-pink-700">
                                                    <svg aria-hidden="true" class="h-6 w-6 m-auto" focusable="false" data-prefix="fal" data-icon="minus-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-minus-circle fa-w-16 fa-3x"><path fill="currentColor" d="M140 274c-6.6 0-12-5.4-12-12v-12c0-6.6 5.4-12 12-12h232c6.6 0 12 5.4 12 12v12c0 6.6-5.4 12-12 12H140zm364-18c0 137-111 248-248 248S8 393 8 256 119 8 256 8s248 111 248 248zm-32 0c0-119.9-97.3-216-216-216-119.9 0-216 97.3-216 216 0 119.9 97.3 216 216 216 119.9 0 216-97.3 216-216z" class=""></path></svg>
                                                </button>
                                                @endif
                                                <button wire:click.prevent="editar({{$sede->id}})" class="{{$btn}}  bg-blue-600 hover:bg-blue-700">
                                                    <svg aria-hidden="true" focusable="false" class="h-6 w-6 m-auto" data-prefix="fal" data-icon="edit" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="svg-inline--fa fa-edit fa-w-18 fa-3x"><path fill="currentColor" d="M417.8 315.5l20-20c3.8-3.8 10.2-1.1 10.2 4.2V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V112c0-26.5 21.5-48 48-48h292.3c5.3 0 8 6.5 4.2 10.2l-20 20c-1.1 1.1-2.7 1.8-4.2 1.8H48c-8.8 0-16 7.2-16 16v352c0 8.8 7.2 16 16 16h352c8.8 0 16-7.2 16-16V319.7c0-1.6.6-3.1 1.8-4.2zm145.9-191.2L251.2 436.8l-99.9 11.1c-13.4 1.5-24.7-9.8-23.2-23.2l11.1-99.9L451.7 12.3c16.4-16.4 43-16.4 59.4 0l52.6 52.6c16.4 16.4 16.4 43 0 59.4zm-93.6 48.4L403.4 106 169.8 339.5l-8.3 75.1 75.1-8.3 233.5-233.6zm71-85.2l-52.6-52.6c-3.8-3.8-10.2-4-14.1 0L426 83.3l66.7 66.7 48.4-48.4c3.9-3.8 3.9-10.2 0-14.1z" class=""></path></svg>
                                                </button>
                                                <button wire:click.prevent="eliminar({{$sede->id}})" class="{{$btn}} bg-red-600 hover:bg-red-700">
                                                    <svg aria-hidden="true" class="h-6 w-6 m-auto" focusable="false" data-prefix="fal" data-icon="trash-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-trash-alt fa-w-14 fa-3x"><path fill="currentColor" d="M296 432h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zm-160 0h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zM440 64H336l-33.6-44.8A48 48 0 0 0 264 0h-80a48 48 0 0 0-38.4 19.2L112 64H8a8 8 0 0 0-8 8v16a8 8 0 0 0 8 8h24v368a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V96h24a8 8 0 0 0 8-8V72a8 8 0 0 0-8-8zM171.2 38.4A16.1 16.1 0 0 1 184 32h80a16.1 16.1 0 0 1 12.8 6.4L296 64H152zM384 464a16 16 0 0 1-16 16H80a16 16 0 0 1-16-16V96h320zm-168-32h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8z" class=""></path></svg>
                                                </button>
                                            
                                        </div>
                                        
                                    </td>
                                </tr> 
                                @endforeach
                            @endif
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('livewire:load', function () {
            /*
            $(document).on('click','#outred',function(){
                $('.list').removeClass('hidden');
            });
            $(document).on('focusout','#outred',function(){
                $('.list').addClass('hidden');
            });
            $(document).on('click','[href="#sel-this"]',function(e){
                e.preventDefault();
                var val = $(this).text();
                $('#outred').val(val);
                $('.list').addClass('hidden');
            });*/
        })
    </script>
</div>
