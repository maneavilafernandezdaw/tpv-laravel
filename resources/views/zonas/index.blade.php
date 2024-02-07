<x-app-layout>

    <nav class="navbar navbar-expand-lg navbar-light ">
        <div class="container-fluid">
            <a class="navbar-brand text-2xl" href={{ route('home') }}> <x-boton-inicio></x-boton-inicio></a>
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
                                            <input type="text" class="form-control rounded-md" id="nombre"
                                                name="nombre" required maxlength="30" >
                                        </div>
                                        <div class="form-group">
                                            <label for="mesas">Mesas</label>
                                            <input type="number" class="form-control rounded-md" id="mesas"
                                                name="mesas" required>
                                        </div>
                                        <br>

                                    </div>
                                    <div class="modal-footer">
                                        <x-boton-crear/>
                                        

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
                                  
                                        <x-boton-editar data-bs-toggle="modal" data-bs-target="#modalEditar{{ $zona->id }}"/>
                                            
                                       
                                        <!-- Modal Editar-->
                                
                                        <div class="modal fade " id="modalEditar{{ $zona->id }}" tabindex="-1"
                                            aria-labelledby="modalEditarLabel" aria-hidden="true">
                                            <div class="modal-dialog  text-black">
                                                <div class="modal-content w-auto">
                                                    <div class="modal-header  bg-blue-600">
                                                        <h1 class="modal-title fs-5 text-white" id="modalEditarLabel">
                                                            Editar Zona
                                                        </h1>
                                                        @include('components.boton-cancelar-mini')
                                                    </div>
                                                    <div class="modal-body">

                                                        <form action="{{ route('zonas.update', $zona->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group">
                                                                <label for="nombre">Nombre</label>
                                                                <input type="text" class="form-control  rounded-md"
                                                                    id="nombre" name="nombre" required
                                                                    maxlength="30" value="{{ $zona->nombre }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="mesas">Mesas</label>
                                                                <input type="number" class="form-control  rounded-md"
                                                                    id="mesas" name="mesas" required
                                                                    value="{{ $zona->mesas }}">
                                                            </div>
                                                            <br>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <x-boton-editar>
                                                               
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
                                        <x-boton-eliminar data-bs-toggle="modal" data-bs-target="#modalEliminar{{ $zona->id }}"/>
                                        
                                        <!-- Modal Eliminar-->
                                        <div class="modal fade" id="modalEliminar{{ $zona->id }}" tabindex="-1"
                                            aria-labelledby="modalEliminarLabel" aria-hidden="true">
                                            <div class="modal-dialog text-black">
                                                <div class="modal-content">
                                                    <div class="modal-header  bg-red-600">
                                                        <h1 class="modal-title fs-5 text-white">Eliminar Zona
                                                        </h1>
                                                        @include('components.boton-cancelar-mini')
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
                                                            </div>
                                                            <div class="modal-footer">
                                                                <x-boton-eliminar/>
                                                                

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
