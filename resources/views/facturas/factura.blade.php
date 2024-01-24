<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TPV-Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg">

    @php
        $fechaFactura = date('d-m-Y H:i:s');
    @endphp



    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center">Factura</h2>

                        <p>Nº factura: {{ $numeroFactura }}</p>
                        <p>Fecha: {{ $fechaFactura }}</p>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-bordered">

                                <thead>
                                    <tr>

                                        <th>De:</th>
                                        <th>Para:</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td>
                                            Nombre: Minibar<br>
                                            Cif/Nif: 2334253424F<br>
                                            Dirección: Sevilla, 45, Utrera(Sevilla)<br>
                                            Email minibar@minibar.com<br>
                                        </td>
                                       
                                        <td>
                                            Nombre: {{ $nombreCliente }}<br>
                                            Cif/Nif: {{ $cifCliente }}<br>
                                            Dirección: {{ $direccionCliente }}<br>
                                            Email: {{ $emailCliente }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <hr>

                        <div class="table-responsive">
                            <table class="table table-bordered">

                                <thead>
                                    <tr>
                                        <th><u>Producto</u></th>
                                        <th><u>Cantidad</u></th>
                                        <th><u>Precio</u></th>
                                        <th><u>Total</u></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($productos as $producto)
                                        <tr>
                                            <td>{{ $producto['nombre'] }}</td>
                                            <td>{{ $producto['cantidad'] }}</td>
                                            <td>{{ $producto['precio'] }}€</td>
                                            <td>{{ $producto['subtotal'] }}€</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>

                        <div class="row">
                            <div class="col-md-6">

                            </div>
                            <div class="col-md-6">
                                <table class="table">
                                    <tbody>

                                        <tr>

                                            <td> </td>
                                            <td> </td>
                                            <td> </td>
                                            <td><strong>Total: {{ $total }}€</strong></td>



                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- script bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous">
    </script>
    {{-- script jquery --}}
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>

</body>

</html>
