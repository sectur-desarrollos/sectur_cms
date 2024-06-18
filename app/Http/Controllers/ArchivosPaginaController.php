<?php

namespace App\Http\Controllers;

use App\Models\Pagina;
use App\Models\Archivo;
use App\Models\Repositorio;
use App\Rules\Recaptcha;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;

class ArchivosPaginaController extends Controller
{
    public $paginaSeleccionada;
    public $paginaSeleccionadaSlug;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Pagina $pagina)
    {
        $paginaActual = $pagina->id;
        $paginaSlug = $pagina->slug;
        $this->paginaSeleccionada = $paginaActual;
        $this->paginaSeleccionadaSlug = $paginaSlug;
        session()->put('paginaSelect', $paginaActual);
        session()->put('paginaSelectSlug', $paginaSlug);

        return view('paginas.archivos.index', compact('pagina'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Pagina $pagina)
    {
        return view('paginas.archivos.create', compact('pagina'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pagina = Pagina::find($request->pagina_id);
        $archivoData = $request->all();

        $validated = $request->validate([
            'titulo'                => 'required',
            'imagen'                => 'mimes:jpg,jpeg,png',
            'documento'             => 'mimes:doc,pdf,docx,xlsx',
            'estado'                => 'required',
            //'g-recaptcha-response'  => ['required', new Recaptcha],
        ]);
        
        if($request->hasFile('imagen')){

            // Nnombre de la imagen (haciendola unica)
            $imagen = $request->file('imagen');
            $hora = Str::slug(date('h:i:s'),'_');
            $nombre_de_imagen = $hora.'_'.$imagen->getClientOriginalName();
        
            // Tamaño de la imagen
            $imagenSize = $request->file('imagen')->getSize();
            $units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
            $power = $imagenSize > 0 ? floor(log($imagenSize, 1024)) : 0;
            $imagenSizeFinal = number_format($imagenSize / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
            
            // Tipo de archivo (extension)
            $getImagen = $request->file('imagen');
            $imagenExtension = $getImagen->getClientOriginalExtension();
            
            // Asignando el tamaño y tipo
            $archivoData['size_imagen'] = $imagenSizeFinal;
            $archivoData['type_imagen'] = $imagenExtension;

            $archivoData['imagen']= $request->file('imagen')->storeAs('uploads/paginas/archivos/imagenes', $nombre_de_imagen, 'public');

            // Inicia el proceso para agregar al Modelo de Repositorio
            
            $repositorio          = new Repositorio;
            $repositorio->titulo  = $nombre_de_imagen;
            $repositorio->tipo    = $imagenExtension;
            $repositorio->archivo = $request->file('imagen')->storeAs('uploads/repositorio/archivos', $nombre_de_imagen, 'public');
            $repositorio->save();

            // Inicia el proceso para agregar al Modelo de Repositorio
        }

        if($request->hasFile('documento')){
            // Obteniendo el nombre del documento (haciendola unica)
            $documento = $request->file('documento');
            $hora = Str::slug(date('h:i:s'),'_');
            $nombre_de_documento = $hora.'_'.$documento->getClientOriginalName();
            
            // Obteniendo el tamaño del documento
            $documentSize = $request->file('documento')->getSize();
            $units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
            $power = $documentSize > 0 ? floor(log($documentSize, 1024)) : 0;
            $documentSizeFinal = number_format($documentSize / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
            
            // Obteniendo el tipo de archivo (extension)
            $getDocument = $request->file('documento');
            $documentExtension = $getDocument->getClientOriginalExtension();
            
            // Asignando el tamaño y tipo
            $archivoData['size_documento'] = $documentSizeFinal;
            $archivoData['type_documento'] = $documentExtension;

            $archivoData['documento']= $request->file('documento')->storeAs('uploads/paginas/archivos/documentos', $nombre_de_documento, 'public');

            // Inicia el proceso para agregar al Modelo de Repositorio
            
            $repositorio          = new Repositorio;
            $repositorio->titulo  = $nombre_de_documento;
            $repositorio->tipo    = $documentExtension;
            $repositorio->archivo = $request->file('documento')->storeAs('uploads/repositorio/archivos', $nombre_de_documento, 'public');
            $repositorio->save();

            // Inicia el proceso para agregar al Modelo de Repositorio
        }

        if($request->hasFile('imagen') && $request->hasFile('documento')){
            // Nnombre de la imagen (haciendola unica)
            $imagen = $request->file('imagen');
            $hora = Str::slug(date('h:i:s'),'_');
            $nombre_de_imagen = $hora.'_'.$imagen->getClientOriginalName();
        
            // Tamaño de la imagen
            $imagenSize = $request->file('imagen')->getSize();
            $units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
            $power = $imagenSize > 0 ? floor(log($imagenSize, 1024)) : 0;
            $imagenSizeFinal = number_format($imagenSize / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
            
            // Tipo de archivo (extension)
            $getImagen = $request->file('imagen');
            $imagenExtension = $getImagen->getClientOriginalExtension();
            
            // Asignando el tamaño y tipo
            $archivoData['size_imagen'] = $imagenSizeFinal;
            $archivoData['type_imagen'] = $imagenExtension;

            $archivoData['imagen']= $request->file('imagen')->storeAs('uploads/paginas/archivos/imagenes', $nombre_de_imagen, 'public');

             // Obteniendo el nombre del documento (haciendola unica)
            $documento = $request->file('documento');
            $hora = Str::slug(date('h:i:s'),'_');
            $nombre_de_documento = $hora.'_'.$documento->getClientOriginalName();
            
            // Obteniendo el tamaño del documento
            $documentSize = $request->file('documento')->getSize();
            $units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
            $power = $documentSize > 0 ? floor(log($documentSize, 1024)) : 0;
            $documentSizeFinal = number_format($documentSize / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
            
            // Obteniendo el tipo de archivo (extension)
            $getDocument = $request->file('documento');
            $documentExtension = $getDocument->getClientOriginalExtension();
            
            // Asignando el tamaño y tipo
            $archivoData['size_documento'] = $documentSizeFinal;
            $archivoData['type_documento'] = $documentExtension;

            $archivoData['documento']= $request->file('documento')->storeAs('uploads/paginas/archivos/documentos', $nombre_de_documento, 'public');
        
        }

        Archivo::create($archivoData);

        // Actualizando la página al momento que se cargue un archivo
        DB::table('paginas')
            ->where('id', $pagina->id)
            ->update([
                'fuente'      => auth()->user()->roles->pluck("name")->first(),
                'updated_at'  => now(),
            ]);
        // Actualizando la página al momento que se cargue un archivo


        return redirect()->route('paginas.archivos',$pagina)->with('success', 'Registro creado correctamente');
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
        $archivo = Archivo::find($id);
        $pagina = Pagina::find(session('paginaSelect'));

        return view('paginas.archivos.edit', compact('archivo', 'pagina'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $archivoData = $request->all();
        $pagina = Pagina::find($request->pagina_id);
        $archivo = Archivo::find($id);

        $validated = $request->validate([
            'titulo'                => 'required',
            'imagen'                => 'mimes:jpg,jpeg,png',
            'documento'             => 'mimes:doc,pdf,docx,xlsx',
            'estado'                => 'required',
            //'g-recaptcha-response'  => ['required', new Recaptcha],
        ]);

        // Si el request tiene una imagen se elimina la actual para almacenar la nueva
        if($request->hasFile('imagen')){
            
            if(is_null($archivo->imagen)){
                // Nnombre de la imagen (haciendola unica)
                $imagen = $request->file('imagen');
                $hora = Str::slug(date('h:i:s'),'_');
                $nombre_de_imagen = $hora.'_'.$imagen->getClientOriginalName();
            
                // Tamaño de la imagen
                $imagenSize = $request->file('imagen')->getSize();
                $units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
                $power = $imagenSize > 0 ? floor(log($imagenSize, 1024)) : 0;
                $imagenSizeFinal = number_format($imagenSize / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
                
                // Tipo de archivo (extension)
                $getImagen = $request->file('imagen');
                $imagenExtension = $getImagen->getClientOriginalExtension();
                
                // Asignando el tamaño y tipo
                $archivoData['size_imagen'] = $imagenSizeFinal;
                $archivoData['type_imagen'] = $imagenExtension;

                $archivoData['imagen']= $request->file('imagen')->storeAs('uploads/paginas/archivos/imagenes', $nombre_de_imagen, 'public');

                // Inicia el proceso para agregar al Modelo de Repositorio
            
                $repositorio          = new Repositorio;
                $repositorio->titulo  = $nombre_de_imagen;
                $repositorio->tipo    = $imagenExtension;
                $repositorio->archivo = $request->file('imagen')->storeAs('uploads/repositorio/archivos', $nombre_de_imagen, 'public');
                $repositorio->save();

                // Inicia el proceso para agregar al Modelo de Repositorio
                
            } elseif (Storage::exists($archivo->imagen)){

                // borrando la imagen del storage
                $archivoImagen = Archivo::findOrFail($id);
                Storage::delete($archivoImagen->imagen);
                
                // Nnombre de la imagen (haciendola unica)
                $imagen = $request->file('imagen');
                $hora = Str::slug(date('h:i:s'),'_');
                $nombre_de_imagen = $hora.'_'.$imagen->getClientOriginalName();
            
                // Tamaño de la imagen
                $imagenSize = $request->file('imagen')->getSize();
                $units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
                $power = $imagenSize > 0 ? floor(log($imagenSize, 1024)) : 0;
                $imagenSizeFinal = number_format($imagenSize / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
                
                // Tipo de archivo (extension)
                $getImagen = $request->file('imagen');
                $imagenExtension = $getImagen->getClientOriginalExtension();
                
                // Asignando el tamaño y tipo
                $archivoData['size_imagen'] = $imagenSizeFinal;
                $archivoData['type_imagen'] = $imagenExtension;

                $archivoData['imagen']= $request->file('imagen')->storeAs('uploads/paginas/archivos/imagenes', $nombre_de_imagen, 'public');

                // Inicia el proceso para agregar al Modelo de Repositorio
            
                $repositorio          = new Repositorio;
                $repositorio->titulo  = $nombre_de_imagen;
                $repositorio->tipo    = $imagenExtension;
                $repositorio->archivo = $request->file('imagen')->storeAs('uploads/repositorio/archivos', $nombre_de_imagen, 'public');
                $repositorio->save();

                // Inicia el proceso para agregar al Modelo de Repositorio

            }
        }

        // Si el request tiene un docuumento se elimina el actual para almacenar el nuevo
        if($request->hasFile('documento')){

            if(is_null($archivo->documento)){
            
                // Obteniendo el nombre del documento (haciendola unica)
                $documento = $request->file('documento');
                $hora = Str::slug(date('h:i:s'),'_');
                $nombre_de_documento = $hora.'_'.$documento->getClientOriginalName();
            
                // Obteniendo el tamaño del documento
                $documentSize = $request->file('documento')->getSize();
                $units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
                $power = $documentSize > 0 ? floor(log($documentSize, 1024)) : 0;
                $documentSizeFinal = number_format($documentSize / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
            
                // Obteniendo el tipo de archivo (extension)
                $getDocument = $request->file('documento');
                $documentExtension = $getDocument->getClientOriginalExtension();
            
                // Asignando el tamaño y tipo
                $archivoData['size_documento'] = $documentSizeFinal;
                $archivoData['type_documento'] = $documentExtension;

                $archivoData['documento']= $request->file('documento')->storeAs('uploads/paginas/archivos/documentos', $nombre_de_documento, 'public');

                // Inicia el proceso para agregar al Modelo de Repositorio
            
                $repositorio          = new Repositorio;
                $repositorio->titulo  = $nombre_de_documento;
                $repositorio->tipo    = $documentExtension;
                $repositorio->archivo = $request->file('documento')->storeAs('uploads/repositorio/archivos', $nombre_de_documento, 'public');
                $repositorio->save();

                // Inicia el proceso para agregar al Modelo de Repositorio

            } elseif (Storage::exists($archivo->documento)){
                // borrando la documento del storage
                $archivoDocumento = Archivo::findOrFail($id);
                Storage::delete($archivoDocumento->documento);

                // Obteniendo el nombre del documento (haciendola unica)
                $documento = $request->file('documento');
                $hora = Str::slug(date('h:i:s'),'_');
                $nombre_de_documento = $hora.'_'.$documento->getClientOriginalName();
            
                // Obteniendo el tamaño del documento
                $documentSize = $request->file('documento')->getSize();
                $units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
                $power = $documentSize > 0 ? floor(log($documentSize, 1024)) : 0;
                $documentSizeFinal = number_format($documentSize / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
            
                // Obteniendo el tipo de archivo (extension)
                $getDocument = $request->file('documento');
                $documentExtension = $getDocument->getClientOriginalExtension();
            
                // Asignando el tamaño y tipo
                $archivoData['size_documento'] = $documentSizeFinal;
                $archivoData['type_documento'] = $documentExtension;

                $archivoData['documento']= $request->file('documento')->storeAs('uploads/paginas/archivos/documentos', $nombre_de_documento, 'public');

                // Inicia el proceso para agregar al Modelo de Repositorio
            
                $repositorio          = new Repositorio;
                $repositorio->titulo  = $nombre_de_documento;
                $repositorio->tipo    = $documentExtension;
                $repositorio->archivo = $request->file('documento')->storeAs('uploads/repositorio/archivos', $nombre_de_documento, 'public');
                $repositorio->save();

                // Inicia el proceso para agregar al Modelo de Repositorio

            }

        }

        // Si el request contiene una imagen y un documento se eliminan los dos actuales y se guardan lso nuevos
        // if($request->hasFile('imagen') && $request->hasFile('documento')){

        //     // borrando la imagen y el documento del storage
        //     $archivo = Archivo::findOrFail($id);
        //     Storage::delete($archivo->imagen, $archivo->documento);

        //     // Nnombre de la imagen (haciendola unica)
        //     $imagen = $request->file('imagen');
        //     $hora = Str::slug(date('h:i:s'),'_');
        //     $nombre_de_imagen = $hora.'_'.$imagen->getClientOriginalName();
        
        //     // Tamaño de la imagen
        //     $imagenSize = $request->file('imagen')->getSize();
        //     $units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
        //     $power = $imagenSize > 0 ? floor(log($imagenSize, 1024)) : 0;
        //     $imagenSizeFinal = number_format($imagenSize / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
            
        //     // Tipo de archivo (extension)
        //     $getImagen = $request->file('imagen');
        //     $imagenExtension = $getImagen->getClientOriginalExtension();
            
        //     // Asignando el tamaño y tipo
        //     $archivoData['size_imagen'] = $imagenSizeFinal;
        //     $archivoData['type_imagen'] = $imagenExtension;

        //     $archivoData['imagen']= $request->file('imagen')->storeAs('uploads/paginas/archivos/imagenes', $nombre_de_imagen, 'public');

        //      // Obteniendo el nombre del documento (haciendola unica)
        //     $documento = $request->file('documento');
        //     $hora = Str::slug(date('h:i:s'),'_');
        //     $nombre_de_documento = $hora.'_'.$documento->getClientOriginalName();
            
        //     // Obteniendo el tamaño del documento
        //     $documentSize = $request->file('documento')->getSize();
        //     $units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
        //     $power = $documentSize > 0 ? floor(log($documentSize, 1024)) : 0;
        //     $documentSizeFinal = number_format($documentSize / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
            
        //     // Obteniendo el tipo de archivo (extension)
        //     $getDocument = $request->file('documento');
        //     $documentExtension = $getDocument->getClientOriginalExtension();
            
        //     // Asignando el tamaño y tipo
        //     $archivoData['size_documento'] = $documentSizeFinal;
        //     $archivoData['type_documento'] = $documentExtension;

        //     $archivoData['documento']= $request->file('documento')->storeAs('uploads/paginas/archivos/documentos', $nombre_de_documento, 'public');
        
        // }

        $archivo->update($archivoData);

        // Actualizando la página al momento que se cargue un archivo
        DB::table('paginas')
            ->where('id', $pagina->id)
            ->update([
                'fuente'      => auth()->user()->roles->pluck("name")->first(),
                'updated_at'  => now(),
            ]);
        // Actualizando la página al momento que se cargue un archivo
        
        return redirect()->route('paginas.archivos', $pagina)->with('success', 'Registro actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        // Obteniendo la colección del archivo junto con la imagen y el documento
        $archivo = Archivo::find($id);
        $imagen = $archivo->imagen;
        $documento = $archivo->documento;
        $enlace = $archivo->enlace;

        // Se obtiene la página a la que le perteneen los archivos para redireccionar a la vista del listado
        // Y poder mostrar correctamente el mensaje de éxito
        $pagina = Pagina::find($archivo->pagina_id);

        // Estas dos condiciones de abajo permite también eliminar dos archivos si 
        // Si existe una imagen la elimina del storage y el registro también
        if ($imagen){
            Storage::delete($imagen);
            Archivo::destroy($id);
        }

        // Si existe un doccumento lo elimina del storage y el registro también
        if($documento){
            Storage::delete($documento);
            Archivo::destroy($id);
        }

        if($enlace){
            Archivo::destroy($id);
        }


        return redirect()->route('paginas.archivos',$pagina)->with('success', 'Registro eliminado correctamente');
    }

    public function paginasArchivosDatatables()
    {
        $dataArchivosPagina = Archivo::where('pagina_id', session('paginaSelect'));
        return FacadesDataTables::eloquent($dataArchivosPagina)
                                ->addColumn('btn', 'paginas.archivos.actions')
                                ->rawColumns(['btn'])
                                ->toJson();
    }

    // Función para el buscador de archivos de las páginas
    public function check(Request $request)
    {

        // Se hace la petición AJAX, donde la consulta pide los datos de las páginas por el titulo
        // Y donde sea la correspondiente página
        if($request->ajax()){
            $archivos = Archivo::where('titulo', 'like', '%'. $request->titulo. '%')
                                ->where('pagina_id', $request->id)
                                ->where('estado', 'Si')
                                ->get();

            $respuesta = '';

            // Si existe un conteo mayor a 0 en la consulta va a dar las siguientes coincidencias
            // Ya sea en documentos, imagenes ó enlaces.
            if(count($archivos) > 0){
                
                foreach($archivos as $archivo){
                        if(!is_null($archivo->documento))
                        {
                            $respuesta .= '<p>
                                                <a class="enlace-titulo" href="'.asset("storage")."/".$archivo->documento.'" title="Descargar"
                                                    download="'.$archivo->titulo.'" target="_blank">'.$archivo->titulo.'</a>
                                                &nbsp;-&nbsp;
                                                <a class="enlace" style="rgb(166, 75, 10);" href="'.asset("storage")."/".$archivo->documento.'"
                                                    title="Descargar" download="'.$archivo->titulo.'"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                        height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                                        <path
                                                            d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                                                        <path
                                                            d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                                                    </svg>
                                                </a>
                                            </p>
                                            <div>
                                                <div class="d-flex">
                                                    <small class="text-black-50">Tamaño: '.$archivo->size_documento.'</small>&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <small class="text-black-50">Formato: '.$archivo->type_documento.'</small>
                                                </div>
                                            </div>
                                            <hr>';
                        }
                        if(!is_null($archivo->imagen))
                        {
                            $respuesta .= '<p>
                                                <a class="enlace-titulo" href="'.asset("storage")."/".$archivo->imagen.'" title="Descargar"
                                                    download="'.$archivo->titulo.'" target="_blank">'.$archivo->titulo.'</a>
                                                &nbsp;-&nbsp;
                                                <a class="enlace" style="rgb(166, 75, 10);" href="'.asset("storage")."/".$archivo->imagen.'"
                                                    title="Descargar" download="'.$archivo->titulo.'"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                        height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                                        <path
                                                            d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                                                        <path
                                                            d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                                                    </svg>
                                                </a>
                                            </p>
                                            <div>
                                                <div class="d-flex">
                                                    <small class="text-black-50">Tamaño: '.$archivo->size_imagen.'</small>&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <small class="text-black-50">Formato: '.$archivo->type_imagen.'</small>
                                                </div>
                                            </div>
                                            <hr>';
                        }
                        if(!is_null($archivo->enlace))
                        {
                            $respuesta .=   '<p>
                                                <a class="enlace-titulo" href="https://'.$archivo->enlace.'" title="Visitar '.$archivo->titulo.'" target="_blank">'.$archivo->titulo.'</a>
                                                &nbsp;-&nbsp;
                                                <a class="enlace" style="rgb(166, 75, 10);" href="https://'.$archivo->enlace.'" title="Visitar '.$archivo->titulol.'">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"/>
                                                        <path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"/>
                                                    </svg>
                                                </a>
                                            </p>
                                            <hr>';
                        }
                }
            } else {
                $respuesta = '<p class="fw-bold text-danger">Sin resultados</p>';
            }
        }
        return response()->json([
            'respuesta' => $respuesta,
            'contador' => $archivos->count(),
        ]);
    }
}
