<button
    {{ $attributes->merge(['type' => 'submit', 'class' => ' btn btn-outline-primary bg-primary-subtle w-full  text-4xl p-3 mb-3 rounded-md']) }}>
    {{ $slot }}
</button>
