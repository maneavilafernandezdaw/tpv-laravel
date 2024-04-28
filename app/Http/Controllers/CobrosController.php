<?php

namespace App\Http\Controllers;

use App\Models\Cobro;
use App\Models\Comanda;
use App\Models\Zona;


use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;



class CobrosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (Auth::check()) {
            $cobros = Cobro::all();
            $zonas = Zona::all();
            $total = 0;
            foreach ($cobros as $cobro) {

                $total += $cobro->cantidad;
            }
            if ($request->ajax()) {
                $data = Cobro::all();
            

                return Datatables::of($data)->addIndexColumn()->make(true);
            }
            return view('cobros.index', compact( 'total', 'zonas'));
        }
        return redirect()->route('welcome');
    }



    /**
     * Store a newly created resource in storage.
     */


    public function store(Request $request)
    {
        if (Auth::check()) {
            Cobro::create($request->all());

            $comandas = Comanda::where('mesa', $request->mesa)
                ->where('zona_id', $request->zona_id)->get();

            $zonas = Zona::all();

            foreach ($comandas as $comanda) {

                $comanda->delete();
            }

            return redirect()->route('comandas.index', compact('zonas', 'comandas'))
            ->with('mensaje', 'Cobro Realizado Correctamente.');
         
        }
        return redirect()->route('welcome');
    }

   
}
