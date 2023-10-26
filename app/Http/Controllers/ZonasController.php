<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Zona;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\text;

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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:30',
            'mesas' => 'required',
          ]);
          Zona::create($request->all());
          return redirect()->route('zonas.index')
            ->with('mensaje','Zona creada correctamente.');
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
