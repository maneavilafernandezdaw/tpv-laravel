


{{-- <button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn  h-10 w-10  text-xl inline-flex justify-center items-center px-2 py-2 bg-green-800 border border-transparent  font-semibold text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-700 focus:ring-offset-2 transition ease-in-out duration-150  rounded-none']) }}>
    {{ $slot }}
</button>
 --}}
<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-outline-success bg-success-subtle h-10 w-10  text-xl inline-flex justify-center items-center px-2 py-2  font-semibold  uppercase rounded-md']) }}>
    <i class="fa-solid fa-plus"></i>
</button>