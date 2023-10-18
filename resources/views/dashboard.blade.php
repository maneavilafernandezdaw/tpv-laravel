<x-app-layout>

   
    <x-slot name="header" class=" bg-warning">
      <div class="d-flex justify-content-center gap-2  bg-warning">
        <h2  class="inline-block font-semibold text-xl text-gray-800 leading-tight"><a href="{{ route('zonas.index') }}" class="inline-block font-semibold text-xl text-gray-800 leading-tight hover:text-gray-600">Zonas</a></h2>
        <h2  class="inline-block font-semibold text-xl text-gray-800 leading-tight"><a href="{{ route('familias.index') }}" class="inline-block font-semibold text-xl text-gray-800 leading-tight hover:text-gray-600">Familias</a></h2>
    </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>
