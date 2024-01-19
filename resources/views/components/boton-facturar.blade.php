<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-outline-success btn-sm h-16 text-lg inline-flex items-center px-4 py-2 font-semibold uppercase rounded-none']) }} >
    {{ $slot }}
</button>