<x-app-layout>
    <nav class="navbar navbar-expand-lg navbar-light bg-warning">
        <div class="container-fluid">
            <a class="navbar-brand h1" href={{ route('dashboard') }}>Inicio</a>
            <div class="justify-end ">
                <div class="col ">

                    <!-- Button trigger modal Crear-->
                    <button type="button" class="btn btn-sm btn-success bg-green-700" data-bs-toggle="modal"
                        data-bs-target="#modalCrear">
                        Crear Zona
                    </button>
                    <!-- Modal Crear-->
                    <div class="modal fade" id="modalCrear" tabindex="-1" aria-labelledby="modalCrearLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="modalCrearLabel">Crear Zona</h1>
                                    <button type="button" class="btn-close text-black" data-bs-dismiss="modal"
                                        aria-label="Close">X</button>
                                </div>
                                <div class="modal-body">

                                    <form action="{{ route('zonas.store') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="nombre">Nombre</label>
                                            <input type="text" class="form-control" id="nombre" name="nombre"
                                                required maxlength="30">
                                        </div>
                                        <div class="form-group">
                                            <label for="mesas">Mesas</label>
                                            <input type="number" class="form-control" id="mesas" name="mesas"
                                                required>
                                        </div>
                                        <br>

                                        <x-primary-button class="btn-sm">
                                            {{ __('Crear Zona') }}
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


    <div class="container mt-3 card">
        <div class="card-body">
            <table id="zonas" class="table table-striped">
                <thead>
                    <tr>

                        <th class=>NOMBRE DE ZONA</th>
                        <th class=>Nº DE MESAS</th>
                        <th></th>
                    
                    </tr>
                </thead>
                <tbody>
                    @foreach ($zonas as $zona)
                        <tr>

                            <td class=>{{ $zona->nombre }}</td>
                            <td class=>{{ $zona->mesas }}</td>
                            
                               <td> <div class="d-flex justify-center gap-4">
                                    <div>
                                        <!-- Button trigger modal Editar-->
                                        <button type="button" class="btn btn-sm btn-primary bg-blue-700"
                                            data-bs-toggle="modal" data-bs-target="#modalEditar{{ $zona->id }}">
                                            Editar Zona
                                        </button>


                                        <!-- Modal Editar-->
                                        <div class="modal fade" id="modalEditar{{ $zona->id }}" tabindex="-1"
                                            aria-labelledby="modalEditarLabel" aria-hidden="true">
                                            <div class="modal-dialog text-black">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="modalEditarLabel">Editar Zona
                                                        </h1>
                                                        <button type="button" class="btn-close text-black"
                                                            data-bs-dismiss="modal" aria-label="Close">X</button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <form action="{{ route('zonas.update', $zona->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group">
                                                                <label for="nombre">Nombre</label>
                                                                <input type="text" class="form-control"
                                                                    id="nombre" name="nombre" required
                                                                    maxlength="30" value="{{ $zona->nombre }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="mesas">Mesas</label>
                                                                <input type="number" class="form-control"
                                                                    id="mesas" name="mesas" required
                                                                    value="{{ $zona->mesas }}">
                                                            </div>
                                                            <br>
                                                            <button type="submit"
                                                                class="btn btn-sm btn btn-primary bg-blue-700">
                                                                Editar Zona
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
                                            data-bs-toggle="modal" data-bs-target="#modalEliminar{{ $zona->id }}">
                                            Eliminar Zona
                                        </button>

                                        <!-- Modal Eliminar-->
                                        <div class="modal fade" id="modalEliminar{{ $zona->id }}" tabindex="-1"
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
                                                                zona {{ $zona->nombre }} ?</p>

                                                        </div>




                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="{{ route('zonas.destroy', $zona->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="hidden" name="idzona" id="idzona"
                                                                value="{{ $zona->id }}">

                                                            <button type="submit"
                                                                class="btn btn-sm btn-danger bg-red-600">
                                                                Eliminar Zona
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
    </div>

</x-app-layout>
