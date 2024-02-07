<x-app-layout>

    <nav class="navbar navbar-expand-lg navbar-light ">
        <div class="container-fluid">
            <a class="navbar-brand text-2xl" href={{ route('home') }}><x-boton-inicio /></a>
            <h1 class=" h1">CLIENTES</h1>
            <div class="justify-end ">
                <div class="col ">

                    <!-- Button trigger modal Crear-->

                    <x-boton-crear data-bs-toggle="modal" data-bs-target="#modalCrear" />

                    <!-- Modal Crear-->
                    <div class="modal fade " id="modalCrear" tabindex="-1" aria-labelledby="modalCrearLabel"
                        aria-hidden="true">
                        <div class="modal-dialog ">
                            <div class="modal-content">
                                <div class="modal-header  bg-green-600">
                                    <h1 class="modal-title fs-5 text-white" id="modalCrearLabel">Crear Cliente</h1>
                                    @include('components.boton-cancelar-mini')
                                </div>
                                <div class="modal-body">

                                    <form action="{{ route('clientes.store') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="cif">Cif o Nif</label>
                                            <input type="text" class="form-control rounded-md" id="cif"
                                                name="cif" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="nombre">Nombre</label>
                                            <input type="text" class="form-control rounded-md" id="nombre"
                                                name="nombre" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="direccion">Dirección</label>
                                            <input type="text" class="form-control rounded-md" id="direccion"
                                                name="direccion" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control rounded-md" id="email"
                                                name="email" required>
                                        </div>

                                        <br>
                                </div>
                                <div class="modal-footer">
                                    <x-boton-crear />


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

    <div class="container mt-3 card rounded-none">


        {{-- Tabla Clientes --}}
        <div class="card-body  rounded-none my-3">
            <table id="tabla_Datatables" class="table  table-striped table-hover ">
                <thead>
                    <tr>


                        <th>NOMBRE</th>
                        <th>CIF/NIF</th>
                        <th>DIRECCIÓN</th>
                        <th>EMAIL</th>
                        <th></th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientes as $cliente)
                        <tr>

                            <td class="fw-bold text-xl align-middle">{{ $cliente->nombre }}</td>
                            <td class="fw-bold text-xl align-middle">{{ $cliente->cif }}</td>
                            <td class="fw-bold text-xl align-middle">{{ $cliente->direccion }}</td>
                            <td class="fw-bold text-xl align-middle">{{ $cliente->email }}</td>
                            <td>
                                <div class="d-flex justify-end gap-4">
                                    <div>

                                        <!-- Button trigger modal Editar-->
                                        <x-boton-editar data-bs-toggle="modal"
                                            data-bs-target="#modalEditar{{ $cliente->id }}" />

                                        <!-- Modal Editar-->
                                        <div class="modal fade" id="modalEditar{{ $cliente->id }}" tabindex="-1"
                                            aria-labelledby="modalEditarLabel" aria-hidden="true">
                                            <div class="modal-dialog text-black">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-blue-600">
                                                        <h1 class="modal-title fs-5 text-white" id="modalEditarLabel">
                                                            Editar Cliente
                                                        </h1>
                                                        @include('components.boton-cancelar-mini')
                                                    </div>
                                                    <div class="modal-body">

                                                        <form action="{{ route('clientes.update', $cliente->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('PUT')

                                                            <div class="form-group">
                                                                <label for="cif">Cif o Nif</label>
                                                                <input type="text" class="form-control rounded-md"
                                                                    id="cif" name="cif" required
                                                                    value="{{ $cliente->cif }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="nombre">Nombre</label>
                                                                <input type="text" class="form-control rounded-md"
                                                                    id="nombre" name="nombre" required
                                                                    value="{{ $cliente->nombre }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="direccion">Dirección</label>
                                                                <input type="text" class="form-control rounded-md"
                                                                    id="direccion" name="direccion" required
                                                                    value="{{ $cliente->direccion }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="email">Email</label>
                                                                <input type="email" class="form-control rounded-md"
                                                                    id="email" name="email" required
                                                                    value="{{ $cliente->email }}">
                                                            </div>
                                                            <br>

                                                    </div>
                                                    <div class="modal-footer">

                                                        <x-boton-editar />

                                                        @include('components.boton-cancelar')

                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <!-- Button trigger modal Eliminar-->
                                        <x-boton-eliminar data-bs-toggle="modal"
                                            data-bs-target="#modalEliminar{{ $cliente->id }}" />

                                        <!-- Modal Eliminar-->
                                        <div class="modal fade" id="modalEliminar{{ $cliente->id }}" tabindex="-1"
                                            aria-labelledby="modalEliminarLabel" aria-hidden="true">
                                            <div class="modal-dialog text-black">
                                                <div class="modal-content">
                                                    <div class="modal-header  bg-red-600">
                                                        <h1 class="modal-title fs-5 text-white">Eliminar Cliente
                                                        </h1>
                                                        @include('components.boton-cancelar-mini')
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <div>
                                                            <p class="text-black">¿Está seguro que desea eliminar el
                                                                cliente {{ $cliente->nombre }} ?</p>

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="{{ route('clientes.destroy', $cliente->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="hidden" name="idcliente" id="idcliente"
                                                                value="{{ $cliente->id }}">

                                                            <x-boton-eliminar />

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
