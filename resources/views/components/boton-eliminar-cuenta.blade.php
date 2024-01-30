<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-outline-danger bg-danger-subtle btn-sm w-full h-16 text-3xl inline-flex items-center justify-center font-semibold uppercase rounded-md']) }}>
    {{ $slot }}<i class="fa-regular fa-trash-can"></i>
</button>
