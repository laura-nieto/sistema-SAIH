<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Ingresar</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased" style="background-image:url({{asset('img/medicine-team.png')}});background-size:cover;">
            <div class="min-h-screen flex flex-col justify-center items-center md:flex-row md:justify-around">
                <div class="flex flex-col items-center sm:max-w-md mt-6 px-6 py-7 bg-black bg-opacity-50 text-white shadow-md overflow-hidden sm:rounded-lg">
                    <h1 class="mb-5 text-5xl font-bold">SAIH-ERP</h1>
                    @livewire('logo.logo-login')
                    <h6 class="mt-5 text-2xl text-center">Sistema de Administración Integral Hospitalario</h6>
                </div>
                <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                    @if (session('error'))
                        <div class="mb-4 font-medium text-red-500">
                            {{ session('error') }}
                        </div>
                    @endif
                    <x-jet-validation-errors class="mb-4" />

                    <div class="bg-red-200 text-red-600 my-4 py-2 flex items-center justify-center rounded hidden" id="error">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        <p class="font-bold ml-3" id="error_msj"></p>
                    </div>

                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" onkeydown="return event.key != 'Enter';">
                        @csrf

                        <div class="" id="login">
                            <div>
                                <x-jet-label for="email" value="{{ __('Email') }}" />
                                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                            </div>

                            <div class="mt-4">
                                <x-jet-label for="password" value="{{ __('Contraseña') }}" />
                                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                            </div>

                            {{-- <div class="mt-4">
                                <x-jet-label for="sucursal" value="{{ __('Sucursal') }}" />
                                <select name="sucursal_id" id="sucursal" class="w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required>
                                    @foreach ($sucursales as $sucursal)
                                        <option value="{{$sucursal->id}}">{{$sucursal->nombre}}</option>
                                    @endforeach
                                </select>
                            </div> --}}

                            <div class="block mt-4">
                                <label for="remember_me" class="flex items-center">
                                    <x-jet-checkbox id="remember_me" name="remember" />
                                    <span class="ml-2 text-sm text-gray-600">{{ __('Recuérdame') }}</span>
                                </label>
                            </div>
                        </div>
                        <div class="hidden" id="sucursales">
                            <div class="mb-6">
                                <x-jet-label for="sucursal" value="{{ __('Sucursal') }}" />
                                <select name="sucursal_id" id="sucursal" class="w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required>
                                    {{-- @foreach ($sucursales as $sucursal)
                                        <option value="{{$sucursal->id}}">{{$sucursal->nombre}}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                            <div class="flex items-center justify-end mt-4">
                                <x-jet-button class="ml-4">
                                    {{ __('Entrar') }}
                                </x-jet-button>
                            </div>
                        </div>
                        <div id="buttonSend" class="flex items-center justify-end mt-4">
                            @if (Route::has('password.request'))
                                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                    {{ __('¿Olvidaste la contraseña?') }}
                                </a>
                            @endif

                            <x-jet-button class="ml-4" id="btn">
                                {{ __('Ingresar') }}
                            </x-jet-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        const urlVerificar = '{!! route('validar_usuario') !!}';

        let btn = document.getElementById('btn'),
            formLogin = document.getElementById('login'),
            formBtn = document.getElementById('buttonSend'),
            formSucu = document.getElementById('sucursales'),
            selectSucu = document.getElementById('sucursal')
        ;

        btn.addEventListener('click',function(e){
            e.preventDefault();

            let email = document.getElementById('email'),
                password = document.getElementById('password'),
                data = {
                    email : email.value,
                    password : password.value
                };

            axios.post(urlVerificar,data)
            .then((respuesta)=>{
                document.getElementById('error').classList.add('hidden');
                formLogin.classList.add('hidden');
                formBtn.classList.add('hidden');
                formBtn.classList.add('hidden');
                formSucu.classList.remove('hidden');
                console.log(respuesta);
                for(let i = 0; i < respuesta.data.length; i++){
                    var opciones = '<option value="'+respuesta.data[i].id+'">'+respuesta.data[i].nombre+'</option>';
                    selectSucu.innerHTML = opciones;
                }
            })
            .catch((error)=>{
                let error_msj = document.getElementById('error_msj'),
                    error_div = document.getElementById('error');
                if (error.response) {
                    error_msj.innerText = error.response.data;
                    error_div.classList.remove('hidden');
                }
            }) 
        });
    </script>
</body>
</html>
