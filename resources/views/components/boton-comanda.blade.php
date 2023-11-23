


{{-- <button {{ $attributes->merge(['type' => 'submit', 'class' => ' btn btn-sm h-16 text-lg inline-flex items-center px-4 py-2 bg-green-800 border border-transparent  font-semibold text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-700 focus:ring-offset-2 transition ease-in-out duration-150  rounded-none']) }}>
    {{ $slot }}
</button> --}}

<button {{ $attributes->merge(['type' => 'submit', 'class' => ' btn btn-outline-success rounded-none w-screen text-3xl p-3 mb-3 shadow']) }}>
    {{ $slot }}
</button>