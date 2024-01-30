<button
    {{ $attributes->merge(['type' => 'submit', 'class' => ' btn btn-outline-success bg-success-subtle w-full h-16 text-3xl  inline-flex items-center justify-center   font-semibold  uppercase  rounded-md']) }}>
    {{ $slot }}
</button>
