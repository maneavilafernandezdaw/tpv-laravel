<x-app-layout>
  
    <nav class="navbar navbar-expand-lg navbar-light ">
        <div class="container-fluid">
            <a class="navbar-brand text-2xl" href={{ route('home') }}><x-boton-inicio/></a>
            <h1 class=" h1">FAMILIAS</h1>
            <div class="justify-end ">
                <div class="col ">

                    <!-- Button trigger modal Crear-->
                  
                    <x-boton-crear data-bs-toggle="modal" data-bs-target="#modalCrear"/>
                       
                  
                    <!-- Modal Crear-->
                    <div class="modal fade " id="modalCrear" tabindex="-1" aria-labelledby="modalCrearLabel"
                        aria-hidden="true">
                        <div class="modal-dialog ">
                            <div class="modal-content">
                                <div class="modal-header  bg-green-600">
                                    <h1 class="modal-title fs-5 text-white" id="modalCrearLabel">Crear Familia</h1>
                                    @include('components.boton-cancelar-mini')
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
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="combinada" id="combinada" value="1">
                                            <label class="form-check-label" for="combinada">
                                                Combinada
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="combinada" id="combinada" value="0" checked>
                                            <label class="form-check-label" for="combinada">
                                                No combinada
                                            </label>
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




        <div class="card-body bg-gray-300 rounded-none my-3">
            <table id="tabla_Datatables" class="table  table-striped table-hover ">
                <thead>
                    <tr>

                        <th>NOMBRE</th>
                        <th>COMBINADA</th>
                        <th></th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($familias as $familia)
                        <tr>

                            <td class="fw-bold text-xl align-middle">{{ $familia->nombre }}</td>

                            @if ($familia->combinada)
                            <td class="fw-bold text-xl align-middle">Si</td>
                            @else
                            <td class="fw-bold text-xl align-middle">No</td>
                            @endif

                            <td>
                                <div class="d-flex justify-end gap-4">
                                    <div>
                                        <!-- Button trigger modal Editar-->
                                  
                                        <x-boton-editar data-bs-toggle="modal" data-bs-target="#modalEditar{{ $familia->id }}"/>
                                          
                                      
                                        <!-- Modal Editar-->
                                        <div class="modal fade" id="modalEditar{{ $familia->id }}" tabindex="-1"
                                            aria-labelledby="modalEditarLabel" aria-hidden="true">
                                            <div class="modal-dialog text-black">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-blue-600">
                                                        <h1 class="modal-title fs-5 text-white" id="modalEditarLabel">
                                                            Editar Familia
                                                        </h1>
                                                        @include('components.boton-cancelar-mini')
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
                                                            @if ($familia->combinada)
                                                            <div class="form-check">
                                                               
                                                                <input class="form-check-input" type="radio" name="combinada" id="combinada" value="1" checked>
                                                                <label class="form-check-label" for="combinada">
                                                                    Combinada
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="combinada" id="combinada" value="0" >
                                                                <label class="form-check-label" for="combinada">
                                                                    No combinada
                                                                </label>
                                                            </div>
                                                            @else
                                                            <div class="form-check">
                                                               
                                                                <input class="form-check-input" type="radio" name="combinada" id="combinada" value="1" >
                                                                <label class="form-check-label" for="combinada">
                                                                    Combinada
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="combinada" id="combinada" value="0" checked>
                                                                <label class="form-check-label" for="combinada">
                                                                    No combinada
                                                                </label>
                                                            </div>
                                                            @endif
                                        
                                                            <br>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <x-boton-editar/>
                                                             
                                                          

                                                            @include('components.boton-cancelar')


                                                        </form>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>




                                    </div>
                                    <div>
                                        <!-- Button trigger modal Eliminar-->
                                        <x-boton-eliminar data-bs-toggle="modal" data-bs-target="#modalEliminar{{ $familia->id }}"/>
                                       
                                        <!-- Modal Eliminar-->
                                        <div class="modal fade" id="modalEliminar{{ $familia->id }}" tabindex="-1"
                                            aria-labelledby="modalEliminarLabel" aria-hidden="true">
                                            <div class="modal-dialog text-black">
                                                <div class="modal-content">
                                                    <div class="modal-header  bg-red-600">
                                                        <h1 class="modal-title fs-5 text-white">Eliminar Familia
                                                        </h1>
                                                        @include('components.boton-cancelar-mini')
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
