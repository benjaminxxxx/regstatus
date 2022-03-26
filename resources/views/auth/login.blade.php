<x-guest-layout>
    @php
        $color = ' text-gray-500 ';

        $establecimientos = App\Models\Establecimiento::with('rede')->get();
        
    @endphp

    <style>
        h2{
            font-family: "GothanRunded";
            color: #479c8f;
            font-size: 1.6rem;
        }
        h3{
            font-family: "GothanRundedLight";
            color: #8e8e8e;
            font-size: 1.2rem;
            
        }
        .bg-login{
            background: url('{{ asset('images/bg-login.svg') }}') no-repeat;
            background-size: cover;
            background-position: 0 center;
        }
        input{
            font-size: 12px !important;
        }
        input:-webkit-autofill,
        input:-webkit-autofill:hover, 
        input:-webkit-autofill:focus {
            -webkit-box-shadow: 0 0 0px 1000px #fff inset;
            font-size: 12px !important;
        }
        input:-webkit-autofill {
            -webkit-text-fill-color: rgb(63, 63, 63);
            font-size: 12px !important;
        }
        button{
            background: #5bb6a8;
            
        }
        button:focus,button:hover{
            background: #388579;
            
        }
        .sub{
            font-size: 13px;
            font-weight: 400;
            color: #848484;
            margin-top: 34px;
        }
        .bg-blue{
            color:#5bb6a8
        }
    </style>
    <div class="flex justify-center items-center h-screen p-5 overflow-x-auto" style="background: #6DB3A9">
        <div class="bg-white shadow-lg w-full max-w-screen-lg m-auto rounded overflow-hidden">
            <div class="md:flex">
                <div class="flex-1 flex flex-col overflow-hidden text-center p-10" style="background: #F3F6FB">
                    <!--<div class="flex justify-between items-center mb-5">
                        <img src="{{asset('images/juntos.svg')}}" class="w-20 md:w-28" alt="">
                        <img src="{{asset('images/essalud.svg')}}" class="w-20 md:w-28" alt="">
                        <img src="{{asset('images/pongoelhombro.svg')}}" class="w-20 md:w-32" alt="">
                    </div>-->
                    <img src="{{asset('images/covid.png')}}" class="hidden md:inline-block w-auto m-auto" alt="" style="width:300px">
                    <h3>
                        Vacunatorio
                    </h3>
                    <h2>
                        SAN ISIDRO LABRADOR - SANTA ANITA
                    </h2>
                </div>
                <div class="bg-white w-80 m-auto lg:w-96 py-6 md:py-20 px-5 md:px-10 relative">
                    <div class="md:absolute inset-0">
                        <div class="flex items-center h-full">
                            <div class="w-full">
                                
        
                                <h1 class="text-center text-3xl mb-8 font-thin {{$color}}">Bienvenido!</h1>
        
                                <form method="POST" action="{{ route('login') }}" style="max-width: 222px;" class="m-auto">
                                    @csrf
                                    <x-jet-validation-errors class="mb-4" />
        
                                    @if (session('status'))
                                        <div class="mb-4 font-medium text-sm text-green-600">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    <!--<div class="relative">
        
                                        
                                        <svg aria-hidden="true" class="absolute w-5 h-5 {{$color}}" style="margin-top: 8px;" focusable="false" data-prefix="fal" data-icon="hospital" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-hospital fa-w-14 fa-3x"><path fill="currentColor" d="M180 352h-40c-6.627 0-12-5.373-12-12v-40c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40c0 6.627-5.373 12-12 12zm88 0h40c6.627 0 12-5.373 12-12v-40c0-6.627-5.373-12-12-12h-40c-6.627 0-12 5.373-12 12v40c0 6.627 5.373 12 12 12zm-128-96h40c6.627 0 12-5.373 12-12v-40c0-6.627-5.373-12-12-12h-40c-6.627 0-12 5.373-12 12v40c0 6.627 5.373 12 12 12zm128 0h40c6.627 0 12-5.373 12-12v-40c0-6.627-5.373-12-12-12h-40c-6.627 0-12 5.373-12 12v40c0 6.627 5.373 12 12 12zm180 256H0v-20c0-6.627 5.373-12 12-12h20V85c0-11.598 10.745-21 24-21h88V24c0-13.255 10.745-24 24-24h112c13.255 0 24 10.745 24 24v40h88c13.255 0 24 9.402 24 21v395h20c6.627 0 12 5.373 12 12v20zM64 480h128v-84c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v84h128V96h-80v40c0 13.255-10.745 24-24 24H168c-13.255 0-24-10.745-24-24V96H64v384zM266 64h-26V38a6 6 0 0 0-6-6h-20a6 6 0 0 0-6 6v26h-26a6 6 0 0 0-6 6v20a6 6 0 0 0 6 6h26v26a6 6 0 0 0 6 6h20a6 6 0 0 0 6-6V96h26a6 6 0 0 0 6-6V70a6 6 0 0 0-6-6z" class=""></path></svg>

                                        <select name="establecimiento_id" id="establecimiento_id" class="text-sm w-full border-gray-400 focus:border-gray-400 border-0 border-b px-3 pl-10 focus:outline-none focus:ring-0" required>
                                            @if($establecimientos->count()>0)
                                            @foreach ($establecimientos as $establecimiento)
                                                <option value="{{$establecimiento->id}}">{{$establecimiento->rede->redgerencia . ' - ' .$establecimiento->nombre}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>-->
                                    <div class="relative mt-5">
        
                                        <svg aria-hidden="true" class="absolute w-5 h-5 {{$color}}" style="margin-top: 8px;" focusable="false" data-prefix="fal" data-icon="address-card" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="svg-inline--fa fa-address-card fa-w-18 fa-3x"><path fill="currentColor" d="M512 32H64C28.7 32 0 60.7 0 96v320c0 35.3 28.7 64 64 64h448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64zm32 384c0 17.6-14.4 32-32 32H64c-17.6 0-32-14.4-32-32V96c0-17.6 14.4-32 32-32h448c17.6 0 32 14.4 32 32v320zm-72-128H360c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8h112c4.4 0 8-3.6 8-8v-16c0-4.4-3.6-8-8-8zm0-64H360c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8h112c4.4 0 8-3.6 8-8v-16c0-4.4-3.6-8-8-8zm0-64H360c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8h112c4.4 0 8-3.6 8-8v-16c0-4.4-3.6-8-8-8zM208 288c44.2 0 80-35.8 80-80s-35.8-80-80-80-80 35.8-80 80 35.8 80 80 80zm0-128c26.5 0 48 21.5 48 48s-21.5 48-48 48-48-21.5-48-48 21.5-48 48-48zm46.8 144c-19.5 0-24.4 7-46.8 7s-27.3-7-46.8-7c-21.2 0-41.8 9.4-53.8 27.4C100.2 342.1 96 355 96 368.9V392c0 4.4 3.6 8 8 8h16c4.4 0 8-3.6 8-8v-23.1c0-7 2.1-13.8 6-19.6 5.6-8.3 15.8-13.2 27.3-13.2 12.4 0 20.8 7 46.8 7 25.9 0 34.3-7 46.8-7 11.5 0 21.7 5 27.3 13.2 3.9 5.8 6 12.6 6 19.6V392c0 4.4 3.6 8 8 8h16c4.4 0 8-3.6 8-8v-23.1c0-13.9-4.2-26.8-11.4-37.5-12.3-18-32.9-27.4-54-27.4z" class=""></path></svg>
                                        <input id="dni" type="text" autocomplete="off" class="text-sm w-full border-gray-400 focus:border-gray-400 border-0 border-b px-3 pl-10 focus:outline-none focus:ring-0" placeholder="DNI" name="dni" value="{{old('dni')}}" required autofocus>
                                        
                                    </div>
                                    <div class="relative mt-5">
        
                                        <svg aria-hidden="true" class="absolute w-5 h-5 {{$color}}0" style="margin-top: 8px;" focusable="false" data-prefix="fal" data-icon="unlock-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="svg-inline--fa fa-unlock-alt fa-w-12 fa-3x"><path fill="currentColor" d="M336 256H96v-96c0-70.6 25.4-128 96-128s96 57.4 96 128v20c0 6.6 5.4 12 12 12h8c6.6 0 12-5.4 12-12v-18.5C320 73.1 280.9.3 192.5 0 104-.3 64 71.6 64 160v96H48c-26.5 0-48 21.5-48 48v160c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48V304c0-26.5-21.5-48-48-48zm16 208c0 8.8-7.2 16-16 16H48c-8.8 0-16-7.2-16-16V304c0-8.8 7.2-16 16-16h288c8.8 0 16 7.2 16 16v160zm-160-32c-8.8 0-16-7.2-16-16v-64c0-8.8 7.2-16 16-16s16 7.2 16 16v64c0 8.8-7.2 16-16 16z" class=""></path></svg>
                                        <input id="password" type="password" class="text-sm w-full border-gray-400 focus:border-gray-400 border-0 border-b px-3 pl-10 focus:outline-none focus:ring-0" placeholder="Contraseña" name="password" value="{{old('dni')}}" required autocomplete="current-password">
                                        
                                    </div>
        
        
                                    <div class="block mt-4">
                                        <label for="remember_me" class="flex items-center">
                                            <x-jet-checkbox id="remember_me" name="remember" />
                                            <span class="ml-2 text-sm text-gray-600">Recardar clave</span>
                                        </label>
                                    </div>
        
                                    <div class="flex items-center justify-end mt-4">
                                        @if (Route::has('password.request'))
                                            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                                {{ __('Forgot your password?') }}
                                            </a>
                                        @endif
                                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none disabled:opacity-25 transition ml-4">
                                            Entrar
                                        </button>
                                    </div>
                                    <div class="text-center sub">
                                        Sistema de monitoreo v 1.6 Colaboración de <a href="mailto:benjamin_unitek@hotmail.com" class="bg-blue">BQ Developer</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    
                </div>
            </div>
        </div>
    </div>
    <style>
        
    </style>
</x-guest-layout>
