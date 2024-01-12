<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ClientesController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {
        $clientes = Cliente::all();

        return view('clientes.index', compact('clientes'));
    }
    return view('welcome');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::check()) {
        $request->validate([
            'cif' => 'required',
            'nombre' => 'required',
            'direccion' => 'required',
            'email' => 'required',
            
          ]);

          $cli=Cliente::where('cif', $request->cif)->first();
        
          // Si existe
          if(!$cli){
            Cliente::create($request->all());
            return redirect()->route('clientes.index')
              ->with('mensaje','Cliente creado correctamente.');
          } else{
             
           
            return redirect()->route('clientes.index')
              ->with('mensaje','Ya existe un cliente con ese cif o nif.');
          }
  
        }
        return view('welcome');
          

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        if (Auth::check()) {


        $cliente = Cliente::find($id);
        $cliente->update($request->all());

        return redirect()->route('clientes.index')
            ->with('mensaje', 'Cliente actualizado correctamente.');
        }
        return view('welcome');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if (Auth::check()) {
        $cliente = Cliente::where('id', $request->idcliente);
        $cliente->delete();

        return redirect()->route('clientes.index')
            ->with('mensaje', 'Cliente eliminado correctamente');
        }
        return view('welcome');
    }

    public function edit($id)
    {
        if (Auth::check()) {
        $cliente = Cliente::find($id);

        return view('clientes.edit', compact('cliente'));
    }
    return view('welcome');
    }
}
