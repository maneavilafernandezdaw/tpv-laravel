

    <div class="d-flex flex-col flex-lg-row justify-content-center gap-2 ">

        @if(Auth::user()->admin)
        

        <a href="{{ route('zonas.index') }}" class="">
            <x-boton-admin class="min-w-full">
                {{ __('Zonas') }}
            </x-boton-admin>
        </a>

        <a href="{{ route('familias.index') }}">
            <x-boton-admin class="min-w-full">
                {{ __('Familias') }}
            </x-boton-admin>
        </a>

        <a href="{{ route('productos.index') }}">
            <x-boton-admin class="min-w-full">
                {{ __('Productos') }}
            </x-boton-admin>
        </a>

        <a href="{{ route('clientes.index') }}">
            <x-boton-admin class="min-w-full">
                {{ __('Clientes') }}
            </x-boton-admin>
        </a>

        <a href="{{ route('cobros.index') }}">
            <x-boton-admin class="min-w-full">
                {{ __('Cobros') }}
            </x-boton-admin>
        </a>

        <a href="{{ route('cajas.index') }}">
            <x-boton-admin class="min-w-full">
                {{ __('Cajas') }}
            </x-boton-admin>
        </a>

        <a href="{{ route('factura.index') }}">
            <x-boton-admin class="min-w-full">
                {{ __('Facturas') }}
            </x-boton-admin>
        </a>
      
@endif

    </div>

