<?php

namespace App\Http\Controllers;

use App\Models\Pagina;
use App\Models\PaginaSeccion;
use App\Models\PaginaSeccionArchivo;
use App\Models\Repositorio;
use Illuminate\Http\Request;
use App\Rules\Recaptcha;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;

class PaginaSeccionArchivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Pagina $pagina, PaginaSeccion $paginaSeccion)
    {
	$seccionSeleccionada = PaginaSeccion::where('slug',session('seccionSlugSeleccionada'))
					->where('pagina_slug', session('paginaSlugSeleccionada'))
					->first();
	//dd($seccionSeleccionada);
	if($seccionSeleccionada == null)
	{
		session()->put('seccionSeleccionada',$paginaSeccion->id);
	        session()->put('seccionSlugSeleccionada',$paginaSeccion->slug);
	}else{
		session()->put('seccionSeleccionada',$seccionSeleccionada->id);
        	session()->put('seccionSlugSeleccionada',$seccionSeleccionada->slug);
	}

        if ($request->ajax()) {
            $data = PaginaSeccionArchivo::orderBy('created_at', 'asc')
                                ->where('seccion_id', '=', $seccionSeleccionada->id)
                                ->where('seccion_slug', '=', $seccionSeleccionada->slug)
                                ->where('pagina_slug', '=', $pagina->slug)
                                ->orderBy('estado', 'ASC');
            return FacadesDataTables::of($data)
                    ->addColumn('btn', function(PaginaSeccionArchivo $paginaSeccionArchivo) {
                        $paginaSeccion = PaginaSeccion::find($paginaSeccionArchivo->seccion_id);
                        $pagina = Pagina::find($paginaSeccion->pagina_id);
                        return view('paginas.secciones.archivos.actions', compact('paginaSeccionArchivo', 'paginaSeccion', 'pagina'));
                    })
                    // ->rawColumns(['action'])
                    ->make(true);
        }

        return view('paginas.secciones.archivos.index', compact('paginaSeccion','pagina'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Pagina $pagina, PaginaSeccion $paginaSeccion)
    {
        return view('paginas.secciones.archivos.create', compact('pagina','paginaSeccion'));
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
            'titulo'                => 'required|string',
            'archivo'               => 'sometimes|mimes:jpg,jpeg,png,doc,pdf,docx,xlsx,webp',
            'enlace'                => 'sometimes',
            'estado'                => 'required',
            'seccion_id'            => 'required',
            //'g-recaptcha-response'  => ['required', new Recaptcha],
        ]);

        if($request->hasFile('archivo')){

            // Nnombre del archivo (haciendola unica)
            $archivo = $request->file('archivo');
            $hora = Str::slug(date('h:i:s'),'_');
            $nombreArchivo = $hora.'_'.$archivo->getClientOriginalName();

            // Tipo de archivo (extension)
            $datos['tipo'] = $archivo->getClientOriginalExtension();

            // Tamaño de la imagen
            $archivonSize = $request->file('archivo')->getSize();
            $units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
            $power = $archivonSize > 0 ? floor(log($archivonSize, 1024)) : 0;
            $archivoSizeFinal = number_format($archivonSize / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];

            $datos['size_archivo'] = $archivoSizeFinal;
            
            // Guardando el archivo en el disco
            $datos['archivo'] = $request->file('archivo')->storeAs('uploads/paginas/secciones/archivos', $nombreArchivo, 'public');

            // Inicia el proceso para agregar al Modelo de Repositorio
            
            $repositorio          = new Repositorio();
            $repositorio->titulo  = $nombreArchivo;
            $repositorio->tipo    = $datos['tipo'];
            $repositorio->archivo = $request->file('archivo')->storeAs('uploads/repositorio/archivos', $nombreArchivo, 'public');
            $repositorio->save();

            // Finaliza el proceso para agregar al Modelo de Repositorio
        }

        // Validando por segunda vez que el archivo pertenezca a un sección y a una página

        //$datos['seccion_slug'] = $paginaSeccion->slug;
        //$datos['pagina_slug']  = $pagina->slug;


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
	     $datos['seccion_id'] = $seccion->id;
             $datos['seccion_slug']   = $seccion->slug;
             $datos['pagina_slug'] = $pagina->slug;
        }
	//dd($datos);

        // Se crea el registro de subir un archivo a una sección de una página
        PaginaSeccionArchivo::create($datos);

        // Actualizando la página al momento que se cargue un archivo
            // Obteniendo el id de la página dodne se encuentra la sección a la que se está subiendo el archivo
            // $pagSeccionId = PaginaSeccion::find($request->seccion_id,['pagina_id']);

            DB::table('paginas')
                ->where('id', $paginaSeccion->pagina_id)
                ->update([
                    'fuente'      => auth()->user()->roles->pluck("name")->first(),
                    'updated_at'  => now(),
                ]);
        // Actualizando la página al momento que se cargue un archivo

        return redirect()->route('paginas.seccion-archivos-index', [$pagina, $paginaSeccion])->with('success', 'Registro creado correctamente');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pagina $pagina, PaginaSeccion $paginaSeccion, PaginaSeccionArchivo $paginaSeccionArchivo)
    {
        return view('paginas.secciones.archivos.edit', compact('pagina', 'paginaSeccion', 'paginaSeccionArchivo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pagina $pagina, PaginaSeccion $paginaSeccion, PaginaSeccionArchivo $paginaSeccionArchivo)
    {
        
        $datos = $request->all();

        $paginaSeccionArchivo = PaginaSeccionArchivo::find($paginaSeccionArchivo->id);

        $validated = $request->validate([
            'titulo'                => 'required|string',
            'archivo'               => 'sometimes|mimes:jpg,jpeg,png,doc,pdf,docx,xlsx,webp',
            'enlace'                => 'sometimes',
            'estado'                => 'required',
            'seccion_id'            => 'required',
            //'g-recaptcha-response'  => ['required', new Recaptcha],
        ]);

        if($request->hasFile('archivo')){

                if(is_null($paginaSeccionArchivo->archivo)){
                    // Nombre del archivo (haciendola unica)
                    $archivo = $request->file('archivo');
                    $hora = Str::slug(date('h:i:s'),'_');
                    $nombreArchivo = $hora.'_'.$archivo->getClientOriginalName();

                    // Tipo de archivo (extension)
                    $datos['tipo'] = $archivo->getClientOriginalExtension();

                    // Tamaño de la imagen
                    $archivonSize = $request->file('archivo')->getSize();
                    $units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
                    $power = $archivonSize > 0 ? floor(log($archivonSize, 1024)) : 0;
                    $archivoSizeFinal = number_format($archivonSize / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];

                    $datos['size_archivo'] = $archivoSizeFinal;
                    
                    // Guardando el archivo en el disco
                    $datos['archivo'] = $request->file('archivo')->storeAs('uploads/paginas/secciones/archivos', $nombreArchivo, 'public');

                    // Inicia el proceso para agregar al Modelo de Repositorio
                    
                    $repositorio          = new Repositorio();
                    $repositorio->titulo  = $nombreArchivo;
                    $repositorio->tipo    = $datos['tipo'];
                    $repositorio->archivo = $request->file('archivo')->storeAs('uploads/repositorio/archivos', $nombreArchivo, 'public');
                    $repositorio->save();
                    // Finaliza el proceso para agregar al Modelo de Repositorio
                } elseif(Storage::exists($paginaSeccionArchivo->archivo)){
                
                // borrando la imagen del storage
                $paginaSeccionArchivo = PaginaSeccionArchivo::find($paginaSeccionArchivo->id);
                Storage::delete($paginaSeccionArchivo->archivo);

                // Nnombre de la imagen (haciendola unica)
                $archivo = $request->file('archivo');
                $hora = Str::slug(date('h:i:s'),'_');
                $nombreArchivo = $hora.'_'.$archivo->getClientOriginalName();

                // Tipo de archivo (extension)
                $datos['tipo'] = $archivo->getClientOriginalExtension();

                // Tamaño de la imagen
                $archivonSize = $request->file('archivo')->getSize();
                $units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
                $power = $archivonSize > 0 ? floor(log($archivonSize, 1024)) : 0;
                $archivoSizeFinal = number_format($archivonSize / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];

                $datos['size_archivo'] = $archivoSizeFinal;
                
                // Guardando la imagen en el disco
                $datos['archivo'] = $request->file('archivo')->storeAs('uploads/paginas/secciones/archivos', $nombreArchivo, 'public');
                
                // Inicia el proceso para agregar al Modelo de Repositorio
                
                $repositorio          = new Repositorio();
                $repositorio->titulo  = $nombreArchivo;
                $repositorio->tipo    = $datos['tipo'];
                $repositorio->archivo = $request->file('archivo')->storeAs('uploads/repositorio/archivos', $nombreArchivo, 'public');
                $repositorio->save();

                // Finaliza el proceso para agregar al Modelo de Repositorio
            }
        }

        // Actualizando el registro
        $paginaSeccionArchivo->update($datos);

         // Actualizando la página al momento que se cargue un archivo
            // Obteniendo el id de la página dodne se encuentra la sección a la que se está subiendo el archivo
            // $pagSeccionId = PaginaSeccion::find($request->seccion_id,['pagina_id']);


            DB::table('paginas')
                ->where('id', $pagina->id)
                ->update([
                    'fuente'      => auth()->user()->roles->pluck("name")->first(),
                    'updated_at'  => now(),
                ]);
        // Actualizando la página al momento que se cargue un archivo

        // Obteniendo el slug de la página para redirigir a la vista index por parámetro slug
        // $pagSeccionSlug = PaginaSeccion::find($request->seccion_id,['slug']);

        return redirect()->route('paginas.seccion-archivos-index', [$pagina, $paginaSeccion])->with('success', 'Registro actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pagina $pagina, PaginaSeccion $paginaSeccion, PaginaSeccionArchivo $paginaSeccionArchivo)
    {
        try {
            // Obteniendo el registro seleccionado por id
            $paginaSeccionArchivo = PaginaSeccionArchivo::find($paginaSeccionArchivo->id);

            // OBteniendo el archivo del registro a eliminar
            $archivo = $paginaSeccionArchivo->archivo;

            // Si existe un archivo en la sección se elimina el archivo del Storage y el registro general
            // Caso contrario, si la imagen es null (no hay iamgen), unicamente va a eliminar la sección
            if ($archivo){
                Storage::delete($archivo);
                PaginaSeccionArchivo::destroy($paginaSeccionArchivo->id);
            }
        
            return redirect()->route('paginas.seccion-archivos-index', [$pagina, $paginaSeccion])->with('success', 'Registro eliminado correctamente');
        } catch (\Throwable $th) {

            return redirect()->route('paginas.seccion-archivos-index', [$pagina, $paginaSeccion])->with('error',$th->getMessage());
        }
    }

    /**
     *  Función asíncrona que permite usar el datatables en el index
    */
    // public function paginasSeccionesArchivosDatatables()
    // {
    //         return FacadesDataTables::eloquent(\App\Models\PaginaSeccionArchivo::orderBy('created_at', 'asc')->whereSeccionId( Session::get('pgSecId')))
    //                                 ->addColumn('btn', function(PaginaSeccionArchivo $paginaSeccionArchivo) {
    //                                     return view('paginas.secciones.archivos.actions', compact('paginaSeccionArchivo'));
    //                                 })
    //                                 ->rawColumns(['btn'])
    //                                 ->toJson();
    // }
}
