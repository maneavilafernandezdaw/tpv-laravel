<nav x-data="{ open: false }" class="  p-1">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-4 ">
        <div class="flex  gap-2 justify-between h-16 items-center">

            <!-- Logo -->
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <x-application-logo />
                    </a>
                   
                </div>
            </div>

            <div class=" d-flex items-center justify-between gap-2">

           


                <!-- Settings Dropdown -->
   
                <x-dropdown align="right" >
                    <x-slot name="trigger">
                        <x-boton-usuario pb-3>
                            <div>{{ Auth::user()->name }}</div>
    
                            <div class="ml-1">
                                <svg class="fill-current h-8 w-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </x-boton-usuario>
                    </x-slot>
    
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="text-xl">
                            {{ __('Perfil') }}
                        </x-dropdown-link>
    
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
    
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();"
                                class="text-xl">
                                {{ __('Cerrar sesión') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            
          

            <!-- Hamburger -->

            @if(Auth::user()->admin)
            <div class=" flex items-center ">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md  border border-collapse  transition duration-150 ease-in-out">
               
                    <svg class="h-8 w-8" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            @endif
            


        </div>

        

    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="mt-1">
       

        {{-- nav-admin  --}}
        @include('partials.nav-admin')
    </div>

</div>

</nav>
