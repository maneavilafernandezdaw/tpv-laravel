

    <div class="d-flex flex-column flex-sm-row justify-content-center gap-2 ">

        @if(Auth::user()->admin)
        
        <a href="{{ route('zonas.index') }}" class="">
            <x-primary-button class="  h-16  text-xl  min-w-full">
                {{ __('Zonas') }}
            </x-primary-button>
        </a>
        <a href="{{ route('familias.index') }}">
            <x-primary-button class="  h-16  text-xl  min-w-full">
                {{ __('Familias') }}
            </x-primary-button>
        </a>
        <a href="{{ route('productos.index') }}">
            <x-primary-button class="  h-16  text-xl  min-w-full">
                {{ __('Productos') }}
            </x-primary-button>
        </a>
      
@endif

    </div>

