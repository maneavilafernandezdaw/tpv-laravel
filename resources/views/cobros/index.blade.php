<x-app-layout>

    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand text-2xl" href={{ route('home') }}> <x-boton-inicio /></a>
            <h1 class="h1">Cobros</h1>
            <div>
                <a href="{{ route('cajas.store') }}"><x-boton-cerrarCaja /></a>

            </div>
        </div>
    </nav>

    <div class="container mt-3 card rounded-none">
        <div class="card-body  rounded-none my-3">

            <h1 class=" h1">Total: {{ $total }}€</h1>

            {{-- Tabla Cobros --}}
            <table id="tabla_Datatables" class="table  table-striped table-hover ">
                <thead>

                    <tr>
                        <th>ID</th>
                        <th>ZONA</th>
                        <th>MESA</th>
                        <th>CANTIDAD</th>
                        <th>TIPO</th>
                        <th>Fecha/Hora</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cobros as $cobro)
                        <tr>
                            <td class="fw-bold text-xl align-middle">{{ $cobro->id }}</td>
                            <td class="fw-bold text-xl align-middle">
                                @foreach ($zonas as $zona)
                                    @if ($zona->id === $cobro->zona_id)
                                        {{ $zona->nombre }}
                                    @endif
                                @endforeach
                            </td>
                            <td class="fw-bold text-xl align-middle">{{ $cobro->mesa }}</td>
                            <td class="fw-bold text-xl align-middle">{{ $cobro->cantidad }}€</td>
                            <td class="fw-bold text-xl align-middle">{{ $cobro->tipo }}</td>
                            <td class="fw-bold text-xl align-middle">{{ $cobro->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</x-app-layout>
