<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-outline-success bg-success-subtle btn-sm h-16 text-xl inline-flex items-center px-4 py-2  font-semibold uppercase rounded-md']) }}>
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/>
      </svg>
      {{ $slot }}
</button>
