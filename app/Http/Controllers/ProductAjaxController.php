<?php
           
namespace App\Http\Controllers;
            
use App\Models\Producto;
use App\Models\Familia;
use Illuminate\Http\Request;
use DataTables;
          
class ProductAjaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Producto::all();
      $familias = Familia::all();
        if ($request->ajax()) {
  
           return  $data = Producto::latest()->get();
  
/*             return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';
   
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true); */
        }
        
        return view('productAjax',compact( 'data','familias'));
    }
       
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Producto::updateOrCreate([
                    'id' => $request->id
                ],
                [
                    'nombre' => $request->nombre, 
                    'descripcion' => $request->descripcion,
                    'familia_id' => $request->familia_id, 
                    'precio' => $request->precio,
                    'iva' => $request->iva, 
                    'imagen' => $request->imagen
          
                ]);        
     
        return response()->json(['mensaje'=>'Producto creado correctamente.']);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producto = Producto::find($id);
        return response()->json($producto);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Producto::find($id)->delete();
      
        return response()->json(['success'=>'Product deleted successfully.']);
    }
}