<x-app-layout>

    <nav class="navbar navbar-expand-lg navbar-light ">
        <div class="container-fluid relative">
            <a class="navbar-brand text-2xl" href={{ route('home') }}><x-boton-inicio/></a>
            <h1 class=" h1">Cajas</h1>
          <div class="w-40"></div>
        </div>
    </nav>

  {{-- session mensaje  --}}
  @include('partials.session-mensaje')

    <div class="container mt-3 card rounded-none">
        <div class="card-body rounded-none my-3">
           {{-- tabla Cajas --}}
            <table id="tabla_Datatables" class="table  table-striped table-hover ">
                <thead>

                    <tr>
                        <th>ID</th>
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
                            <td class="fw-bold text-xl align-middle">{{ $caja->id}}</td>
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
