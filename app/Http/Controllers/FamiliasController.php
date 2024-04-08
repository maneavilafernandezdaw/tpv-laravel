<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Familia;
use Illuminate\Support\Facades\Auth;

class FamiliasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {
        $familias = Familia::all();

        return view('familias.index', compact('familias'));
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
            
          ]);

          $fam=Familia::where('nombre', $request->nombre)->first();
        
          // Si existe
          if(!$fam){
            Familia::create($request->all());
            return redirect()->route('familias.index')
              ->with('mensaje','Familia creada correctamente.');
          } else{
             
           
            return redirect()->route('familias.index')
              ->with('mensaje','Ya existe una Familia con ese nombre.');
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
           
        ]);

        $familia = Familia::find($id);
        $familia->update($request->all());

        return redirect()->route('familias.index')
            ->with('mensaje', 'Familia actualizada correctamente.');
        }
        return redirect()->route('welcome');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        
        if (Auth::check()) {
            try {
        $familia = Familia::where('id', $request->idfamilia);
        $familia->delete();

        return redirect()->route('familias.index')
            ->with('mensaje', 'Familia eliminada correctamente');
        } catch (\Exception $e) {
            //return "Error al eliminar esta familia: " . $e->getMessage();
            return redirect()->route('familias.index')
            ->with('mensaje', 'Esta familia no se ha podido eliminar, se está utilizando.' );
          
        }

        }
        return redirect()->route('welcome');
    }

    public function edit($id)
    {
        if (Auth::check()) {
        $familia = Familia::find($id);

        return view('familias.edit', compact('familia'));
    }
    return redirect()->route('welcome');
    }
}
