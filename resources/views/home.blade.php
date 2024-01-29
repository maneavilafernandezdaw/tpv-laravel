<x-app-layout>

    <div class="pt-12">
        <div class="max-w-5xl mx-auto px-8 lg:px-8">
            <div class="d-flex flex-col gap-4">
                @if (Auth::user()->super)
                    <a href="{{ route('profile.register') }}"> <x-boton-comanda>
                            {{ __('crear usuario') }}
                        </x-boton-comanda></a>
                        <a href="{{ route('profile.index') }}"> <x-boton-comanda>
                            {{ __('Ver usuarios') }}
                        </x-boton-comanda></a>
                    
                @else
                    
             
          
                

                    <a href="{{ route('comandas.index') }}"> <x-boton-comanda>
                            {{ __('Comandas') }}
                        </x-boton-comanda></a>
                @endif



            </div>
        </div>
    </div>


</x-app-layout>
