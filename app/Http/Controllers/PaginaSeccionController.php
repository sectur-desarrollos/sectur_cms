<?php

namespace App\Http\Controllers;

use App\Models\Pagina;
use Illuminate\Http\Request;
use App\Models\PaginaSeccion;
use App\Rules\Recaptcha;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Throwable;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;

class PaginaSeccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Pagina $pagina)
    {

	$paginaSeleccionada =  Pagina::findOrFail($pagina->id);
	session()->put('paginaSeleccionada',$paginaSeleccionada->id);
	session()->put('paginaSlugSeleccionada',$paginaSeleccionada->slug);

        if ($request->ajax()) {
            $data = PaginaSeccion::orderBy('created_at', 'asc')
                                ->where('pagina_id', '=', $pagina->id)
                                ->where('pagina_slug', '=', $pagina->slug)
                                ->orderBy('estado', 'ASC');
            return FacadesDataTables::of($data)
                    ->addColumn('btn', function(PaginaSeccion $paginaSeccion) {
                        $pagina = Pagina::find($paginaSeccion->pagina_id);
                        return view('paginas.secciones.actions', compact('paginaSeccion', 'pagina'));
                    })
                    // ->rawColumns(['action'])
                    ->make(true);
        }

        return view('paginas.secciones.index', compact('pagina'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Pagina $pagina)
    {
        return view('paginas.secciones.create', compact('pagina'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Pagina $pagina)
    {
        $datos = $request->all();

        $validated = $request->validate([
            'titulo'                 => 'required|string',
            'slug'                   => 'required',
            'pagina_id'              => 'required|numeric',
            'estado'                 => 'required',
//            'g-recaptcha-response'   => ['required', new Recaptcha],
        ]);

        //almacenando el nombre del slug en el campo de la tabla del registro
        $datos['pagina_slug'] = $pagina->slug;

        PaginaSeccion::create($datos);

        return redirect()->route('paginas.pagina-seccion-index', $pagina)->with('success', 'Registro creado correctamente');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pagina $pagina, PaginaSeccion $paginaSeccion)
    {
        return view('paginas.secciones.edit', compact('paginaSeccion','pagina'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pagina $pagina, PaginaSeccion $paginaSeccion)
    {
        $datos = $request->all();

        $validated = $request->validate([
            'titulo'                 => 'required|string',
            'slug'                   => 'required',
            'pagina_id'              => 'required|numeric',
            'estado'                 => 'required',
            //'g-recaptcha-response'   => ['required', new Recaptcha],
        ]);
        
        //almacenando el nombre del slug en el campo de la tabla del registro
        $datos['pagina_slug'] = $pagina->slug;
        
        $paginaSeccion->update($datos);

        return redirect()->route('paginas.pagina-seccion-index', $pagina)->with('success', 'Registro actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pagina $pagina, PaginaSeccion $paginaSeccion)
    {
        $paginaSeccion->delete();
        return redirect()->route('paginas.pagina-seccion-index', $pagina)->with('success', 'Registro eliminado correctamente');
    }

    /**
     *  Función asíncrona que permite usar el datatables en el index
    */
    // public function paginasSeccionesDatatables()
    // {
        
    //         return FacadesDataTables::eloquent(\App\Models\PaginaSeccion::orderBy('created_at', 'asc')->wherePaginaId( Session::get('pgId') ))
    //                                 ->addColumn('btn', function(PaginaSeccion $paginaSeccion) {
    //                                     return view('paginas.secciones.actions', compact('paginaSeccion'));
    //                                 })
    //                                 ->rawColumns(['btn'])
    //                                 ->toJson();
    // }
}
