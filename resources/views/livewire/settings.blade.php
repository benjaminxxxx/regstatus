<div>
    @php
        $input_class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block  shadow-sm sm:text-sm border-gray-300 rounded-md";
        $th = "px-3 py-2 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider";
        $btn = 'flex items-center px-3 py-2 rounded overflow-hidden shadow text-white';
        $input_label = 'block text-sm font-medium text-gray-700';
    @endphp
    
    <div class="gap-3 grid grid-cols-1 lg:grid-cols-2">
       
        <div class="mb-5 shadow-lg bg-white px-6 py-3 overflow-hidden rounded-lg col-span-2">
            <div class="flex text-indigo-600">
                <svg version="1.1" class="w-10 h-10" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 548 526" style="enable-background:new 0 0 548 526;" xml:space="preserve"> <style type="text/css"> .st0{fill:#4F46E5;} </style> <g> <g> <path class="st0" d="M393.4,179.4l20.7-20.7v-24L515.7,33.1l-11.3-11.3L402.8,123.4h-24l-20.7,20.7l-32-32l-200,200l-24-24 l-35.3,35.3l48,48l-36.7,36.7l-8-8l-35.3,35.3l67.3,67.3l35.3-35.3l-8-8l36.7-36.7l48,48l35.3-35.3l-24-24l200-200L393.4,179.4z M385.4,139.4h12.7v12.7l-16,16l-12.7-12.7L385.4,139.4z M102.1,480.1l-44.7-44.7l12.7-12.7l44.7,44.7L102.1,480.1z M118.1,448.1 l-28.7-28.7l36.7-36.7l28.7,28.7L118.1,448.1z M226.8,435.4l-12.7,12.7l-36.7-36.7l-51.3-51.3l-36.7-36.7l12.7-12.7l12.7,12.7 l99.3,99.3L226.8,435.4z M214.1,400.1l-76.7-76.7l28.7-28.7l34.3,34.3l11.3-11.3l-34.3-34.3l28.7-28.7l50.3,50.3l11.3-11.3 l-50.3-50.3l28.7-28.7l34.3,34.3l11.3-11.3l-34.3-34.3l28.7-28.7l50.3,50.3l11.3-11.3l-50.3-50.3l28.7-28.7l20.7,20.7l35.3,35.3 l20.7,20.7L214.1,400.1z"/> </g> </g> <g> <g> <path class="st0" d="M509.1,127.1L509.1,127.1l-23-23l-23,23c-12,12-12,31.3,0,43.3c5.7,5.8,13.5,9,21.7,9h2.7 c16.9,0,30.6-13.7,30.6-30.6C518.1,140.7,514.9,132.9,509.1,127.1z M497.8,159.1c-2.7,2.7-6.5,4.3-10.3,4.3h-2.7 c-8.1,0-14.6-6.6-14.6-14.6c0-3.9,1.5-7.6,4.3-10.3l11.7-11.7l11.7,11.7C503.5,144.1,503.5,153.4,497.8,159.1z"/> </g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>
                <p class="text-lg font-bold ml-2">Marcas</p>
            </div>
            <form action="#" wire:submit.prevent="store_marca()" class="flex w-full py-5">
                <div class="mr-2">
                    <label for="marca" required class="{{$input_label}} w-36">Nombre de la marca</label>
                    <input type="text" required wire:model.defer="marca" class="{{$input_class}} ">
                </div>
                <div>
                    <br/>
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Agregar Marca
                    </button>
                </div>
                
            </form>
          
            <div class="py-5">
                @if($marcas->count()>0)
                <div class="overflow-hidden border boder-gray-300 sm:rounded-md">
                    <div class="bg-white overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="{{$th}}">Marca</th>
                                    <th class="{{$th}}">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">   
                                @foreach ($marcas as $marca)
                                <tr class="">
                                    
                                    <td class="px-3 py-2 text-left text-sm leading-5 font-medium sm:break-all">
                                        {{$marca->marca}}
                                    </td>
                                    <td class="px-3 py-2 text-left text-sm leading-5 font-medium w-40">
                                        <div class="flex items-center">
                                            
                                            <button wire:click="eliminar_marca({{$marca->id}})" class="{{$btn}} bg-red-600 hover:bg-red-700" title="Eliminar marca">
                                                Eliminar <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                            </button>
                                        </div>
                                        
                                    </td>
                                </tr>    
                                @endforeach       
                            </tbody>
                        </table>
                    </div>
                </div>
                @else
                <p>Aún sin Marcas</p>
                @endif
            </div>
        </div>
       
    </div>
</div>

