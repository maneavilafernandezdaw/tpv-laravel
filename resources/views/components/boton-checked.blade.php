


<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-primary bg-primary btn-sm h-16 px-3 text-xl inline-flex items-center font-semibold uppercase rounded-md ']) }}>
    {{ $slot }}
</button>