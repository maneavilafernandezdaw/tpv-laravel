<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Zona;
use App\Models\Comanda;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\text;

use Illuminate\Http\Response;

class ZonasController extends Controller
{



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {
            $zonas = Zona::all();

            return view('zonas.index', compact('zonas'));
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
            $comandas = Comanda::all();
            return view('zonas.show', compact('zona', 'comandas'));
        }
        return redirect()->route('welcome');
    }

    public function consultar($id)
    {

        if (Auth::check()) {
            $zona = Zona::find($id);
            $comandas = Comanda::all();
            return view('comandas.consultar', compact('zona', 'comandas'));
        }
        return redirect()->route('welcome');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::check()) {
        $request->validate([
            'nombre' => 'required|max:30',
            'mesas' => 'required',
        ]);

        $zon = Zona::where('nombre', $request->nombre)->first();

        // Si existe
        if (!$zon) {
            Zona::create($request->all());
            return redirect()->route('zonas.index')
                ->with('mensaje', 'Zona creada correctamente.');
        } else {

            return redirect()->route('zonas.index')
                ->with('mensaje', 'Existe una zona con ese nombre.');
        }
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if (Auth::check()) {
        $zona = Zona::where('id', $request->idzona);
        $zona->delete();

        return redirect()->route('zonas.index')
            ->with('mensaje', 'Zona eliminada correctamente');
        }
        return redirect()->route('welcome');
}




}