
<button 
{{ $attributes->merge(['type' => 'submit','aria-label'=>'botón usuario', 'class' => 'text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-xl px-3 py-2 text-center me-2 mb-0 uppercase']) }}>
    {{ $slot }}</button>
