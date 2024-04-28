<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Zona;

use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;



class ZonasAjaxController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::check()) {
            if ($request->ajax()) {
                $data = Zona::all();
                return Datatables::of($data)->addIndexColumn()
                    ->addColumn('action', function ($data) {
                        $button = ' <div class="flex justify-end gap-2"><div>';
                        $button .= '   <button type="button" name="edit" id="' . $data->id . '" class="edit text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-4xl px-2.5 py-2.5 text-center me-2 mb-2 uppercase">';
                        $button .= '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">';
                        $button .= ' <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>';
                        $button .= ' <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>';
                        $button .= '</svg></button>';
                        $button .= '</div><div>';
                        $button .= '<button type="button" name="edit" id="' . $data->id . '" class="delete text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-4xl px-2.5 py-2.5 text-center me-2 mb-2">';
                        $button .= '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">';
                        $button .= '<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>';
                        $button .= '<path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>';
                        $button .= '</svg></button>';
                        $button .= '</div></div>';

                        return $button;
                    })
                    ->make(true);
            }

            return view('zonas.indexAjax');
        }
        return redirect()->route('welcome');
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::check()) {
            $request->validate([
                'nombre' => 'required|max:30',
                'mesas' => 'required',
            ]);

            $zon = Zona::where('nombre', $request->nombre)->first();

            // Si existe
            if (!$zon) {
                $form_data = array(
                    'nombre'    =>  $request->nombre,
                    'mesas'     =>  $request->mesas,

                );
             
            
                Zona::create($form_data);

                return response()->json(['success' => 'Zona agregada correctamente.']);
            } else {
                return response()->json(['success' => 'Ya existe una zona con este nombre.']);
            }
        }
        return redirect()->route('welcome');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (request()->ajax()) {
            $data = $zona = Zona::find($id);;
            return response()->json(['result' => $data]);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (Auth::check()) {
            $request->validate([
                'nombre' => 'required|max:30',
                'mesas' => 'required',
            ]);

            $zon = Zona::where('nombre', $request->nombre)->where('id', '!=', $request->hidden_id)->first();

            // Si existe
            if (!$zon) {
                $form_data = array(
                    'nombre'    =>  $request->nombre,
                    'mesas'     =>  $request->mesas,

                );

                Zona::whereId($request->hidden_id)->update($form_data);

                return response()->json(['success' => 'Zona actualizada']);
            } else {
                return response()->json(['success' => 'Ya existe una zona con este nombre.']);
            }
        }
        return redirect()->route('welcome');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::check()) {
            try {
                $zona = Zona::where('id', $id);
                $zona->delete();
                return response()->json(['success' => 'Zona eliminada.']);
            } catch (\Exception $e) {
                return response()->json(['success' => 'Esta zona no se ha podido eliminar, se está utilizando.']);
            }
        }
        return redirect()->route('welcome');
    }
}
