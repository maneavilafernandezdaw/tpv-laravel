

<button
{{ $attributes->merge(['type' => 'submit', 'class' => 'text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-3xl px-3 py-3 text-center me-2 mb-2 w-full uppercase']) }}>
    {{ $slot }}</button>