<?php 
use App\Models\Valore;

$type = [
    'administrador'=>'Administrador',
    'digitador'=>'Digitador',
    'lector'=>'Lector'
]; 

$paginaname = Valore::find(2)->valor;

?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $paginaname  }}</title>
        <link rel="icon" type="image/svg+xml" href="{{asset('images/favicon.svg')}}">

        <!-- Fonts -->
        <link rel="stylesheet" href="{{asset('css/Nunito.css')}}">
        <link rel="stylesheet" href="{{asset('css/custom.css')}}">
        <link rel="stylesheet" href="{{asset('css/progress/progress.css')}}">
        <link rel="stylesheet" href="{{asset('css/all.min.css') }}">
        <link rel="stylesheet" href="{{asset('css/bootstrap-datetimepicker.css')}}">
        

        <!-- Styles -->
        <style>
            .bg-dark-2{
                background: #262626;
            }
            .bg-darker{
                background: #1D1D1D;
            }
            .w-dias{
                padding: 0px 8px;
                width: 56px;
                text-align: center;
                margin-right: 6px;
            }
            .w-meses{
                padding: 0px 8px;
                width: 62px;
                text-align: center;
                margin-right: 6px;
            }
        </style>
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">


        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
        

    </head>
    <body class="font-sans antialiased">
        
        <div>
            
            <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200">
                <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed z-20 inset-0 bg-black opacity-50 transition-opacity lg:hidden"></div>
            
                <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" class="fixed z-30 inset-y-0 left-0 w-60 transition duration-300 transform bg-dark-2 overflow-y-auto lg:translate-x-0 lg:static lg:inset-0">
                    @include('snippets.menu')
                </div>
                <div class="flex-1 flex flex-col overflow-hidden">
                    
                    <header class="flex justify-between items-center py-4 px-6 bg-white border-b-4 border-indigo-600">
                        <div class="flex items-center">
                            <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
                                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </svg>
                            </button>
            
                            {{ $header }}

                            
                        </div>
                        @livewire('navigation-menu')
                    </header>
                    
                    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200 relative">
                        {{ $slot }}
                    </main>
                </div>
            </div>
        </div>

        @stack('modals')

        @livewireScripts
        <script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
        <script src="{{asset('js/moment-with-locales.js')}}"></script>
        <script src="{{asset('js/bootstrap-datetimepicker.js')}}"></script>
        <script src="{{asset('js/dateFormat.min.js')}}"></script>
        
        <script src="{{asset('src/jSignature.js')}}"></script>
        <script src="{{asset('src/plugins/jSignature.UndoButton.js')}}"></script> 

        <script>
            
        </script>

        @yield('scripts')
    </body>
    
</html>
