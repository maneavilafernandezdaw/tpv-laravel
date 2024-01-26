

{{-- 
<button {{ $attributes->merge(['type' => 'submit', 'class' => ' btn w-full h-32 text-3xl  inline-flex items-center justify-center  bg-green-800 border border-transparent  font-semibold text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-700 focus:ring-offset-2 transition ease-in-out duration-150  rounded-none']) }}>
    {{ $slot }}
</button> --}}

<button {{ $attributes->merge(['type' => 'submit', 'class' => ' btn btn-outline-primary bg-primary-subtle w-full  text-4xl p-3 mb-3 rounded-md']) }}>
    {{ $slot }}
</button>