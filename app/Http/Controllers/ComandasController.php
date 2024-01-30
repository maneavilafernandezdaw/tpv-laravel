<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Comanda;
use App\Models\Familia;
use App\Models\Producto;
use App\Models\Zona;
use App\Models\Cliente;

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
   





            return view('comandas.index', compact('zonas','comandas'));
        }
        return view('welcome');
    }

    public function cuenta()
    {
        if (Auth::check()) {
            $zonas = Zona::all();
            

            return view('comandas.cuenta', compact('zonas'));
        }
        return view('welcome');
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
        return view('welcome');
    }


    public function create($z, $m, $f)
    {
        if (Auth::check()) {
            $familia=$f;
            $mesa = $m;
            $zona = Zona::find($z);

            if($familia === "todo"){
                $productos = Producto::all();  
            }else{
                $productos = Producto::all()->where('familia_id', $familia);
            }
            
            $todosProductos = Producto::all();
            $familias = Familia::orderBy('nombre')->get();
            $comandas = Comanda::all()->where('mesa', $m)
                ->where('zona_id', $z)->where('estado', 'No enviado');

            return view('comandas.create', compact('zona', 'mesa', 'productos','todosProductos', 'familias', 'comandas','familia'));
        }
        return view('welcome');
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
        return view('welcome');
    }

    public function pedido($z, $m)
    {
        if (Auth::check()) {
            $mesa = $m;
            $zona = Zona::find($z);
            $productos = Producto::all();
            $familias = Familia::all();
            $comandas = Comanda::all()->where('mesa', $m)
                ->where('zona_id', $z)->where('estado', 'No enviado');

            return view('comandas.pedido', compact('zona', 'mesa', 'productos', 'familias', 'comandas'));
        }
        return view('welcome');
    }
    /**
     * Store a newly created resource in storage.
     *//*  */
    public function store(Request $request)
    {
        if (Auth::check()) {
            $comanda = Comanda::where('mesa', $request->mesa)
                ->where('zona_id', $request->zona_id)->where('estado', 'No enviado')->where('producto_id', $request->producto_id)->first();

            if ($comanda) {

                $comanda->increment('cantidad');

                return redirect()->route('comandas.create', [$request->zona_id, $request->mesa, $request->familia]);
            } else {
                Comanda::create($request->all());
                return redirect()->route('comandas.create', [$request->zona_id, $request->mesa,  $request->familia]);
            }
        }
        return view('welcome');
    }


    public function incrementar(Request $request)
    {
        if (Auth::check()) {
            $comanda = Comanda::find($request->comanda_id);
            $comanda->increment('cantidad');
            return redirect()->route('comandas.create', [$request->zona_id, $request->mesa,  $request->familia]);
        }
        return view('welcome');
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
        return view('welcome');
    }

    public function incrementarTabla(Request $request)
    {
        if (Auth::check()) {
            $comanda = Comanda::find($request->comanda_id);
            $comanda->increment('cantidad');
            return redirect()->route('comandas.pedido', [$request->zona_id, $request->mesa]);
        }
        return view('welcome');
    }

    public function decrementarTabla(Request $request)
    {
        if (Auth::check()) {
            $comanda = Comanda::find($request->comanda_id);
            $comanda->decrement('cantidad');
            if ($comanda->cantidad < 1) {
                $comanda->delete();
            }
            return redirect()->route('comandas.pedido', [$request->zona_id, $request->mesa]);
        }
        return view('welcome');
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
        return view('welcome');
    }

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
                   /*  $impresoras= ['tickets', 'cocina']; */

                    foreach ($impresoras as $impresora) {
                  $existenProductos=0;
                        foreach ($comandas as $comanda){
                            foreach ($productos as $producto){
                                if($producto->impresora === $impresora)  {
                                            
                               
                                    if ($producto->id === $comanda->producto_id){
                                       $existenProductos = 1;
                                       break;
                                    }
                                  }
                            }

                        }

                        if($existenProductos === 1){

                     
               
                        try {
                            $connector = new WindowsPrintConnector($impresora); //  nombre de impresora
                          
                            $printer = new Printer($connector);
                    
                            // Contenido a imprimir
                            $printer->text("Minibar     $fecha\n");
                            $printer->text("\n");
                            $printer->text("Mesa: $request->mesa Zona: $zona->nombre\n");
                            $printer->text("\n");
                        
          
                            foreach ($comandas as $comanda){

                                
        
                             
                                  
                                        foreach ($productos as $producto){

                                          if($producto->impresora === $impresora)  {
                                            
                               
                                            if ($producto->id === $comanda->producto_id){
                                                $printer->text("$comanda->cantidad ");
                                                $printer->text("$producto->nombre\n");
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
                                 $comanda->save();}
        
        
                           
        
                        } catch (\Exception $e) {
                            return "Error al imprimir: " . $e->getMessage();
                        }}
                    }
                    return view('comandas.index', compact('zonas','comandas'))
                    ->with('mensaje', 'Comanda Enviada Correctamente.');
    
                } catch (\Exception $e) {
                    
                    return response()->json(['error' => $e->getMessage()], 500);
                }
              
        
            }
         
            return view('welcome');
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
                    $total=0;
                    $subTotal=0;
                    try {
                        $connector = new WindowsPrintConnector("tickets"); //  nombre de tu impresora
                      
                        $printer = new Printer($connector);
                
                        // Contenido a imprimir
                        $printer->text("Minibar     $fecha\n");
                        $printer->text("\n");
                        $printer->text("\n");
                      
                        $printer->text("Mesa: $request->mesa Zona: $zona->nombre\n");
                        $printer->text("\n");
                    
      
                        foreach ($comandas as $comanda){
    
                            $printer->text("$comanda->cantidad ");
                         
                              
                                    foreach ($productos as $producto){
                                        if ($producto->id === $comanda->producto_id){
                                            $subTotal = $comanda->cantidad*$producto->precio;
                                            $subTotal = number_format($comanda->cantidad*$producto->precio, 2, '.', '');
                                            $total +=   $subTotal;
                                            $printer->text("$producto->nombre $producto->precio  $subTotal\n");
                                        }
                                    
                               
                            }
                        }
                        $total = number_format($total, 2, '.', '');
                        $printer->text("\nTotal: $total \n");
                        $printer->text("\n\n");
                        $printer->text("\n\n");
                        $printer->cut();
                        $printer->close();
    
                        return view('comandas.consultarCuenta', compact('zona', 'mesa', 'productos', 'comandas', 'clientes'));
                       
                
    
                    } catch (\Exception $e) {
                        return "Error al imprimir: " . $e->getMessage();
                    }
    
            
                }
             
                return view('welcome');
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
        return view('welcome');
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
        return view('welcome');
    }
}
