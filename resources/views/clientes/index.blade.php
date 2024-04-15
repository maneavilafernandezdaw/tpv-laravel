<x-app-layout>

    <nav class="">
        <div class="container flex flex-row justify-between items-center ">
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
                                            <input type="text" class="form-control rounded-md bg-white text-black"
                                                id="cif" name="cif" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="nombre">Nombre</label>
                                            <input type="text" class="form-control rounded-md bg-white text-black"
                                                id="nombre" name="nombre" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="direccion">Dirección</label>
                                            <input type="text" class="form-control rounded-md bg-white text-black"
                                                id="direccion" name="direccion" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control rounded-md bg-white text-black"
                                                id="email" name="email" required>
                                        </div>


                                </div>
                                <div class="modal-footer">
                                    <x-boton-crear onclick="mostrarCargando()" />


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


                                    </div>
                                    <div>
                                        <!-- Button trigger modal Eliminar-->
                                        <x-boton-eliminar data-bs-toggle="modal"
                                            data-bs-target="#modalEliminar{{ $cliente->id }}" />

                                    </div>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal Editar-->
                        <div class="modal fade" id="modalEditar{{ $cliente->id }}" tabindex="-1"
                            aria-labelledby="modalEditarLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-blue-600">
                                        <h1 class="modal-title fs-5 text-white" id="modalEditarLabel">
                                            Editar Cliente
                                        </h1>
                                        @include('components.boton-cancelar-mini')
                                    </div>
                                    <div class="modal-body">

                                        <form action="{{ route('clientes.update', $cliente->id) }}" method="post">
                                            @csrf
                                            @method('PUT')

                                            <div class="form-group">
                                                <label for="cif">Cif o Nif</label>
                                                <input type="text"
                                                    class="form-control rounded-md bg-white text-black" id="cif"
                                                    name="cif" required value="{{ $cliente->cif }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="nombre">Nombre</label>
                                                <input type="text"
                                                    class="form-control rounded-md bg-white text-black" id="nombre"
                                                    name="nombre" required value="{{ $cliente->nombre }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="direccion">Dirección</label>
                                                <input type="text"
                                                    class="form-control rounded-md bg-white text-black" id="direccion"
                                                    name="direccion" required value="{{ $cliente->direccion }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email"
                                                    class="form-control rounded-md bg-white text-black" id="email"
                                                    name="email" required value="{{ $cliente->email }}">
                                            </div>


                                    </div>
                                    <div class="modal-footer">

                                        <x-boton-editar onclick="mostrarCargando()" />

                                        @include('components.boton-cancelar')

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Modal Eliminar-->
                        <div class="modal fade" id="modalEliminar{{ $cliente->id }}" tabindex="-1"
                            aria-labelledby="modalEliminarLabel" aria-hidden="true">
                            <div class="modal-dialog ">
                                <div class="modal-content">
                                    <div class="modal-header  bg-red-600">
                                        <h1 class="modal-title fs-5 text-white">Eliminar Cliente
                                        </h1>
                                        @include('components.boton-cancelar-mini')
                                    </div>
                                    <div class="modal-body text-center">
                                        <div>
                                            <p>¿Está seguro que desea eliminar el
                                                cliente {{ $cliente->nombre }} ?</p>

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('clientes.destroy', $cliente->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="idcliente" id="idcliente"
                                                value="{{ $cliente->id }}">

                                            <x-boton-eliminar onclick="mostrarCargando()" />

                                        </form>

                                        @include('components.boton-cancelar')

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        function mostrarCargando() {
            // Muestra el indicador de carga
            document.getElementById("loading").style.display = "block";

            // Seleccionar todos los elementos por su clase
            var elementos = document.querySelectorAll('.fade');

            // Iterar sobre todos los elementos seleccionados
            elementos.forEach(function(elemento) {
                // Ejemplo de manipulación de cada elemento seleccionado
                elemento.style.display = 'none';

            });
        }
    </script>
</x-app-layout>
