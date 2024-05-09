
<button
{{ $attributes->merge(['type' => 'submit','aria-label'=>'botón cobrar', 'class' => 'text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-5xl  py-2  w-full flex justify-center']) }}>
{{ $slot }} </button>
