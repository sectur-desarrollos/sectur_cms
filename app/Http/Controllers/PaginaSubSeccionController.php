<?php

namespace App\Http\Controllers;

use App\Models\Pagina;
use App\Models\PaginaSeccion;
use App\Models\PaginaSeccionSubseccion;
use Illuminate\Http\Request;
use App\Rules\Recaptcha;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Throwable;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;

class PaginaSubSeccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Pagina $pagina, PaginaSeccion $paginaSeccion)
    {
        $seccionSeleccionada = PaginaSeccion::findOrFail($paginaSeccion->id);
	//dd($seccionSeleccionada);
	session()->put('seccionSeleccionada',$seccionSeleccionada->id);
        session()->put('seccionSlugSeleccionada',$seccionSeleccionada->slug);

        if ($request->ajax()) {
            $data = PaginaSeccionSubseccion::orderBy('created_at', 'asc')
                                /*->where('seccion_id',   '=', $paginaSeccion->id)
                                ->where('seccion_slug', '=', $paginaSeccion->slug)
                                ->where('pagina_slug',  '=', $pagina->slug)*/
				//->where('seccion_id',   '=', session(''))
                                ->where('seccion_slug', '=', session('seccionSlugSeleccionada'))
                                ->where('pagina_slug',  '=', session('paginaSlugSeleccionada'))
                                ->orderBy('estado', 'ASC');
            return FacadesDataTables::of($data)
                    ->addColumn('btn', function(PaginaSeccionSubseccion $pagina_subseccion) {
                        $paginaSeccion = PaginaSeccion::find($pagina_subseccion->seccion_id);
                        $pagina = Pagina::find($paginaSeccion->pagina_id);
                        return view('paginas.subsecciones.actions', compact('pagina', 'paginaSeccion', 'pagina_subseccion'));
                    })
                    // ->rawColumns(['action'])
                    ->make(true);
        }

        // Session::put('paginaSeccionSelectedSlug', $paginaSeccion->slug);
        // Session::put('paginaSeccionSelectedId', $paginaSeccion->id);

        // $pagina = Pagina::findOrFail($paginaSeccion->pagina_id);

        // Session::put('pgSecId',$paginaSeccion->id);

        return view('paginas.subsecciones.index', compact('pagina', 'paginaSeccion'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Pagina $pagina, PaginaSeccion $paginaSeccion)
    {
        return view('paginas.subsecciones.create', compact('pagina','paginaSeccion'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Pagina $pagina, PaginaSeccion $paginaSeccion)
    {
        
        $datos = $request->all();

        $validated = $request->validate([
            'titulo'                 => 'required|string',
            'slug'                   => 'required',
            'estado'                 => 'required',
//            'g-recaptcha-response'   => ['required', new Recaptcha],
        ]);

         // Validando por segunda vez que el archivo pertenezca a un sección y a una página

	/* Fer movio ahorita
        $datos['seccion_id']   = $paginaSeccion->id;
        $datos['seccion_slug'] = $paginaSeccion->slug;
        $datos['pagina_slug']  = $pagina->slug;
	*/


	$pagina = Pagina::where('slug', session('paginaSlugSeleccionada'))->first();

	if ($pagina) {
	    $existeRelacion = $pagina->paginasSecciones->where('slug', session('seccionSlugSeleccionada'))->isNotEmpty();
		if ($existeRelacion) {
			$datos['pagina_slug']  = $pagina->slug;
		    }
	}

	$seccion = PaginaSeccion::where('slug', session('seccionSlugSeleccionada'))
				->where('pagina_id',$pagina->id)
				->first();
	if($seccion->pagina_id == $pagina->id){
	     $datos['seccion_id']   = $seccion->id;
	     $datos['seccion_slug'] = $seccion->slug;
	}



        PaginaSeccionSubseccion::create($datos);

        return redirect()->route('paginas.pagina-subseccion-index', [$pagina, $paginaSeccion])->with('success', 'Registro creado correctamente');
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pagina $pagina, PaginaSeccion $paginaSeccion, PaginaSeccionSubseccion $pagina_subseccion)
    {
        return view('paginas.subsecciones.edit', compact('pagina', 'paginaSeccion','pagina_subseccion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pagina $pagina, PaginaSeccion $paginaSeccion, PaginaSeccionSubseccion $pagina_subseccion)
    {
        
        $datos = $request->all();
        
        $validated = $request->validate([
            'titulo'                 => 'required|string',
            'slug'                   => 'required',
            'estado'                 => 'required',
            'g-recaptcha-response'   => ['required', new Recaptcha],
        ]);

        $pagina_subseccion->update($datos);
        
        return redirect()->route('paginas.pagina-subseccion-index', [$pagina, $paginaSeccion])->with('success', 'Registro actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pagina $pagina, PaginaSeccion $paginaSeccion, PaginaSeccionSubseccion $pagina_subseccion)
    {
        $pagina_subseccion->delete();
        
        return redirect()->route('paginas.pagina-subseccion-index', [$pagina, $paginaSeccion])->with('success', 'Registro eliminado correctamente');
    }

    // public function paginasSubSeccionesDatatables()
    // {
    //         return FacadesDataTables::eloquent(\App\Models\PaginaSeccionSubseccion::orderBy('created_at', 'asc')->whereSeccionId( Session::get('pgSecId')))
    //                                 ->addColumn('btn', function(PaginaSeccionSubseccion $paginaSubSeccion) {
    //                                     $seccion = PaginaSeccion::find($paginaSubSeccion->seccion_id);
    //                                     return view('paginas.subsecciones.actions', compact('paginaSubSeccion','seccion'));
    //                                 })
    //                                 ->rawColumns(['btn'])
    //                                 ->toJson();
    // }
}
