<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Familia;

class FamiliasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $familias = Familia::all();

        return view('familias.index', compact('familias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:30',
            
          ]);
          Familia::create($request->all());
          return redirect()->route('familias.index')
            ->with('success','Familia creada correctamente.');
    }


    public function create()
    {
        return view('familias.create');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $familia = Familia::find($id);

        return view('familias.show', compact('familia'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $request->validate([
            'nombre' => 'required|max:30',
           
        ]);

        $familia = Familia::find($id);
        $familia->update($request->all());

        return redirect()->route('familias.index')
            ->with('success', 'Familia actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
     
        $familia = Familia::where('id', $request->idfamilia);
        $familia->delete();

        return redirect()->route('familias.index')
            ->with('success', 'Familia eliminada correctamente');
    }

    public function edit($id)
    {
        $familia = Familia::find($id);

        return view('familias.edit', compact('familia'));
    }
}
