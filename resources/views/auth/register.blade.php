<x-app-layout>

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4  shadow-md overflow-hidden sm:rounded-lg">

            <form method="POST" action="{{ route('profile.store') }}">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Nombre')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                        required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                        :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>


                <!-- Tipo -->
                <br>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="tipo" id="flexRadioDefault1" value="0"
                        checked>
                    <label class="form-check-label" for="flexRadioDefault3">
                        Camarero
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="tipo" id="flexRadioDefault2" value="1">
                    <label class="form-check-label" for="flexRadioDefault2">
                        Administrador
                    </label>
                </div>
                
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="tipo" id="flexRadioDefault3" value="2">
                    <label class="form-check-label" for="flexRadioDefault1">
                        SuperAdministrador
                    </label>
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Contraseña')" />

                    <x-text-input id="password" class="block mt-1 w-full " type="password" name="password"  minlength="8" required
                        autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

             

                <div class="flex items-center justify-end mt-4">


                    <x-primary-button class="ml-4">
                        {{ __('Registrar') }}
                    </x-primary-button>



            </form>

        </div>
        <div class="flex items-center justify-end mt-4">
            <a href="{{ route('login') }}">
                <x-secondary-button class="w-full">
                    {{ __(' Cancelar ') }}
                </x-secondary-button>
            </a>
        </div>
    </div>
    </div>
</x-app-layout>
