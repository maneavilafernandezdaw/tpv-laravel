<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Caja;
use Illuminate\Support\Facades\Auth;
use App\Models\Cobro;
use Yajra\DataTables\DataTables;

class CajasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (Auth::check()) {
           

            if ($request->ajax()) {

                $data = Caja::all();
          
                return Datatables::of($data)->addIndexColumn()->make(true);
            }

            return view('cajas.index');
        }
        return redirect()->route('welcome');
    }

    /**
     * Store a newly created resource in storage.
     */


    public function store()
    {
        if (Auth::check()) {

            $cobros = Cobro::all();
            $efectivo = 0;
            $tarjeta = 0;
            $bizum = 0;
            $total = 0;

            foreach ($cobros as $cobro) {
                if ($cobro->tipo == 'Efectivo') {
                    $efectivo += $cobro->cantidad;
                }
                if ($cobro->tipo == 'Tarjeta') {
                    $tarjeta += $cobro->cantidad;
                }
                if ($cobro->tipo == 'Bizum') {
                    $bizum += $cobro->cantidad;
                }

                $cobro->delete();
            }
            $total = $efectivo + $tarjeta + $bizum;

            $caja = new Caja();
            $caja->efectivo = $efectivo;
            $caja->bizum = $bizum;
            $caja->tarjeta = $tarjeta;
            $caja->total = $total;
            $caja->save();

            $cajas = Caja::all();

            return view('cajas.index') ->with('mensaje', 'Caja creada correctamente');;
        }
        return redirect()->route('welcome');
    }


}
