<x-app-layout>

 

    <div class="container-fluid">
        <h1 class="text-center h1 mt-3">CONSULTAR CUENTA</h1>
               
    </div>
    <nav class="navbar navbar-expand-lg navbar-light bg-primary-subtle">
        <div class="container-fluid">
            <a class="navbar-brand text-2xl" href={{ route('home') }}>Inicio</a>
       
        </div>
    </nav>

    {{-- session mensaje  --}}
    @include('partials.session-mensaje')



    <div class="container mt-3 card rounded-none">

        <h1 class="h1 text-center mt-3">ZONAS</h1>


        <div class="card-body  my-3 d-flex gap-3 flex-wrap justify-center">

            @foreach ($zonas as $zona)
                <a href="{{ route('zonas.consultar', $zona->id) }}">
                    <div class="card border border-primary border-2 ">
                        <div class="card-body  text-center">
                            <h3 class="card-title fw-bold text-xl">{{ $zona->nombre }}</h3>
                            <h5>Nº de mesas:</h5>
                            <h5 class="card-title text-xl">{{ $zona->mesas }}</h5>
                        </div>
                    </div>
                </a>
            @endforeach

            </tbody>
            </table>
        </div>
    </div>

</x-app-layout>
