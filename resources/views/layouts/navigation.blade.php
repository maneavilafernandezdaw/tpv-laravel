<nav x-data="{ open: false }" class="  p-1">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto  pe-2.5 ">
        <div class="flex  gap-2 justify-between h-16 items-center">

            <!-- Logo -->
            <div class="flex -ms-2">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <x-application-logo />
                    </a>

                </div>
            </div>

            <div class=" flex items-center justify-between gap-2">




                <!-- Settings Dropdown -->
                @if (Auth::check())
                    <x-dropdown align="right">
                        <x-slot name="trigger">
                            <x-boton-usuario class=" flex justify-center content-center">
                                <div>{{ Auth::user()->name }}</div>

                                <div>
                                    <svg class="fill-current h-8 w-8" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
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

                          <!-- pdf manuales -->
                         
                               @if(!Auth::user()->admin && Auth::user()->super)
                               <a class="block w-full px-4 py-2 text-left text-xl leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"
                               target="_blank" href="{{asset('./manuales/super.pdf')}}" >
                               Manual(PDF)
                               </a>
                                @elseif(Auth::user()->admin && !Auth::user()->super)
                                <a class="block w-full px-4 py-2 text-left text-xl leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"
                                 target="_blank" href="{{asset('./manuales/admin.pdf')}}" >
                                Manual(PDF)
                                </a>
                                @elseif(!Auth::user()->admin && !Auth::user()->super)
                                <a class="block w-full px-4 py-2 text-left text-xl leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"
                                 target="_blank" href="{{asset('./manuales/camarero.pdf')}}">
                                 Manual(PDF)
                                </a>
                                @endif
                           

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

                    @if (Auth::user()->admin)
                        <div class=" flex items-center ">
                            <button @click="open = ! open" aria-label='botón menú'
                                class="text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-2xl px-2 py-2 text-center uppercase">

                                <svg class="h-8 w-8" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    @endif
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
