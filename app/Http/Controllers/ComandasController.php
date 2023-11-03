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

        return view('comandas.index', compact('zonas'));
    }
    return view('welcome');
    }

        /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $zona = Zona::find($id);

        return view('zonas.show', compact('zona'));
    }


    public function create($z, $m)
    {
        $mesa=$m;
        $zona = Zona::find($z);
        $productos = Producto::all();
        $familias = Familia::all();

        return view('comandas.create', compact('zona','mesa','productos','familias'));
    }
    /**
     * Store a newly created resource in storage.
     *//*  */
    public function store(/* Request $request */)
    {
    /*     $request->validate([
            'nombre' => 'required|max:30',
            'mesas' => 'required',
          ]);
          Comanda::create($request->all()); */
          return redirect()->route('comandas.create');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $request->validate([
            'nombre' => 'required|max:30',
            'mesas' => 'required',
        ]);

        $zona = Zona::find($id);
        $zona->update($request->all());

        return redirect()->route('zonas.index')
            ->with('mensaje', 'Zona actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
     
        $zona = Zona::where('id', $request->idzona);
        $zona->delete();

        return redirect()->route('zonas.index')
            ->with('mensaje', 'Zona eliminada correctamente');
    }


}
