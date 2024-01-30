<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-outline-danger bg-danger-subtle btn-sm h-16 text-lg inline-flex items-center px-4 py-2 font-semibold uppercase rounded-md']) }}>
    {{ $slot }}<i class="fa-regular fa-trash-can"></i>
</button>
