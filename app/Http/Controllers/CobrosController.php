<?php

namespace App\Http\Controllers;

use App\Models\Cobro;
use App\Models\Comanda;
use App\Models\Zona;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CobrosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {
            $cobros = Cobro::all();
            $zonas = Zona::all();
            $total = 0;
            foreach ($cobros as $cobro) {

                $total += $cobro->cantidad;
            }

            return view('cobros.index', compact('cobros', 'total', 'zonas'));
        }
        return view('welcome');
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



            foreach ($comandas as $comanda) {

                $comanda->delete();
            }

            return view('home');
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
