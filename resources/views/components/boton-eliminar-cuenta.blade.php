


{{-- <button {{ $attributes->merge(['type' => 'submit', 'class' => ' btn btn-sm w-full h-32 text-3xl  inline-flex items-center justify-center  bg-red-800 border border-transparent  font-semibold text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-700 focus:ring-offset-2 transition ease-in-out duration-150  rounded-none']) }}>
    {{ $slot }}
</button>
 --}}

 <button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-outline-danger bg-danger-subtle btn-sm w-full h-16 text-3xl inline-flex items-center justify-center font-semibold uppercase rounded-md']) }}>
    {{ $slot }}
</button>