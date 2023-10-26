{{-- <button type="button" class="btn btn-sm h-14 text-lg btn-primary inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-700 focus:ring-offset-2 transition ease-in-out duration-150  rounded-none"
data-bs-toggle="modal" data-bs-target="#modalEditar">
Editar 
</button> --}}


<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-sm h-16 text-lg inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-700 focus:ring-offset-2 transition ease-in-out duration-150  rounded-none']) }}>
    {{ $slot }}
</button>