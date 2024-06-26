<x-app-layout>

    <nav class="">
        <div class="container flex flex-row justify-between items-center ">
            <a class="" href={{ route('home') }}> <x-boton-inicio></x-boton-inicio></a>
            <h1 class=" h1">ZONAS</h1>
            <div class="justify-end ">
                <div class="col ">

                    <!-- Button trigger modal Crear-->

                    <x-boton-crear data-bs-toggle="modal" data-bs-target="#modalCrear">

                    </x-boton-crear>
                    <!-- Modal Crear-->
                    <div class="modal fade " id="modalCrear" tabindex="-1" aria-labelledby="modalCrearLabel"
                        aria-hidden="true">
                        <div class="modal-dialog ">
                            <div class="modal-content">
                                <div class="modal-header  bg-green-600">
                                    <h1 class="modal-title fs-5 text-white" id="modalCrearLabel">Crear Zona</h1>
                                    @include('components.boton-cancelar-mini')
                                </div>
                                <div class="modal-body">

                                    <form action="{{ route('zonas.store') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="nombre">Nombre</label>
                                            <input type="text" class="form-control rounded-md bg-white text-black"
                                                id="nombre" name="nombre" required maxlength="30">
                                        </div>
                                        <div class="form-group">
                                            <label for="mesas">Mesas</label>
                                            <input type="number" class="form-control rounded-md bg-white text-black"
                                                id="mesas" name="mesas" required>
                                        </div>
                                     

                                </div>
                                <div class="modal-footer">
                                    <x-boton-crear  onclick="mostrarCargando()" />


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



        {{-- Tabla zonas --}}
        <div class="card-body  rounded-none my-3">
            <table id="tabla_Datatables" class="table  table-striped table-hover ">
                <thead>
                    <tr>

                        <th>NOMBRE</th>
                        <th>Nº DE MESAS</th>
                        <th></th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($zonas as $zona)
                        <tr>

                            <td class="fw-bold text-xl align-middle">{{ $zona->nombre }}</td>
                            <td class="fw-bold text-xl align-middle">{{ $zona->mesas }}</td>

                            <td>
                                <div class="d-flex justify-end gap-4">
                                    <div>
                                        <!-- Button trigger modal Editar-->

                                        <x-boton-editar data-bs-toggle="modal"
                                            data-bs-target="#modalEditar{{ $zona->id }}" />

                                    </div>
                                    <div>
                                        <!-- Button trigger modal Eliminar-->
                                        <x-boton-eliminar data-bs-toggle="modal"
                                            data-bs-target="#modalEliminar{{ $zona->id }}" />



                                    </div>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal Editar-->

                        <div class="modal fade modal-fullscreen-sm-down" id="modalEditar{{ $zona->id }}"
                            tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
                            <div class="modal-dialog ">
                                <div class="modal-content w-auto">
                                    <div class="modal-header  bg-blue-600">
                                        <h1 class="modal-title fs-5 text-white" id="modalEditarLabel">
                                            Editar Zona
                                        </h1>
                                        @include('components.boton-cancelar-mini')
                                    </div>
                                    <div class="modal-body">

                                        <form action="{{ route('zonas.update', $zona->id) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label for="nombre">Nombre</label>
                                                <input type="text"
                                                    class="form-control  rounded-md bg-white text-black" id="nombre"
                                                    name="nombre" required maxlength="30" value="{{ $zona->nombre }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="mesas">Mesas</label>
                                                <input type="number"
                                                    class="form-control  rounded-md bg-white text-black" id="mesas"
                                                    name="mesas" required value="{{ $zona->mesas }}">
                                            </div>
                                          
                                    </div>
                                    <div class="modal-footer">
                                        <x-boton-editar  onclick="mostrarCargando()" />



                                        @include('components.boton-cancelar')


                                        </form>

                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Modal Eliminar-->
                        <div class="modal fade" id="modalEliminar{{ $zona->id }}" tabindex="-1"
                            aria-labelledby="modalEliminarLabel" aria-hidden="true">
                            <div class="modal-dialog ">
                                <div class="modal-content">
                                    <div class="modal-header  bg-red-600">
                                        <h1 class="modal-title fs-5 text-white">Eliminar Zona
                                        </h1>
                                        @include('components.boton-cancelar-mini')
                                    </div>
                                    <div class="modal-body text-center">
                                        <div>
                                            <p>¿Está seguro que desea eliminar la
                                                zona {{ $zona->nombre }} ?</p>

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('zonas.destroy', $zona->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="idzona" id="idzona"
                                                value="{{ $zona->id }}">

                                            <x-boton-eliminar  onclick="mostrarCargando()" />


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
