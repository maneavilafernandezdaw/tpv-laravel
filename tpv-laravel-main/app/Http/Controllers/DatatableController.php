<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Zona;

class DatatableController extends Controller
{
    public function zonas(){
        return datatables()->of(Zona::all())->toJson();
    }
}
