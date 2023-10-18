<x-app-layout>
 <nav class="navbar navbar-expand-lg navbar-light bg-warning">
        <div class="container-fluid">
            <a class="navbar-brand h1" href={{ route('dashboard') }}>Inicio</a>
            <div class="justify-end ">
                <div class="col ">
                    <a class="btn btn-sm btn-success" href={{ route('familias.index') }}>Volver a Familias</a>
                </div>
            </div>
    </nav>

    <div class="container h-100 mt-5">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-10 col-md-8 col-lg-6">
                <h1 class="h1">Crear una Familia</h1>
                <form action="{{ route('familias.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required maxlength="30">
                    </div>
       
                    <br>
                 
                    <x-primary-button class="btn-sm">
                        {{ __('Crear Familia') }}
                    </x-prymary-button>
                 
                </form>
            </div>
        </div>
    </div>
</x-app-layout>