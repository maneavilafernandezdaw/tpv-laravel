<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Comanda;
use App\Models\Familia;
use App\Models\Producto;
use App\Models\Zona;
use App\Models\Cliente;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

use Mike42\Escpos\Printer;


class ComandasController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {
            $zonas = Zona::all();
            $comandas = Comanda::all();






            return view('comandas.index', compact('zonas', 'comandas'));
        }
        return view('welcome');
    }

    public function cuenta()
    {
        if (Auth::check()) {
            $zonas = Zona::all();


            return view('comandas.cuenta', compact('zonas'));
        }
        return redirect()->route('welcome');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        if (Auth::check()) {
            $zona = Zona::find($id);

            return view('zonas.show', compact('zona'));
        }
        return redirect()->route('welcome');
    }


    public function create($z, $m, $f)
    {
        if (Auth::check()) {
            $familia = $f;
            $mesa = $m;
            $zona = Zona::find($z);
            $refrescos = Producto::where('familia_id', 2)->orderBy('nombre', 'asc')->get();

            if ($familia === "todo") {
                $productos = Producto::orderBy('nombre', 'asc')->get();
            } else {
                $productos = Producto::where('familia_id', $familia)->orderBy('nombre', 'asc')->get();
            }

            $todosProductos = Producto::all();
            $familias = Familia::orderBy('nombre')->get();
            $comandas = Comanda::all()->where('mesa', $m)
                ->where('zona_id', $z)->where('estado', 'No enviado');

            return view('comandas.create', compact('zona', 'mesa', 'productos', 'todosProductos', 'familias', 'comandas', 'familia', 'refrescos'));
        }
        
        return redirect()->route('welcome');
    }



    public function consultarCuenta($z, $m)
    {
        if (Auth::check()) {
            $mesa = $m;
            $zona = Zona::find($z);
            $productos = Producto::all();
            $comandas = Comanda::all()->where('mesa', $m)
                ->where('zona_id', $z)->where('estado', 'Enviada');
            $clientes = Cliente::all();


            return view('comandas.consultarCuenta', compact('zona', 'mesa', 'productos', 'comandas', 'clientes'));
        }
        return redirect()->route('welcome');
    }

    public function pedido($z, $m, $f)
    {
        if (Auth::check()) {


            $familia = $f;
            $mesa = $m;
            $zona = Zona::find($z);
            $refrescos = Producto::where('familia_id', 2)->orderBy('nombre', 'asc')->get();

            if ($familia === "todo") {
                $productos = Producto::orderBy('nombre', 'asc')->get();
            } else {
                $productos = Producto::where('familia_id', $familia)->orderBy('nombre', 'asc')->get();
            }

            $todosProductos = Producto::all();
            $familias = Familia::orderBy('nombre')->get();
            $comandas = Comanda::all()->where('mesa', $m)
                ->where('zona_id', $z)->where('estado', 'No enviado');

            return view('comandas.pedido', compact('zona', 'mesa', 'productos', 'todosProductos', 'familias', 'comandas', 'familia', 'refrescos'));
        }
        return redirect()->route('welcome');
    }
    /**
     * Store a newly created resource in storage.
     *//*  */
    public function store(Request $request)
    {
        if (Auth::check()) {

            $comanda = Comanda::where('mesa', $request->mesa)
                ->where('zona_id', $request->zona_id)->where('estado', 'No enviado')->where('producto_id', $request->producto_id)->where('refresco', $request->refresco)->first();

            if ($comanda) {

                $comanda->increment('cantidad');

                return redirect()->route('comandas.create', [$request->zona_id, $request->mesa, $request->familia]);
            } else {
                Comanda::create($request->all());
                return redirect()->route('comandas.create', [$request->zona_id, $request->mesa,  $request->familia]);
            }
        }
        return redirect()->route('welcome');
    }


    public function incrementar(Request $request)
    {
        if (Auth::check()) {
            $comanda = Comanda::find($request->comanda_id);
            $comanda->increment('cantidad');
            return redirect()->route('comandas.create', [$request->zona_id, $request->mesa,  $request->familia]);
        }
        return redirect()->route('welcome');
    }

    public function decrementar(Request $request)
    {
        if (Auth::check()) {
            $comanda = Comanda::find($request->comanda_id);
            $comanda->decrement('cantidad');
            if ($comanda->cantidad < 1) {
                $comanda->delete();
            }
            return redirect()->route('comandas.create', [$request->zona_id, $request->mesa,  $request->familia]);
        }
        return redirect()->route('welcome');
    }

    public function incrementarTabla(Request $request)
    {
        if (Auth::check()) {
            $comanda = Comanda::find($request->comanda_id);
            $comanda->increment('cantidad');
            return redirect()->route('comandas.pedido', [$request->zona_id, $request->mesa,  $request->familia]);
        }
        return redirect()->route('welcome');
    }

    public function decrementarTabla(Request $request)
    {
        if (Auth::check()) {
            $comanda = Comanda::find($request->comanda_id);
            $comanda->decrement('cantidad');
            if ($comanda->cantidad < 1) {
                $comanda->delete();
            }
            return redirect()->route('comandas.pedido', [$request->zona_id, $request->mesa,  $request->familia]);
        }
        return redirect()->route('welcome');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        if (Auth::check()) {
            $request->validate([
                'nombre' => 'required|max:30',
                'mesas' => 'required',
            ]);

            $zona = Zona::find($id);
            $zona->update($request->all());

            return redirect()->route('zonas.index')
                ->with('mensaje', 'Zona actualizada correctamente.');
        }
        return redirect()->route('welcome');
    }


    // enviar y imprimirCuenta se utiliza para imprimir en local
       public function enviar(Request $request)
    {
        if (Auth::check()) {

            $comandas = Comanda::where('mesa', $request->mesa)
                ->where('zona_id', $request->zona_id)->where('estado', 'No enviado')->get();
            $zona = Zona::find($request->zona_id);
            $productos = Producto::all();
            $zonas = Zona::all();
            $fecha = date("d-m-Y h:i:s");

            try {

                  $wmi = new \COM('winmgmts:{impersonationLevel=impersonate}//./root/cimv2');
                    $printers = $wmi->ExecQuery('SELECT * FROM Win32_Printer');
        
                    $impresoras = [];
                    foreach ($printers as $printer) {
                        $impresoras[] = $printer->Name;
                    }
                $impresoras = ['tickets', 'cocina'];

                foreach ($impresoras as $impresora) {
                    $existenProductos = 0;
                    foreach ($comandas as $comanda) {
                        foreach ($productos as $producto) {
                            if ($producto->impresora === $impresora) {


                                if ($producto->id === $comanda->producto_id) {
                                    $existenProductos = 1;
                                    break;
                                }
                            }
                        }
                    }

                    if ($existenProductos === 1) {



                        try {
                            $connector = new WindowsPrintConnector($impresora); //  nombre de impresora

                            $printer = new Printer($connector);

                            // Contenido a imprimir
                            $printer->text("Minibar     $fecha\n");
                            $printer->text("\n");
                            $printer->text("Mesa: $request->mesa Zona: $zona->nombre\n");
                            $printer->text("\n");



                            foreach ($comandas as $comanda) {





                                foreach ($productos as $producto) {

                                    if ($producto->impresora === $impresora) {


                                        if ($producto->id === $comanda->producto_id) {
                                            $printer->text("$comanda->cantidad ");

                                            if ($comanda->refresco !== "Solo") {
                                                $printer->text("$producto->nombre / $comanda->refresco\n");
                                            } else {
                                                $printer->text("$producto->nombre\n");
                                            }
                                        }
                                    }
                                }
                            }
                            $printer->text("\n\n");
                            $printer->text("\n\n");
                            $printer->cut();
                            $printer->close(); 

                          
 
                            foreach ($comandas as $comanda) {
                                $comanda->estado = 'Enviada';
                                $comanda->save();
                            }
                         } catch (\Exception $e) {
                            return "Error al imprimir: " . $e->getMessage();
                        } 
                    
                    }
              
                }

                return redirect()->route('comandas.index', compact('zonas', 'comandas'))
                ->with('mensaje', 'Comanda Enviada Correctamente.');
            } catch (\Exception $e) {

                return response()->json(['error' => $e->getMessage()], 500);
            }
        
        }
        return redirect()->route('welcome');
    } 

    public function imprimirCuenta(Request $request)
    {
        if (Auth::check()) {

            $comandas = Comanda::where('mesa', $request->mesa)
                ->where('zona_id', $request->zona_id)->where('estado', 'Enviada')->get();
            $mesa = $request->mesa;
            $zona = Zona::find($request->zona_id);
            $productos = Producto::all();
            $clientes = Cliente::all();
            $zonas = Zona::all();
            $fecha = date("d-m-Y h:i:s");
            $total = 0;
            $subTotal = 0;
            try {
                $connector = new WindowsPrintConnector("tickets"); //  nombre de tu impresora

                $printer = new Printer($connector);

                // Contenido a imprimir
                $printer->text("Minibar     $fecha\n");
                $printer->text("\n");
                $printer->text("\n");

                $printer->text("Mesa: $request->mesa Zona: $zona->nombre\n");
                $printer->text("\n");


                foreach ($comandas as $comanda) {

                    $printer->text("$comanda->cantidad ");


                    foreach ($productos as $producto) {
                        if ($producto->id === $comanda->producto_id) {
                            $subTotal = $comanda->cantidad * $comanda->precio;
                            $subTotal = number_format($comanda->cantidad * $comanda->precio, 2, '.', '');
                            $total +=   $subTotal;


                            if ($comanda->refresco !== "Solo") {
                                $printer->text("$producto->nombre/$comanda->refresco $comanda->precio  $subTotal\n");
                            } else {
                                $printer->text("$producto->nombre $comanda->precio  $subTotal\n");
                            }
                        }
                    }
                }
                $total = number_format($total, 2, '.', '');
                $printer->text("\nTotal: $total \n");
                $printer->text("\n\n");
                $printer->text("\n\n");
                $printer->cut();
                $printer->close();

                return redirect()->route('comandas.consultarCuenta', compact('zona', 'mesa', 'productos', 'comandas', 'clientes'))
                  ->with('mensaje', 'Cuenta Impresa Correctamente.');
            } catch (\Exception $e) {
                return "Error al imprimir: " . $e->getMessage();
            }
        }

        return redirect()->route('welcome');
    }



    public function eliminarComanda(Request $request)
    {
        if (Auth::check()) {

            $comandas = Comanda::where('mesa', $request->mesa)
                ->where('zona_id', $request->zona_id)->where('estado', 'No enviado')->get();



            foreach ($comandas as $comanda) {

                $comanda->delete();
            }
            $zonas = Zona::all();
            return redirect()->route('comandas.create', [$request->zona_id, $request->mesa, "todo"])
                ->with('mensaje', 'Comanda Eliminada Correctamente.');
        }
        return redirect()->route('welcome');
    }

    public function eliminarCuenta(Request $request)
    {
        if (Auth::check()) {

            $comandas = Comanda::where('mesa', $request->mesa)
                ->where('zona_id', $request->zona_id)->get();



            foreach ($comandas as $comanda) {

                $comanda->delete();
            }
            return view('home');
        }
        return redirect()->route('welcome');
    }


    // ticket y ticketCuenta se utiliza para imprimir desde el servidor
    public function ticket($z, $m)
    {
        if (Auth::check()) {
        $comandas = Comanda::where('mesa', $m)
            ->where('zona_id', $z)->where('estado', 'No enviado')->get();

      $productos = Producto::all();
       $comand = [];
      $mesa = $m;
      
      foreach ($comandas as  $comanda) {
        foreach ($productos as $producto) {
        if($comanda->producto_id === $producto->id){
          
   
          $comand[]=["cantidad"=>$comanda->cantidad,
                   "nombre"=>$producto->nombre,
                     "refresco" => $comanda->refresco,
                    "impresora"=>$producto->impresora];
          
          
          $com = Comanda::where('mesa', $m)->where('zona_id', $z)->where('estado', 'Enviada')->where('producto_id', $comanda->producto_id)->where('refresco', $comanda->refresco)->first();

            if ($com) {

                $com->cantidad += $comanda->cantidad;
				$com->save();
                $comanda->delete();
            } else {
                $comanda->estado = 'Enviada';
            	$comanda->save();
            }
          
          
          

        }
        }
      }
       $datos = [
            "comandas" => $comand,
            "zona" => Zona::find($z)->nombre,
            "mesa" => $mesa
        ];

      
		$json = json_encode([$datos]);

    	return redirect()->away('http://192.168.100.100/tpv-laravel/public/impticket?data=' . $json); 
    }
    return redirect()->route('welcome');
    }


    public function ticketCuenta($z, $m)
    {
        if (Auth::check()) {
        $comandas = Comanda::where('mesa', $m)
            ->where('zona_id', $z)->where('estado', 'Enviada')->get();

      $productos = Producto::all();
      $comand = [];
      
      
      foreach ($comandas as  $comanda) {
        foreach ($productos as $producto) {
        if($comanda->producto_id === $producto->id){
          
          $comand[]=["cantidad"=>$comanda->cantidad,
                   "nombre"=>$producto->nombre,
                   "refresco" => $comanda->refresco,
                   "precio" => $comanda->precio];
        }
        }
      }
       $datos = [
            "comandas" => $comand,
            "zona" => Zona::find($z)->nombre,
            "mesa" => $m
        ];

    	$json = json_encode([$datos]);
      
		return redirect()->away('http://192.168.100.100/tpv-laravel/public/impcuenta?data=' . $json); 
    }
    return redirect()->route('welcome');
    }
    

}
