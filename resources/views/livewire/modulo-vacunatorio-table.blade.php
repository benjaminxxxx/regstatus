<div>
    @php
        $input_class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm";
        $th = "px-3 py-2 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider";
        $btn = 'flex items-center px-3 py-2 rounded overflow-hidden shadow text-white';
        $input_label = 'block text-sm font-medium text-gray-700';
    @endphp
    <div class="mb-5 shadow-lg bg-white px-6 py-3 overflow-hidden rounded-lg col-span-1">

        <div class="flex text-indigo-600 mb-4">
            <svg aria-hidden="true" class="h-10 w-10" focusable="false" data-prefix="fal" data-icon="viruses" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" class="svg-inline--fa fa-viruses fa-w-20 fa-3x"><path fill="currentColor" d="M624,352H611.88c-28.51,0-42.79-34.47-22.63-54.63l8.58-8.57a16,16,0,1,0-22.63-22.63l-8.57,8.58a31.34,31.34,0,0,1-22.4,9.43c-16.45,0-32.23-12.77-32.23-32.06V240a16,16,0,0,0-32,0v12.12c0,19.29-15.78,32.06-32.23,32.06a31.34,31.34,0,0,1-22.4-9.43l-8.57-8.58a16,16,0,0,0-22.63,22.63l8.58,8.57c20.16,20.16,5.88,54.63-22.63,54.63H368a16,16,0,0,0,0,32h12.12c28.51,0,42.79,34.47,22.63,54.63l-8.58,8.57a16,16,0,1,0,22.63,22.63l8.57-8.58a31.34,31.34,0,0,1,22.4-9.43c16.45,0,32.23,12.77,32.23,32.06V496a16,16,0,0,0,32,0V483.88c0-19.29,15.78-32.06,32.23-32.06a31.32,31.32,0,0,1,22.4,9.43l8.57,8.58a16,16,0,1,0,22.63-22.63l-8.58-8.57C569.09,418.47,583.37,384,611.88,384H624a16,16,0,0,0,0-32Zm-71.25,39.51A64.17,64.17,0,0,0,548,419.92c-1.23-.07-2.48-.1-3.73-.1A64.19,64.19,0,0,0,496,441.61a64.19,64.19,0,0,0-48.23-21.79c-1.25,0-2.5,0-3.73.1A64.38,64.38,0,0,0,422.51,368,64.38,64.38,0,0,0,444,316.08c1.23.07,2.48.1,3.73.1A64.19,64.19,0,0,0,496,294.39a64.19,64.19,0,0,0,48.23,21.79c1.25,0,2.5,0,3.73-.1A64.38,64.38,0,0,0,569.49,368,64.11,64.11,0,0,0,552.75,391.51ZM346.51,213.33h16.16a21.33,21.33,0,0,0,0-42.66H346.51c-38,0-57.05-46-30.17-72.84l11.43-11.44A21.33,21.33,0,1,0,297.6,56.23L286.17,67.66a41.78,41.78,0,0,1-29.86,12.58c-21.94,0-43-17-43-42.75V21.33a21.33,21.33,0,0,0-42.66,0V37.49c0,25.72-21,42.75-43,42.75A41.74,41.74,0,0,1,97.83,67.66L86.4,56.23A21.33,21.33,0,0,0,56.23,86.39L67.66,97.83c26.88,26.88,7.85,72.84-30.17,72.84H21.33a21.33,21.33,0,0,0,0,42.66H37.49c38,0,57.05,46,30.17,72.84L56.23,297.6A21.33,21.33,0,1,0,86.4,327.77l11.43-11.43a41.75,41.75,0,0,1,29.86-12.59c21.94,0,43,17,43,42.76v16.16a21.33,21.33,0,0,0,42.66,0V346.51c0-25.72,21-42.76,43-42.76a41.75,41.75,0,0,1,29.86,12.59l11.43,11.43a21.33,21.33,0,0,0,30.17-30.17l-11.43-11.43C289.46,259.29,308.49,213.33,346.51,213.33Zm-69,14.09A74.56,74.56,0,0,0,274,273.9a73.24,73.24,0,0,0-17.66-2.15A75,75,0,0,0,192,308.11a75,75,0,0,0-64.31-36.36A73.24,73.24,0,0,0,110,273.9,74.88,74.88,0,0,0,76,192a74.89,74.89,0,0,0,34-81.9,73.24,73.24,0,0,0,17.66,2.15A75.07,75.07,0,0,0,192,75.89a75.07,75.07,0,0,0,64.31,36.36A73.24,73.24,0,0,0,274,110.1,74.89,74.89,0,0,0,308,192,74.52,74.52,0,0,0,277.52,227.42ZM160,128a32,32,0,1,0,32,32A32,32,0,0,0,160,128Zm64,80a16,16,0,1,0,16,16A16,16,0,0,0,224,208ZM480,336a16,16,0,1,0,16,16A16,16,0,0,0,480,336Z" class=""></path></svg>
            <p class="text-lg font-bold ml-2">MÓDULOS DE VACUNATORIO</p>
        </div>
        <form action="#" wire:submit.prevent="store()">
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 md:col-span-2">
                    <x-label for="establecimiento_id">SEDE</x-label>
                    @if(Auth::user()->establecimiento_id==null)
                    
                    <x-select required wire:model="establecimiento_id" class="w-full">
                        <option value="">TODAS LAS SEDES</option>
                        @if($sedes->count()>0)
                            @foreach ($sedes as $sedev)
                                <option value="{{$sedev->id}}">{{mb_strtoupper($sedev->nombre)}}</option>
                            @endforeach
                        @endif
                    </x-select>
                    @else
                    
                        <p>{{$sede_nombre}}</p>
                    
                    @endif
                </div>
                <div class="col-span-6 sm:col-span-2">
                    <label for="nombre_vacunatorio" required class="{{$input_label}}">NOMBRE DEL MÓDULO</label>
                    <input type="text" required wire:model.defer="nombre_vacunatorio" class="{{$input_class}} uppercase">
                </div>
            </div>
            <div>
                
                <button type="submit" class="inline-flex items-center justify-center mt-4 py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg> 
                    GUARDAR
                </button>
            </div>
            
        </form>
        @if($message!=null)
        <p class="text-red-600 mb-2">{{$message}}</p>
        @endif
        <div class="py-5">
            @if($modulos->count()>0)
            <div class="overflow-hidden border boder-gray-300 sm:rounded-md">
                
                <div class="bg-white overflow-x-auto">
                    
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="{{$th}}">NOMBRE DEL ESTABLECIMIENTO</th>
                                <th class="{{$th}}">NOMBRE DEL MÓDULO</th>
                                <th class="{{$th}}">ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">  
                            @foreach ($modulos as $modulo)
                            <tr class="">
                                <td class="px-3 py-2 text-left text-sm leading-5 font-medium sm:break-all">
                                    @if($modulo->establecimiento!=null)
                                    {{mb_strtoupper($modulo->establecimiento->nombre)}}
                                    @endif
                                </td>
                                <td class="px-3 py-2 text-left text-sm leading-5 font-medium sm:break-all">
                                    {{$modulo->nombre_vacunatorio}}
                                </td>
                                <td class="px-3 py-2 text-left text-sm leading-5 font-medium w-40">
                                    <div class="flex items-center justify-end">
                                        @if ($modulo->estado==true)
                                        <button wire:click.prevent="active({{$modulo->id}},'0')" class="{{$btn}}  bg-green-600 hover:bg-green-700">
                                            <svg aria-hidden="true" class="h-6 w-6 m-auto" focusable="false" data-prefix="fal" data-icon="check-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-check-circle fa-w-16 fa-3x"><path fill="currentColor" d="M256 8C119.033 8 8 119.033 8 256s111.033 248 248 248 248-111.033 248-248S392.967 8 256 8zm0 464c-118.664 0-216-96.055-216-216 0-118.663 96.055-216 216-216 118.664 0 216 96.055 216 216 0 118.663-96.055 216-216 216zm141.63-274.961L217.15 376.071c-4.705 4.667-12.303 4.637-16.97-.068l-85.878-86.572c-4.667-4.705-4.637-12.303.068-16.97l8.52-8.451c4.705-4.667 12.303-4.637 16.97.068l68.976 69.533 163.441-162.13c4.705-4.667 12.303-4.637 16.97.068l8.451 8.52c4.668 4.705 4.637 12.303-.068 16.97z" class=""></path></svg>
                                        </button>
                                        @else
                                        <button wire:click.prevent="active({{$modulo->id}},'1')" class="{{$btn}}  bg-pink-600 hover:bg-pink-700">
                                            <svg aria-hidden="true" class="h-6 w-6 m-auto" focusable="false" data-prefix="fal" data-icon="minus-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-minus-circle fa-w-16 fa-3x"><path fill="currentColor" d="M140 274c-6.6 0-12-5.4-12-12v-12c0-6.6 5.4-12 12-12h232c6.6 0 12 5.4 12 12v12c0 6.6-5.4 12-12 12H140zm364-18c0 137-111 248-248 248S8 393 8 256 119 8 256 8s248 111 248 248zm-32 0c0-119.9-97.3-216-216-216-119.9 0-216 97.3-216 216 0 119.9 97.3 216 216 216 119.9 0 216-97.3 216-216z" class=""></path></svg>
                                        </button>
                                        @endif
                                        <button wire:click="eliminar_modulo({{$modulo->id}})" class="{{$btn}} ml-3 bg-red-600 hover:bg-red-700" title="Eliminar registro">
                                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                        </button>
                                    </div>
                                    
                                </td>
                            </tr>    
                            @endforeach    
                        </tbody>
                    </table>
                    
                    <div class="bg-white px-4 py-3 items-center  border-t border-gray-200 sm:px-6">
                    
                        {{$modulos->links()}}
                        
                    </div>
                </div>
                
            </div>
            @else
            <p>Aún sin módulos</p>
            @endif
        </div>
        
    </div>  
</div>
