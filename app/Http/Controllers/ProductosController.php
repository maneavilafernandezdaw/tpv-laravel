<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Familia;
use Psy\Readline\Hoa\Console;

use function Laravel\Prompts\alert;

class ProductosController extends Controller
{
    /**
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
        if (Auth::check()) {
            $producto = Producto::find($id);

            return view('productos.show', compact('producto'));
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
                'nombre' => 'required|max:30',
                'descripcion' => 'max:300',
                'precio' => 'required',
                'iva' => 'required',
                'familia_id' => 'required',


            ]);

            $prod = Producto::where('nombre', $request->nombre)->first();

            // Si existe
            if (!$prod) {


                $producto = $request->all();

                if ($request->file('imagen')) {
                    if ($imagen = $request->file('imagen')) {
                        $rutaGuardarImg = 'imagen/';
                        $imagenProducto = date('YmdHis') . "." . $imagen->getClientOriginalExtension();
                        $imagen->move($rutaGuardarImg, $imagenProducto);
                        $producto['imagen'] = $imagenProducto;
                    }
                }

                Producto::create($producto);

                return redirect()->route('productos.index')
                    ->with('mensaje', 'Producto creado correctamente.');
            } else {
                return redirect()->route('productos.index')
                    ->with('mensaje', 'Ya Existe un producto con ese nombre.');
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

            $prod = Producto::find($id);


            $producto = $request->all();

            if ($request->file('imagen')) {
                if ($imagen = $request->file('imagen')) {
                    $rutaGuardarImg = 'imagen/';
                    $imagenProducto = date('YmdHis') . "." . $imagen->getClientOriginalExtension();
                    $imagen->move($rutaGuardarImg, $imagenProducto);
                    $producto['imagen'] = $imagenProducto;
                }


                $prod->update($producto);

                return redirect()->route('productos.index')
                    ->with('mensaje', 'Producto creado correctamente.');
            } else {

                $producto['imagen'] = $prod->imagen;
                $prod->update($producto);

                return redirect()->route('productos.index')
                    ->with('mensaje', 'Producto actualizado correctamente.');
            }
        }
        return view('welcome');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if (Auth::check()) {
            $producto = Producto::where('id', $request->idproducto);
            $producto->delete();

            return redirect()->route('productos.index')
                ->with('mensaje', 'Producto eliminado correctamente');
        }
        return view('welcome');
    }
}
