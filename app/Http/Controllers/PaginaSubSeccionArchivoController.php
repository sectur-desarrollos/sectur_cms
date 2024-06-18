<?php

namespace App\Http\Controllers;

use App\Models\PaginaSeccion;
use App\Models\PaginaSeccionSubseccion;
use App\Models\PaginaSeccionSubseccionArchivo;
use App\Models\Repositorio;
use App\Models\Pagina;
use Illuminate\Http\Request;
use App\Rules\Recaptcha;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;

class PaginaSubSeccionArchivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Pagina $pagina, PaginaSeccion $paginaSeccion, PaginaSeccionSubseccion $pagina_subseccion)
    {
        //dd($pagina_subseccion->id);
	//dd(session()->all());
	//dd(session('paginaSelect'));
	//dd($pagina,$paginaSeccion,$pagina_subseccion);
	$subSeccionSeleccionada = PaginaSeccionSubseccion::findOrFail($pagina_subseccion->id);
	session()->put('subSeccionSeleccionada',$subSeccionSeleccionada->id);
	session()->put('subSeccionSlugSeleccionada',$subSeccionSeleccionada->slug);

        if ($request->ajax()) {
            $data = PaginaSeccionSubseccionArchivo::where('pagina_slug',        '=', $pagina->slug)
                                                    ->where('seccion_slug',     '=', $paginaSeccion->slug)
                                                    ->where('subseccion_slug',  '=', $pagina_subseccion->slug)
                                                    ->orderBy('estado', 'ASC');
            return FacadesDataTables::of($data)
                    ->addColumn('btn', function(PaginaSeccionSubseccionArchivo $pagina_subseccion_archivo)use($pagina,$paginaSeccion, $pagina_subseccion) {
                        // $pagina_subseccion = PaginaSeccionSubseccion::find($pagina_subseccion_archivo->subseccion_id);
                        // $paginaSeccion = PaginaSeccion::find($pagina_subseccion->seccion_id);
                        // $pagina = Pagina::find($paginaSeccion->pagina_id);
                        return view('paginas.subsecciones.archivos.actions', compact('pagina', 'paginaSeccion', 'pagina_subseccion','pagina_subseccion_archivo'));
                    })
                    // ->rawColumns(['action'])
                    ->make(true);
        }
        return view('paginas.subsecciones.archivos.index', compact('pagina','paginaSeccion', 'pagina_subseccion'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Pagina $pagina, PaginaSeccion $paginaSeccion, PaginaSeccionSubseccion $pagina_subseccion)
    {
        return view('paginas.subsecciones.archivos.create', compact('pagina','paginaSeccion', 'pagina_subseccion'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Pagina $pagina, PaginaSeccion $paginaSeccion, PaginaSeccionSubseccion $pagina_subseccion)
    {
        $datos = $request->all();

        $validated = $request->validate([
            'titulo'                    => 'required|string',
            'archivo'                   => 'sometimes|mimes:jpg,jpeg,png,doc,pdf,docx,xlsx,webp',
            'enlace'                    => 'sometimes',
            'estado'                    => 'required',
            'subseccion_id'             => 'required',
            'subseccion_slug'           => 'required',
            'seccion_slug'              => 'required',
            'pagina_slug'               => 'required',
//            'g-recaptcha-response'      => ['required', new Recaptcha],
        ]);

        // dd($pagina_subseccion->id);

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
            $datos['archivo'] = $request->file('archivo')->storeAs('uploads/paginas/subsecciones/archivos', $nombreArchivo, 'public');

            // Inicia el proceso para agregar al Modelo de Repositorio
            
            $repositorio          = new Repositorio();
            $repositorio->titulo  = $nombreArchivo;
            $repositorio->tipo    = $datos['tipo'];
            $repositorio->archivo = $request->file('archivo')->storeAs('uploads/repositorio/archivos', $nombreArchivo, 'public');
            $repositorio->save();

            // Finaliza el proceso para agregar al Modelo de Repositorio
        }

        $datos['subseccion_id']   = /* $pagina_subseccion->id; */ $request->subseccion_id;
        $datos['subseccion_slug'] = /* $pagina_subseccion->slug; */ $request->subseccion_slug;
        $datos['seccion_slug']    = /* $paginaSeccion->slug; */ $request->seccion_slug;
        $datos['pagina_slug']     = /* $pagina->slug; */ $request->pagina_slug;

        PaginaSeccionSubseccionArchivo::create($datos);

        // Actualizando la página al momento que se cargue un archivo
            // Obteniendo el id de la página dodne se encuentra la sección a la que se está subiendo el archivo
            // $pagSubSeccionId = PaginaSeccionSubseccion::find($request->subseccion_id,['seccion_id']);
            // $pagSeccionId = PaginaSeccion::find($pagSubSeccionId->seccion_id,['pagina_id']);
            // dd($pagSeccionId);

            DB::table('paginas')
                ->where('id', $pagina->id)
                ->update([
                    'fuente'      => auth()->user()->roles->pluck("name")->first(),
                    'updated_at'  => now(),
                ]);
        // Actualizando la página al momento que se cargue un archivo

        // Obteniendo el slug de la página para redirigir a la vista index por parámetro slug
        // $pagSubSeccionSlug = PaginaSeccionSubseccion::find($request->subseccion_id,['slug']);

        return redirect()->route('paginas.subseccion-archivos-index', [$pagina, $paginaSeccion, $pagina_subseccion])->with('success', 'Registro creado correctamente');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pagina $pagina, PaginaSeccion $paginaSeccion, PaginaSeccionSubseccion $pagina_subseccion, PaginaSeccionSubseccionArchivo $pagina_subseccion_archivo)
    {
        return view('paginas.subsecciones.archivos.edit', compact('pagina', 'paginaSeccion', 'pagina_subseccion', 'pagina_subseccion_archivo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pagina $pagina, PaginaSeccion $paginaSeccion, PaginaSeccionSubseccion $pagina_subseccion, PaginaSeccionSubseccionArchivo $pagina_subseccion_archivo)
    {
        $datos = $request->all();

        $paginaSubSeccionArchivo = PaginaSeccionSubseccionArchivo::find($pagina_subseccion_archivo->id);

        $validated = $request->validate([
            'titulo'                    => 'required|string',
            'archivo'                   => 'sometimes|mimes:jpg,jpeg,png,doc,pdf,docx,xlsx,webp',
            'enlace'                    => 'sometimes',
            'estado'                    => 'required',
            'g-recaptcha-response'      => ['required', new Recaptcha],
        ]);

        if($request->hasFile('archivo')){

                if(is_null($paginaSubSeccionArchivo->archivo)){
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
                    $datos['archivo'] = $request->file('archivo')->storeAs('uploads/paginas/subsecciones/archivos', $nombreArchivo, 'public');

                    // Inicia el proceso para agregar al Modelo de Repositorio
                    
                    $repositorio          = new Repositorio();
                    $repositorio->titulo  = $nombreArchivo;
                    $repositorio->tipo    = $datos['tipo'];
                    $repositorio->archivo = $request->file('archivo')->storeAs('uploads/repositorio/archivos', $nombreArchivo, 'public');
                    $repositorio->save();
                    // Finaliza el proceso para agregar al Modelo de Repositorio
                } elseif(Storage::exists($paginaSubSeccionArchivo->archivo)){
                
                // borrando la imagen del storage
                $paginaSubSeccionArchivo = PaginaSeccionSubseccionArchivo::find($pagina_subseccion_archivo->id);
                Storage::delete($paginaSubSeccionArchivo->archivo);

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
                $datos['archivo'] = $request->file('archivo')->storeAs('uploads/paginas/subsecciones/archivos', $nombreArchivo, 'public');
                
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
        $paginaSubSeccionArchivo->update($datos);

        // Actualizando la página al momento que se cargue un archivo
            // Obteniendo el id de la página dodne se encuentra la sección a la que se está subiendo el archivo
            // $pagSubSeccionId = PaginaSeccionSubseccion::find($request->subseccion_id,['seccion_id']);
            // $pagSeccionId = PaginaSeccion::find($pagSubSeccionId->seccion_id,['pagina_id']);
            // dd($pagSeccionId);

            DB::table('paginas')
                ->where('id', $pagina->id)
                ->update([
                    'fuente'      => auth()->user()->roles->pluck("name")->first(),
                    'updated_at'  => now(),
                ]);
      // Actualizando la página al momento que se cargue un archivo

        // Obteniendo el slug de la página para redirigir a la vista index por parámetro slug
        // $pagSubSeccionSlug = PaginaSeccionSubseccion::find($request->subseccion_id,['slug']);

        return redirect()->route('paginas.subseccion-archivos-index', [$pagina, $paginaSeccion, $pagina_subseccion])->with('success', 'Registro actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pagina $pagina, PaginaSeccion $paginaSeccion, PaginaSeccionSubseccion $pagina_subseccion, PaginaSeccionSubseccionArchivo $pagina_subseccion_archivo)
    {
        try {
            // Obteniendo el registro seleccionado por id
            $paginaSubSeccionArchivo = PaginaSeccionSubseccionArchivo::find($pagina_subseccion_archivo->id);

            // OBteniendo el archivo del registro a eliminar
            $archivo = $paginaSubSeccionArchivo->archivo;

            // Si existe un archivo en la sección se elimina el archivo del Storage y el registro general
            // Caso contrario, si la imagen es null (no hay iamgen), unicamente va a eliminar la sección
            if ($archivo){
                Storage::delete($archivo);
                PaginaSeccionSubseccionArchivo::destroy($paginaSubSeccionArchivo->id);
            }
        
            return redirect()->route('paginas.subseccion-archivos-index', [$pagina, $paginaSeccion, $pagina_subseccion])->with('success', 'Registro eliminado correctamente');
        } catch (\Throwable $th) {

            return redirect()->route('paginas.subseccion-archivos-index', [$pagina, $paginaSeccion, $pagina_subseccion])->with('error',$th->getMessage());
        }
    }

    public function pruebinguis(Request $request){

        // return response()->json('hola');
        if($request->ajax()){
            
            $pagina = Pagina::where('slug', $request->pagina)
                                ->select(['id', 'slug'])
                                ->get();

            $pagina_id = '';
            $pagina_slug = '';
            foreach ($pagina as $key => $pg) {
                $pagina_id = $pg->id;
                $pagina_slug = $pg->slug;
            }

            $seccion = PaginaSeccion::where('pagina_id', $pagina_id)
                                        ->where('slug', $request->seccion)
                                        ->select(['slug','id'])
                                        ->get();

            $seccion_id = '';
            $seccion_slug = '';
            foreach ($seccion as $key => $sec) {
                $seccion_id = $sec->id;
                $seccion_slug = $sec->slug;
            }
            
            $subseccion = PaginaSeccionSubseccion::where('pagina_slug', $pagina_slug)
                                                    ->where('seccion_slug', $seccion_slug)
                                                    ->where('slug', $request->subseccion)
                                                    ->select(['slug','id'])
                                                    ->get();
            
            
            $subseccion_id = '';
            $subseccion_slug = '';
            foreach ($subseccion as $key => $subs) {
                $subseccion_id = $subs->id;
                $subseccion_slug = $subs->slug;
            }
        }
        return response()->json([
            // 'pagina' => $pagina,
            'pagina_id'       => '<input id="pagina_id" type="hidden" name="pagina_id" value="'.$pagina_id.'">',
            'seccion_id'      => '<input id="seccion_id" type="hidden" name="seccion_id" value="'.$seccion_id.'">',
            'subseccion_id'   => '<input id="subseccion_id" type="hidden" name="subseccion_id" value="'.$subseccion_id.'">',
            'pagina_slug'     => '<input id="pagina_slug" type="hidden" name="pagina_slug" value="'.$pagina_slug.'">',
            'seccion_slug'    => '<input id="seccion_slug" type="hidden" name="seccion_slug" value="'.$seccion_slug.'">',
            'subseccion_slug' => '<input id="subseccion_slug" type="hidden" name="subseccion_slug" value="'.$subseccion_slug.'">',
        ]);
    }


    /**
     *  Función asíncrona que permite usar el datatables en el index
    */
    // public function paginasSubSeccionesArchivosDatatables()
    // {
    //         return FacadesDataTables::eloquent(\App\Models\PaginaSeccionSubseccionArchivo::orderBy('created_at', 'asc')->where('subseccion_id', Session::get('pagSubId')))
    //                                 ->addColumn('btn', function(PaginaSeccionSubseccionArchivo $paginaSubSeccionArchivo) {
    //                                     return view('paginas.subsecciones.archivos.actions', compact('paginaSubSeccionArchivo'));
    //                                 })
    //                                 ->rawColumns(['btn'])
    //                                 ->toJson();
    // }
}
