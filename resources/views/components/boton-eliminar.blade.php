{{-- <button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-sm h-16 text-lg inline-flex items-center px-4 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-700 focus:ring-offset-2 transition ease-in-out duration-150  rounded-none']) }}>
    {{ $slot }}
</button> --}}

<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-outline-danger btn-sm h-16 text-lg inline-flex items-center px-4 py-2 font-semibold uppercase rounded-md']) }}>
    {{ $slot }}
</button>