<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Zona;

class ZonasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $zonas = Zona::all();

        return view('zonas.index', compact('zonas'));
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
            ->with('success','Zona creada correctamente.');
    }


    public function create()
    {
        return view('zonas.create');
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
            ->with('success', 'Zona actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
     
        $zona = Zona::where('id', $request->idzona);
        $zona->delete();

        return redirect()->route('zonas.index')
            ->with('success', 'Zona eliminada correctamente');
    }

    public function edit($id)
    {
        $zona = Zona::find($id);

        return view('zonas.edit', compact('zona'));
    }
}
