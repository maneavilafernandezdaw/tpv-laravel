<x-app-layout>

    <div class="pt-12">
        <div class="max-w-4xl mx-auto px-8 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm ">
                <a href="{{ route('comandas.index') }}"><div class="p-6 fw-bold text-2xl text-gray-900">
                    {{ __("Crear Comanda") }}
                </div></a>
      
            </div>
        </div>
    </div>

    <div class="pt-12">
        <div class="max-w-4xl mx-auto px-8 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm ">
        
                <a href="{{ route('comandas.cuenta') }}"><div class="p-6 fw-bold text-2xl text-gray-900">
                    {{ __("Consultar Cuenta") }}
                </div></a>
            </div>
        </div>
    </div>

</x-app-layout>
