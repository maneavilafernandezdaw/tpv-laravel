<?php

namespace App\Http\Controllers;

use App\Models\Cobro;
use App\Models\Comanda;
use App\Models\Zona;
use App\Models\Producto;
use App\Models\Cliente;


use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use TCPDF;

class CobrosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {
            $cobros = Cobro::all();
            $zonas = Zona::all();
            $total = 0;
            foreach ($cobros as $cobro) {

                $total += $cobro->cantidad;
            }

            return view('cobros.index', compact('cobros', 'total', 'zonas'));
        }
        return view('welcome');
    }

    /**
     * Store a newly created resource in storage.
     */


    public function store(Request $request)
    {
        if (Auth::check()) {
            Cobro::create($request->all());

            $comandas = Comanda::where('mesa', $request->mesa)
                ->where('zona_id', $request->zona_id)->get();
                $total = 0;
                $subtotal=0;

            if (isset($request->cliente)) {
                $prod = Producto::all();
                $product = [];
                
                $cliente = Cliente::find($request->cliente);
                foreach ($comandas as $comanda) {
                    foreach ($prod as $producto) {
                        if ($comanda->producto_id === $producto->id) {
                            $total += $comanda->cantidad * $producto->precio;
                            $subtotal = $comanda->cantidad * $producto->precio;

                            array_push($product, ['nombre' => $producto->nombre, 'precio' => $producto->precio, 'subtotal' => $subtotal]);

                            $subtotal=0;
                        }
                    }
                }
                $data = [
                    'nombreCliente' => $cliente->nombre,
                    'cifCliente' => $cliente->cif,
                    'direccionCliente' => $cliente->direccion,
                    'emailCliente' => $cliente->email,
                    'productos' => $product,
                    'total' => $total
                ];

                $pdf = new TCPDF();
                $pdf->SetAutoPageBreak(true, 10);
                $pdf->AddPage();
                $pdf->writeHTML(view('facturas/factura', $data)->render());

                // Guarda el PDF en el servidor o envíalo directamente a la impresora
                $rutaPDF = public_path('facturas\factura.pdf');
                $pdf->Output($rutaPDF, 'F');


               
              
                $response = response()->download($rutaPDF, 'factura.pdf', [
                    'Content-Type' => 'application/pdf',
                ], );
             


            }

            foreach ($comandas as $comanda) {

                $comanda->delete();
            }

            return redirect()->route('home');
            return $response;

        }
        return view('welcome');
    }
}
