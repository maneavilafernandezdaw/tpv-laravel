<x-app-layout>

    <nav class="navbar flex flex-row justify-center">
        <div class=" flex flex-row justify-center items-center">
            <a class="navbar-brand text-2xl" href={{ route('home') }}> <x-boton-inicio></x-boton-inicio></a>
            <h1 class=" h1">Usuarios</h1>
            
        </div>
    </nav>

    {{-- session mensaje  --}}
    @include('partials.session-mensaje')

    <div class="container mt-3 card rounded-none">




        <div class="card-body rounded-none my-3">
            <table id="tabla_Datatables" class="table  table-striped table-hover ">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NOMBRE</th>
                        <th>Email</th>
                        <th>Tipo</th>
                        <th></th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios as $usuario)
                        <tr>
                            <td class="fw-bold text-xl align-middle">{{ $usuario->id }}</td>
                            <td class="fw-bold text-xl align-middle">{{ $usuario->name }}</td>
                            <td class="fw-bold text-xl align-middle">{{ $usuario->email }}</td>
                            <td class="fw-bold text-xl align-middle">
                                @if($usuario->admin && $usuario->super)
                                Super/Admin 
                               @elseif(!$usuario->admin && $usuario->super)
                               Super
                                @elseif($usuario->admin && !$usuario->super)
                                Admin
                                @elseif(!$usuario->admin && !$usuario->super)
                               Camarero
                                @endif
                                
                            
                            </td>

                            <td>
                                <div class="d-flex justify-end gap-4">

                                    <div>
                                        <!-- Button trigger modal Eliminar-->
                                        <x-boton-eliminar data-bs-toggle="modal" data-bs-target="#modalEliminar{{ $usuario->id }}"/>
                                        
                                        <!-- Modal Eliminar-->
                                        <div class="modal fade" id="modalEliminar{{ $usuario->id }}" tabindex="-1"
                                            aria-labelledby="modalEliminarLabel" aria-hidden="true">
                                            <div class="modal-dialog ">
                                                <div class="modal-content">
                                                    <div class="modal-header  bg-red-600">
                                                        <h1 class="modal-title fs-5 text-white">Eliminar Usuario
                                                        </h1>

                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <div>
                                                            <p>¿Está seguro que desea eliminar el
                                                                usuario {{ $usuario->nombre }} ?</p>

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="{{ route('profile.eliminar', $usuario->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="hidden" name="idusuario" id="idusuario"
                                                                value="{{ $usuario->id }}">
                                                           
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
