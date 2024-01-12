<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Comanda;
use App\Models\Familia;
use App\Models\Producto;
use App\Models\Zona;

use Illuminate\Support\Facades\Auth;

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


    public function create($z, $m)
    {
        if (Auth::check()) {
            $mesa = $m;
            $zona = Zona::find($z);
            $productos = Producto::all()->where('familia_id', '!=', 1);
            $general = Producto::all()->where('familia_id', '=', 1);
            $familias = Familia::all();
            $comandas = Comanda::all()->where('mesa', $m)
                ->where('zona_id', $z)->where('estado', 'No enviado');

            return view('comandas.create', compact('zona', 'mesa', 'productos', 'general', 'familias', 'comandas'));
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



            return view('comandas.consultarCuenta', compact('zona', 'mesa', 'productos', 'comandas'));
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

                return redirect()->route('comandas.create', [$request->zona_id, $request->mesa]);
            } else {
                Comanda::create($request->all());
                return redirect()->route('comandas.create', [$request->zona_id, $request->mesa]);
            }
        }
        return view('welcome');
    }


    public function incrementar(Request $request)
    {
        if (Auth::check()) {
            $comanda = Comanda::find($request->comanda_id);
            $comanda->increment('cantidad');
            return redirect()->route('comandas.create', [$request->zona_id, $request->mesa]);
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
            return redirect()->route('comandas.create', [$request->zona_id, $request->mesa]);
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



            foreach ($comandas as $comanda) {
                $comanda->estado = 'Enviada';
                $comanda->save();
            }
            $zonas = Zona::all();
            $comandas=Comanda::all();

            return view('comandas.index', compact('zonas','comandas'))
                ->with('mensaje', 'Comanda Enviada Correctamente.');
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
            return redirect()->route('comandas.create', [$request->zona_id, $request->mesa])
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
