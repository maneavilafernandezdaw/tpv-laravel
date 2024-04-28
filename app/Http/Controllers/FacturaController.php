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
use Yajra\DataTables\DataTables;
use TCPDF;



class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (Auth::check()) {
  
          
            if ($request->ajax()) {
                $data = Factura::orderBy('id', 'desc')->get();
           
                return Datatables::of($data)->addIndexColumn()
                    ->addColumn('action', function ($data) {
                        $button = '<a target="_blank" href="facturas/'.$data->nombre.'"><button type="submit" class="text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-xl px-3 py-2.5 text-center me-2 mb-2 uppercase">pdf</button></a>';
                    

                        return $button;
                    })
                    ->make(true);
            }

            return view('facturas.index');
        }
        return redirect()->route('welcome');
    }

    public function descargar(Request $request)
    {
        if (Auth::check()) {


            $comandas = Comanda::where('mesa', $request->mesa)
                ->where('zona_id', $request->zona_id)->get();
            $total = 0;
            $subtotal = 0;
            $numeroFactura = 0;
            $nombreProducto ='';


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

                            $total += $comanda->cantidad * $comanda->precio;
                            $subtotal = $comanda->cantidad * $comanda->precio;
                          
                            $subtotal = number_format($subtotal, 2, '.', '');


                            $nombreProducto = $producto->nombre;
                            if ($comanda->refresco !== 'Solo'){
                                $nombreProducto = $producto->nombre . ' / '. $comanda->refresco;
                            }
                
                
                            array_push($product, ['nombre' => $nombreProducto,'cantidad' => $comanda->cantidad, 'precio' => $comanda->precio, 'subtotal' => $subtotal]);

                            $subtotal = 0;
                        }
                    }
                }
           
                $total = number_format($total, 2, '.', '');
       

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
        return redirect()->route('welcome');
    }
   
}
