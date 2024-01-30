<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-outline-primary bg-primary-subtle btn-sm h-16 px-3 text-xl inline-flex items-center font-semibold uppercase rounded-md ']) }}>
    {{ $slot }}
</button>
