<x-app-layout>

    <div class="pt-4 ">



        <div class="max-w-5xl mx-auto px-8 lg:px-8">
            <div class="flex justify-end gap-2 mb-2">
                @if (request()->cookie('tema') === 'light')
                    <a href="{{ route('tema.temaOscuro') }}">
                        <x-boton-tema>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-moon-stars-fill" viewBox="0 0 16 16">
                                <path
                                    d="M6 .278a.77.77 0 0 1 .08.858 7.2 7.2 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277q.792-.001 1.533-.16a.79.79 0 0 1 .81.316.73.73 0 0 1-.031.893A8.35 8.35 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.75.75 0 0 1 6 .278">
                                </path>

                            </svg>
                        </x-boton-tema></a>
                @else
                    <a href="{{ route('tema.temaClaro') }}">
                        <x-boton-tema>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-brightness-high " viewBox="0 0 16 16">
                                <path
                                    d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6m0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8M8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0m0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13m8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5M3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8m10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0m-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0m9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707M4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708" />
                            </svg>
                        </x-boton-tema>
                    </a>
                @endif
            </div>
            <div class="flex flex-col gap-4">

                @if (Auth::user()->super)
                    <a href="{{ route('profile.register') }}"> <x-boton-comanda>
                            {{ __('Crear Usuario') }}
                        </x-boton-comanda></a>
                    <a href="{{ route('profile.index') }}"> <x-boton-comanda>
                            {{ __('Usuarios') }}
                        </x-boton-comanda></a>
                    @if (Auth::user()->admin)
                        <a href="{{ route('comandas.index') }}" class="mb-2"> <x-boton-comanda>
                                {{ __('Comandas') }}
                            </x-boton-comanda></a>
                         
                    @endif
                @else
                    <a href="{{ route('comandas.index') }}" class="mb-2"> <x-boton-comanda>
                            {{ __('Comandas') }}
                        </x-boton-comanda></a>
                     
                @endif



            </div>
        </div>
    </div>


</x-app-layout>
