
<button 
    {{ $attributes->merge(['type' => 'submit', 'aria-label'=>'botón admin', 'class' => 'text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-xl px-3 py-2.5 text-center me-2 mb-2 uppercase']) }}>
    {{ $slot }}
</button>