<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center  px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 ']) }}>
    {{ $slot }}
</button>
{{-- <button {{ $attributes->merge(['type' => 'submit', 'class' => ' btn btn-sm h-16 text-lg inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent  font-semibold text-white uppercase tracking-widest hover:bg-blue-400 focus:bg-blue-600 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 transition ease-in-out duration-150  rounded-none']) }}>
    {{ $slot }}
</button> --}}