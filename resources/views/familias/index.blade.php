<x-app-layout>
<nav class="navbar navbar-expand-lg navbar-light bg-warning">
    <div class="container-fluid">
        <a class="navbar-brand h1" href={{ route('dashboard') }}>Inicio</a>
        <div class="justify-end ">
            <div class="col ">

                <!-- Button trigger modal Crear-->
                <button type="button" class="btn btn-sm btn-success bg-green-700" data-bs-toggle="modal"
                    data-bs-target="#modalCrear">
                    Crear Familia
                </button>
                <!-- Modal Crear-->
                <div class="modal fade" id="modalCrear" tabindex="-1" aria-labelledby="modalCrearLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="modalCrearLabel">Crear Familia</h1>
                                <button type="button" class="btn-close text-black" data-bs-dismiss="modal"
                                    aria-label="Close">X</button>
                            </div>
                            <div class="modal-body">

                                <form action="{{ route('familias.store') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="nombre">Nombre</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre"
                                            required maxlength="30">
                                    </div>
                         
                                    <br>

                                    <x-primary-button class="btn-sm">
                                        {{ __('Crear Familia') }}
                                        </x-prymary-button>

                                </form>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary text-black"
                                    data-bs-dismiss="modal">Close</button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</nav>

<div class="container mt-5">
    <table class=" table table-dark table-striped">
        <thead>
            <tr>

                <th scope="col" class="text-center text-xl">NOMBRE DE FAMILIA</th>
              
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($familias as $familia)
                <tr>

                    <td class="text-center text-xl">{{ $familia->nombre }}</td>
                   
                    <td>
                        <div class="d-flex justify-center gap-4">
                            <div>
                                <!-- Button trigger modal Editar-->
                                <button type="button" class="btn btn-sm btn-primary bg-blue-700"
                                    data-bs-toggle="modal" data-bs-target="#modalEditar{{ $familia->id }}">
                                    Editar Familia
                                </button>


                                <!-- Modal Editar-->
                                <div class="modal fade" id="modalEditar{{ $familia->id }}" tabindex="-1"
                                    aria-labelledby="modalEditarLabel" aria-hidden="true">
                                    <div class="modal-dialog text-black">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="modalEditarLabel">Editar Familia
                                                </h1>
                                                <button type="button" class="btn-close text-black"
                                                    data-bs-dismiss="modal" aria-label="Close">X</button>
                                            </div>
                                            <div class="modal-body">

                                                <form action="{{ route('familias.update', $familia->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                        <label for="nombre">Nombre</label>
                                                        <input type="text" class="form-control" id="nombre"
                                                            name="nombre" required maxlength="30"
                                                            value="{{ $familia->nombre }}">
                                                    </div>
                                               
                                                    <br>
                                                    <button type="submit"
                                                        class="btn btn-sm btn btn-primary bg-blue-700">
                                                        Editar Familia
                                                    </button>


                                                </form>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary bg-gray-700"
                                                    data-bs-dismiss="modal">Close</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <!-- Button trigger modal Eliminar-->
                                <button type="button" class="btn btn-sm btn-danger bg-red-600"
                                    data-bs-toggle="modal" data-bs-target="#modalEliminar{{ $familia->id }}">
                                    Eliminar Zona
                                </button>

                                <!-- Modal Eliminar-->
                                <div class="modal fade" id="modalEliminar{{ $familia->id }}" tabindex="-1"
                                    aria-labelledby="modalEliminarLabel" aria-hidden="true">
                                    <div class="modal-dialog text-black">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5">Eliminar Zona
                                                </h1>
                                                <button type="button" class="btn-close text-black"
                                                    data-bs-dismiss="modal" aria-label="Close">X</button>
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

                                                    <button type="submit"
                                                        class="btn btn-sm btn-danger bg-red-600">
                                                        Eliminar Familia
                                                    </button>

                                                </form>
                                                <button type="button" class="btn btn-secondary bg-gray-700"
                                                    data-bs-dismiss="modal">Cancelar</button>

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

</x-app-layout>