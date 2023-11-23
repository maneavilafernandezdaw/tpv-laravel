<x-app-layout>

    <nav class="navbar navbar-expand-lg navbar-light bg-gray-800">
        <div class="container-fluid">
            <a class="navbar-brand text-2xl text-white" href={{ route('home') }}>Inicio</a>
            <h1 class="text-white h1">Cajas</h1>
            <div></div>
        </div>
    </nav>

  {{-- session mensaje  --}}
  @include('partials.session-mensaje')

    <div class="container mt-3 card bg-gray-700 rounded-none">
        <div class="card-body bg-gray-300 rounded-none my-3">
           
            <table id="tabla_Datatables" class="table  table-striped table-hover ">
                <thead>

                    <tr>

                        <th>FECHA/HORA</th>
                        <th>EFECTIVO</th>
                        <th>TARJETA</th>
                        <th>BIZUM</th>
                        <th>TOTAL</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($cajas as $caja)
                        <tr>
                   
                            <td class="fw-bold text-xl align-middle">{{ $caja->created_at }}</td>
                            <td class="fw-bold text-xl align-middle">{{ $caja->efectivo }}€</td>
                            <td class="fw-bold text-xl align-middle">{{ $caja->tarjeta }}€</td>
                            <td class="fw-bold text-xl align-middle">{{ $caja->bizum }}€</td>
                            <td class="fw-bold text-xl align-middle">{{ $caja->total }}€</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

</x-app-layout>
