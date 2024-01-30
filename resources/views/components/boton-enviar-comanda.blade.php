<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-outline-primary bg-primary-subtle btn-sm h-16 text-lg inline-flex items-center px-4 py-2 font-semibold uppercase rounded-md']) }}>
    <i class="fa-regular fa-share-from-square"></i>{{ $slot }}
</button>
