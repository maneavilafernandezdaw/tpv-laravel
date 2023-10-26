<x-app-layout>
    <x-slot name="header" class=" ">
 {{-- nav-admin  --}}
 @include('partials.nav-admin')
    </x-slot>
    <nav class="navbar navbar-expand-lg navbar-light bg-gray-800">
        <div class="container-fluid">
            <a class="navbar-brand h1 text-white" href={{ route('dashboard') }}>Inicio</a>
            <h1 class="text-white h1">FAMILIAS</h1>
            <div class="justify-end ">
                <div class="col ">

                    <!-- Button trigger modal Crear-->
                  
                    <x-boton-crear data-bs-toggle="modal" data-bs-target="#modalCrear">
                        {{ __('Nueva') }}
                    </x-boton-crear>
                    <!-- Modal Crear-->
                    <div class="modal fade " id="modalCrear" tabindex="-1" aria-labelledby="modalCrearLabel"
                        aria-hidden="true">
                        <div class="modal-dialog ">
                            <div class="modal-content">
                                <div class="modal-header  bg-green-600">
                                    <h1 class="modal-title fs-5 text-white" id="modalCrearLabel">Crear Zona</h1>

                                </div>
                                <div class="modal-body">

                                    <form action="{{ route('familias.store') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="nombre">Nombre</label>
                                            <input type="text" class="form-control rounded-md" id="nombre"
                                                name="nombre" required maxlength="30">
                                        </div>
                                  
                                        <br>

                                        <x-boton-crear>
                                            {{ __('Aceptar') }}
                                        </x-boton-crear>

                                        @include('components.boton-cancelar')

                                    </form>


                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </nav>

    {{-- session mensaje  --}}
    @include('partials.session-mensaje')

    <div class="container mt-3 card bg-gray-700 rounded-none">




        <div class="card-body bg-gray-300 rounded-none my-3">
            <table id="tabla_Datatables" class="table table-dark table-striped table-hover ">
                <thead>
                    <tr>

                        <th>NOMBRE DE ZONA</th>
                        
                        <th></th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($familias as $familia)
                        <tr>

                            <td class="fw-bold text-xl align-middle">{{ $familia->nombre }}</td>
                   

                            <td>
                                <div class="d-flex justify-center gap-4">
                                    <div>
                                        <!-- Button trigger modal Editar-->
                                  
                                        <x-boton-editar data-bs-toggle="modal" data-bs-target="#modalEditar{{ $familia->id }}">
                                            {{ __('Editar') }}
                                        </x-boton-editar>
                                        <!-- Modal Editar-->
                                        <div class="modal fade" id="modalEditar{{ $familia->id }}" tabindex="-1"
                                            aria-labelledby="modalEditarLabel" aria-hidden="true">
                                            <div class="modal-dialog text-black">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-blue-600">
                                                        <h1 class="modal-title fs-5 text-white" id="modalEditarLabel">
                                                            Editar Familia
                                                        </h1>

                                                    </div>
                                                    <div class="modal-body">

                                                        <form action="{{ route('familias.update', $familia->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group">
                                                                <label for="nombre">Nombre</label>
                                                                <input type="text" class="form-control  rounded-md"
                                                                    id="nombre" name="nombre" required
                                                                    maxlength="30" value="{{ $familia->nombre }}">
                                                            </div>
                                        
                                                            <br>

                                                            <x-boton-editar>
                                                                {{ __('Editar') }}
                                                            </x-boton-editar>

                                                            @include('components.boton-cancelar')


                                                        </form>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>




                                    </div>
                                    <div>
                                        <!-- Button trigger modal Eliminar-->
                                        <x-boton-eliminar data-bs-toggle="modal" data-bs-target="#modalEliminar{{ $familia->id }}">
                                            {{ __('Eliminar') }}
                                        </x-boton-eliminar>
                                        <!-- Modal Eliminar-->
                                        <div class="modal fade" id="modalEliminar{{ $familia->id }}" tabindex="-1"
                                            aria-labelledby="modalEliminarLabel" aria-hidden="true">
                                            <div class="modal-dialog text-black">
                                                <div class="modal-content">
                                                    <div class="modal-header  bg-red-600">
                                                        <h1 class="modal-title fs-5 text-white">Eliminar Familia
                                                        </h1>

                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <div>
                                                            <p class="text-black">¿Está seguro que desea eliminar la
                                                                familia {{ $familia->nombre }} ?</p>

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="{{ route('familias.destroy', $familia->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="hidden" name="idfamilia" id="idfamilia"
                                                                value="{{ $familia->id }}">

                                                                <x-boton-eliminar>
                                                                    {{ __('Eliminar') }}
                                                                </x-boton-eliminar>

                                                        </form>
                                                        
                                                        @include('components.boton-cancelar')

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

</x-app-layout>
