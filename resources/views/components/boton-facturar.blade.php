<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-outline-success btn-sm h-16 text-lg inline-flex items-center justify-center  font-semibold uppercase rounded-none']) }} >
    {{ $slot }}
</button>
