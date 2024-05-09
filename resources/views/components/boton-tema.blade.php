
<button 
{{ $attributes->merge(['type' => 'button', 'aria-label'=>'botón tema', 'class' => 'text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-base px-3 py-2.5 text-center  mb-2 uppercase']) }}>
    {{ $slot }}</button>
