

    <div class="d-flex flex-column flex-lg-row justify-content-center gap-2 ">

        @if(Auth::user()->admin)
        
        <a href="{{ route('zonas.index') }}" class="">
            <x-primary-button class="  h-16  text-lg  min-w-full">
                {{ __('Zonas') }}
            </x-primary-button>
        </a>
        <a href="{{ route('familias.index') }}">
            <x-primary-button class="  h-16  text-lg  min-w-full">
                {{ __('Familias') }}
            </x-primary-button>
        </a>
        <a href="{{ route('productos.index') }}">
            <x-primary-button class="  h-16  text-lg  min-w-full">
                {{ __('Productos') }}
            </x-primary-button>
        </a>
        <a href="{{ route('cobros.index') }}">
            <x-primary-button class="  h-16  text-lg  min-w-full">
                {{ __('Cobros') }}
            </x-primary-button>
        </a>
        <a href="{{ route('cajas.index') }}">
            <x-primary-button class="  h-16  text-lg  min-w-full">
                {{ __('Cajas') }}
            </x-primary-button>
        </a>
      
@endif

    </div>

