<x-app-layout>


    {{-- session mensaje  --}}
    @include('partials.session-mensaje')


    <div class="container px-4 flex justify-center gap-4 items-center mt-2">
        <div>
            <a class="navbar-brand text-2xl" href={{ route('home') }}><x-boton-inicio /></a>
        </div>
        <div class="flex flex-col flex-md-row">
            <div>
                <span class=" h1  text-center mt-2"> {{ $zona->nombre }} </span>
            </div>
        </div>
        <div>
            <a class="navbar-brand text-2xl" href={{ route('comandas.index') }}><x-boton-volver /></a>
        </div>
    </div>



    <div class="container  mt-3  p-6  border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div class="flex flex-wrap gap-3 justify-center">
            @for ($i = 1; $i <= $zona->mesas; $i++)
                @php
                    $ocupada = 0;
                    $f = 'todo';
                @endphp

                <a href="{{ route('comandas.create', [$zona->id, $i, $f]) }}">

                    @foreach ($comandas as $comanda)
                        @if ($comanda->mesa == $i && $comanda->zona_id === $zona->id)
                            @php
                                $ocupada = 1;
                            @endphp
                        @endif
                    @endforeach
                    @if ($ocupada > 0)
                    
                        <x-boton-mesa-ocupada>
                            {{ $i }}
                        </x-boton-mesa-ocupada>
                    @else
             

                        <x-boton-mesa-libre>
                            {{ $i }}
                        </x-boton-mesa-libre>

                    @endif

                </a>
            @endfor
        </div>



    </div>
    

</x-app-layout>
