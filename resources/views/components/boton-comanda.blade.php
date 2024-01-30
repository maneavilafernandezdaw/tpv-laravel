<button
    {{ $attributes->merge(['type' => 'submit', 'class' => ' btn btn-outline-primary bg-primary-subtle rounded-md w-full h-32 text-5xl ']) }}>
    {{ $slot }}
</button>
