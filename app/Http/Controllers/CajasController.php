<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Caja;
use Illuminate\Support\Facades\Auth;
use App\Models\Cobro;


class CajasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {
            $cajas = Caja::all();
            $cobros = Cobro::all();
            $total = 0;
            foreach ($cobros as $cobro) {

                $total += $cobro->cantidad;
            }

            return view('cajas.index', compact('cajas'));
        }
        return view('welcome');
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

            return view('cajas.index', compact('cajas')) ->with('mensaje', 'Caja creada correctamente');;
        }
        return view('welcome');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
