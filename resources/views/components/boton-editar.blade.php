<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-outline-primary btn-sm h-16 text-lg inline-flex items-center px-4 py-2 font-semibold uppercase rounded-md']) }}>
    {{ $slot }}<i class="fa-solid fa-pen-to-square"></i>
</button>
