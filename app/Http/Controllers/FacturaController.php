<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Factura;

use Illuminate\Support\Facades\Auth;

class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {
  
            $facturas = Factura::orderBy('id', 'desc')->get();

            return view('facturas.index', compact('facturas'));
        }
        return view('welcome');
    }

   
}
