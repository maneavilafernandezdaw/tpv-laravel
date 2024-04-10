@php
    use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

    use Mike42\Escpos\Printer;
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon-->
    <x-favicon-logo />

    <title>TPV-Laravel</title>

</head>

<body class="bg">
    @php

        $json = json_decode(urldecode(request()->input('data')));

        $fecha = date('d-m-Y H:i:s');
  
        $usuario = $json[0]->usuario;
        $comandas = $json[0]->comandas;
        $zona = $json[0]->zona;
        $mesa = $json[0]->mesa;
        $total = 0;
        $subTotal = 0;

        try {
            $connector = new WindowsPrintConnector('tickets'); //  nombre de tu impresora

            $printer = new Printer($connector);

            // Contenido a imprimir
            $printer->text("Minibar     $fecha\n");
            $printer->text("De:  $usuario\n");
            $printer->text("\n");
            

            $printer->text("Zona: $zona   Mesa:  $mesa\n");
            $printer->text("\n");

            foreach ($comandas as $comanda) {
                $printer->text("$comanda->cantidad ");

             
                        $subTotal = $comanda->cantidad * $comanda->precio;
                        $subTotal = number_format($comanda->cantidad * $comanda->precio, 2, '.', '');
                        $total += $subTotal;

                        if ($comanda->refresco !== 'Solo') {
                            $printer->text("$comanda->nombre/$comanda->refresco $comanda->precio  $subTotal\n");
                        } else {
                            $printer->text("$comanda->nombre $comanda->precio  $subTotal\n");
                        }
                    }
                
            
            $total = number_format($total, 2, '.', '');
            $printer->text("\nTotal: $total \n");
            $printer->text("\n\n");
            $printer->text("\n\n");
            $printer->cut();
            $printer->close();
        } catch (\Exception $e) {
            return 'Error al imprimir: ' . $e->getMessage();
        }

        // Redirige a una página web específica

        if (isset($json[0]->app)){
            $paginaWeb = env('URL_REDIRECCIONAR_LOCAL');
        header("Location: $paginaWeb");
        exit();
        }else{
            $paginaWeb = env('URL_REDIRECCIONAR');
        header("Location: $paginaWeb");
        exit();
        }
      

    @endphp





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
</body>

</html>
