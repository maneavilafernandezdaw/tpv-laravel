<x-app-layout>

    <nav class="navbar navbar-expand-lg navbar-light bg-gray-800">
        <div class="container-fluid">
            <a class="navbar-brand h1 text-white" href={{ route('home') }}>Inicio</a>
            <h1 class="text-white h1 ">CREAR COMANDA</h1>
        </div>
    </nav>

    {{-- session mensaje  --}}
    @include('partials.session-mensaje')

    <div class="container mt-3 card bg-gray-700 rounded-none">




        <div class="card-body bg-gray-300 rounded-none my-3 d-flex gap-2 justify-center">

            @foreach ($zonas as $zona)
                <a href="{{ route('zonas.show', $zona->id) }}">
                    <div class="card rounded-none">
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
