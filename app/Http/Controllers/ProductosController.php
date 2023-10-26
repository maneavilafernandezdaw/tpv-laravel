<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;
use App\Models\Familia;

class ProductosController extends Controller
{    /**
    * Display a listing of the resource.
    */
   public function index()
   {
       if (Auth::check()) {
       $productos = Producto::all();
       $familias = Familia::all();

       return view('productos.index', compact('productos', 'familias'));
   }
   return view('welcome');
   }

       /**
    * Display the specified resource.
    */
   public function show($id)
   {
       $producto = Producto::find($id);

       return view('productos.show', compact('producto'));
   }

   /**
    * Store a newly created resource in storage.
    */
   public function store(Request $request)
   {
       $request->validate([
           'nombre' => 'required|max:30',
           'descripcion'=>'max:300',
           'precio' => 'required',
           'iva' => 'required',
           'familia_id' => 'required',
           'imagen'
           
         ]);

         $producto = $request->all();

         if($imagen = $request->file('imagen')) {
            $rutaGuardarImg = 'imagen/';
            $imagenProducto = date('YmdHis').".".$imagen->getClientOriginalExtension();
            $imagen->move($rutaGuardarImg, $imagenProducto);
            $producto['imagen'] = $imagenProducto;
         }

         Producto::create($producto);

         return redirect()->route('productos.index')
           ->with('mensaje','Producto creado correctamente.');
   }


   /**
    * Update the specified resource in storage.
    */
   public function update(Request $request,  $id)
   {
       $request->validate([
        'nombre' => 'required|max:30',
        'descripcion'=>'max:300',
        'precio' => 'required',
        'iva' => 'required',
        'familia_id' => 'required'
       ]);

       $producto = Producto::find($id);
       $producto->update($request->all());

       return redirect()->route('productos.index')
           ->with('mensaje', 'Producto actualizado correctamente.');
   }

   /**
    * Remove the specified resource from storage.
    */
   public function destroy(Request $request)
   {
    
       $producto = Producto::where('id', $request->idproducto);
       $producto->delete();

       return redirect()->route('productos.index')
           ->with('mensaje', 'Producto eliminado correctamente');
   }


}

