<?php

namespace App\Http\Controllers;

use App\Models\Cobro;
use App\Models\Comanda;
use App\Models\Zona;
use App\Models\Producto;
use App\Models\Cliente;
use App\Models\Factura;

use App\Mail\ReportMail;

use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

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


            foreach ($comandas as $comanda) {

                $comanda->delete();
            }

            return view('home');
        }
        return view('welcome');
    }

    public function descargar(Request $request)
    {
        if (Auth::check()) {


            $comandas = Comanda::where('mesa', $request->mesa)
                ->where('zona_id', $request->zona_id)->get();
            $total = 0;
            $subtotal = 0;
            $numeroFactura = 0;


            if (isset($request->cliente)) {
                $prod = Producto::all();
                $product = [];

                $cliente = Cliente::find($request->cliente);
                $nombreFactura = $cliente->nombre . "_" . date('d_m_Y_H_i') . ".pdf";

            
                

                $factura = new Factura();
                $factura->nombre = $nombreFactura;
                $factura->cliente_id = $cliente->id;
              
                $factura->save();

                $numeroFactura = $factura->id;

                foreach ($comandas as $comanda) {
                    foreach ($prod as $producto) {
                        if ($comanda->producto_id === $producto->id) {
                            $total += $comanda->cantidad * $producto->precio;
                            $subtotal = $comanda->cantidad * $producto->precio;

                            array_push($product, ['nombre' => $producto->nombre,'cantidad' => $comanda->cantidad, 'precio' => $producto->precio, 'subtotal' => $subtotal]);

                            $subtotal = 0;
                        }
                    }
                }
                $data = [
                    'numeroFactura' => $factura->id,
                    'nombreCliente' => $cliente->nombre,
                    'cifCliente' => $cliente->cif,
                    'direccionCliente' => $cliente->direccion,
                    'emailCliente' => $cliente->email,
                    'productos' => $product,
                    'total' => $total,
                ];


                $pdf = new TCPDF();
                $pdf->SetAutoPageBreak(true, 10);
                $pdf->AddPage();
                $pdf->writeHTML(view('facturas/factura', $data)->render());

                // Guarda el PDF en el servidor y envíalo directamente email
                $rutaPDF = public_path('facturas/' . $nombreFactura);
                $pdf->Output($rutaPDF, 'F');

                /*  $pdfPath = public_path('facturas/factura.pdf'); // Ruta al archivo PDF */
                $data = [
                    'subject' => "Factura Minibar",
                    'content' => "Descarga el archivo.",
                    'file' =>  $nombreFactura,

                ];

                Mail::to($cliente->email)->send(new ReportMail($data));



                $response = response()->download($rutaPDF, 'factura.pdf', [
                    'Content-Type' => 'application/pdf',
                ],);

                return $response;
            }
        }
        return view('welcome');
    }
}
