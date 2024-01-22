<x-app-layout>

    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand text-2xl" href={{ route('home') }}> <x-boton-admin>Inicio</x-boton-admin> </a>
            <h1 class="h1">Facturas</h1>

        </div>
    </nav>

    <div class="container mt-3 card rounded-none">
        <div class="card-body bg-gray-300 rounded-none my-3">
         
            <table id="tabla_Datatables" class="table  table-striped table-hover ">
                <thead>

                    <tr>

                        <th>Nº FACTURA</th>
                        <th>NOMBRE</th>
                        <th>CLIENTE</th>
                        <th>Fecha/Hora</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($facturas as $factura)
                        <tr>
                            <td class="fw-bold text-xl align-middle">
                   
                            <td class="fw-bold text-xl align-middle">{{ $factura->id }}</td>
                            <td class="fw-bold text-xl align-middle">{{ $factura->nombre }}€</td>
                            <td class="fw-bold text-xl align-middle">{{ $factura->cliente_id }}</td>
                            <td class="fw-bold text-xl align-middle">{{ $factura->created_at }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

</x-app-layout>

