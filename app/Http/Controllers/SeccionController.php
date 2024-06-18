<?php

namespace App\Http\Controllers;

use App\Models\Seccion;
use App\Models\SubSeccion;
use App\Rules\Recaptcha;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;

class SeccionController extends Controller
{

    public function bienvenida()
    {

        // $secciones = Seccion::with('subsecciones')
        //                     ->where('estado','Si')
        //                     ->orderBy('orden','asc')
        //                     ->get();

        
        $seccionPrincipal = Seccion::with(['subsecciones' => function ($query) {
                                $query->where('estado', 'Si');
                            }])
                            ->where('banner_principal', 'Si')
                            ->where('estado','Si')
                            ->orderBy('orden','asc')
                            ->get();
                            
                            
        $secciones = Seccion::with(['subsecciones' => function ($query) {
                                $query->where('estado', 'Si');
                            }])
                            ->where('banner_principal', 'No')
                            ->where('estado','Si')
                            ->orderBy('orden','asc')
                            ->get();

        return view('welcome', compact('secciones', 'seccionPrincipal'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('seccion-inicio.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('seccion-inicio.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $seccionDatos = $request->all();

        $validated = $request->validate([
            'titulo'                => 'nullable|string',
            'descripcion'           => 'nullable|string|max:50',
            'tipo'                  => 'required',
            'imagen'                => 'nullable|mimes:jpg,jpeg,png,webp',
            'imagen_telefono'       => 'nullable|mimes:jpg,jpeg,png,webp',
            // 'color'                 => 'required',
            'enlace'                => 'nullable',
            'orden'                 => 'required|integer|min:0',
            'estado'                => 'required',
            'mapa'                  => 'nullable',
            'identificador'         => 'required|string',
            'banner_principal'      => 'nullable',
            //'g-recaptcha-response'  => ['required', new Recaptcha]
        ]);

        // Si el request eiene una imagen
        if($request->hasFile('imagen')){

            // Nnombre de la imagen (haciendola unica)
            $imagen = $request->file('imagen');
            $hora = Str::slug(date('h:i:s'),'_');
            $nombre_de_imagen = $hora.'_'.$imagen->getClientOriginalName();
    
            $seccionDatos['imagen'] = $request->file('imagen')->storeAs('uploads/seccion_inicio/archivos/imagenes', $nombre_de_imagen, 'public');
        }

        // Si el request eiene una imagen para telefono
        if($request->hasFile('imagen_telefono')){

            // Nnombre de la imagen para telefono (haciendola unica)
            $imagen_telefono = $request->file('imagen_telefono');
            $hora = Str::slug(date('h:i:s'),'_');
            $nombre_de_imagen_telefono = $hora.'_'.$imagen_telefono->getClientOriginalName();
    
            $seccionDatos['imagen_telefono'] = $request->file('imagen_telefono')->storeAs('uploads/seccion_inicio/archivos/imagenes', $nombre_de_imagen_telefono, 'public');
        }
        
        $seccion = Seccion::create($seccionDatos);

        Session::put('seccion_id', $seccion->id);
        
        return redirect()->route('seccion-inicio.show', Session::get('seccion_id'))->with('success','Registro creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $seccion = Seccion::findOrFail($id);
        
        $subSeccion = SubSeccion::where('seccion_id', '=', $id)->get();
        
        Session::put('seccion_id', $id);
        
        return view('seccion-inicio.show', compact('seccion','subSeccion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $seccion = Seccion::findOrFail($id);

        return view('seccion-inicio.edit', compact('seccion'));
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

        // almacenando los datos del request
        $seccionDatos = $request->all();

        // Seleccionando la sección a editar
        $seccion = Seccion::find($id);

        // Reglas de validación
        $validated = $request->validate([
            'titulo'                => 'nullable|string',
            'descripcion'           => 'nullable|string',
            'tipo'                  => 'required',
            'imagen'                => 'nullable|mimes:jpg,jpeg,png,webp',
            'imagen_telefono'       => 'nullable|mimes:jpg,jpeg,png,webp',
            // 'color'                 => 'required',
            'enlace'                => 'nullable',
            'orden'                 => 'required|integer|min:0',
            'estado'                => 'required',
            'mapa'                  => 'nullable',
            'identificador'         => 'required|string',
            //'g-recaptcha-response'  => ['required', new Recaptcha]
        ]);

        // Si el request no tiene una imagen, la crea
        // Caso contrario que si exista en el request una imagen 
        // se elimina la actual para almacenar la nueva
        if($request->hasFile('imagen')){
                    
            if(is_null($seccion->imagen)){
                // Nnombre de la imagen (haciendola unica)
                $imagen = $request->file('imagen');
                $hora = Str::slug(date('h:i:s'),'_');
                $nombre_de_imagen = $hora.'_'.$imagen->getClientOriginalName();
        
                $seccionDatos['imagen'] = $request->file('imagen')->storeAs('uploads/seccion_inicio/archivos/imagenes', $nombre_de_imagen, 'public');

            } elseif (Storage::exists($seccion->imagen)){

                Storage::delete($seccion->imagen);
                
                // Nombre de la imagen (haciendola unica)
                $imagen = $request->file('imagen');
                $hora = Str::slug(date('h:i:s'),'_');
                $nombre_de_imagen = $hora.'_'.$imagen->getClientOriginalName();

                $seccionDatos['imagen'] = $request->file('imagen')->storeAs('uploads/seccion_inicio/archivos/imagenes', $nombre_de_imagen, 'public');
            }
        }

        // Si el request no tiene una imagen para teléfono, la crea
        // Caso contrario que si exista en el request una imagen 
        // se elimina la actual para almacenar la nueva
        if($request->hasFile('imagen_telefono')){
                    
            if(is_null($seccion->imagen_telefono)){
                // Nnombre de la imagen (haciendola unica)
                $imagen_telefono = $request->file('imagen_telefono');
                $hora = Str::slug(date('h:i:s'),'_');
                $nombre_de_imagen_telefono = $hora.'_'.$imagen_telefono->getClientOriginalName();
        
                $seccionDatos['imagen_telefono'] = $request->file('imagen_telefono')->storeAs('uploads/seccion_inicio/archivos/imagenes', $nombre_de_imagen_telefono, 'public');

            } elseif (Storage::exists($seccion->imagen_telefono)){

                Storage::delete($seccion->imagen_telefono);
                
                // Nombre de la imagen (haciendola unica)
                $imagen_telefono = $request->file('imagen_telefono');
                $hora = Str::slug(date('h:i:s'),'_');
                $nombre_de_imagen_telefono = $hora.'_'.$imagen_telefono->getClientOriginalName();

                $seccionDatos['imagen_telefono'] = $request->file('imagen_telefono')->storeAs('uploads/seccion_inicio/archivos/imagenes', $nombre_de_imagen_telefono, 'public');
            }
        }

        $seccion->update($seccionDatos);

        return redirect()->route('seccion-inicio.show', Session::get('seccion_id'))->with('success','Registro creado correctamente');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            // Obteniendo la colección del archivo junto con la imagen y el documento
            $seccion = Seccion::find($id);
            $imagen = $seccion->imagen;
            $imagen_telefono = $seccion->imagen_telefono;
            
            // Si existe una imagen va a eliminar la imagen y la sección
            // Caso contrario, si la imagen es null (no hay iamgen), unicamente va a eliminar la sección
            if ($imagen && $imagen_telefono){
                Storage::delete($imagen);
                Storage::delete($imagen_telefono);
                Seccion::destroy($id);
            } elseif(is_null($imagen) && is_null($imagen_telefono)){
                Seccion::destroy($id);
            }
        
            return redirect()->route('seccion-inicio.index')->with('success', 'Registro eliminado correctamente');
        } catch (\Throwable $th) {
            return redirect()->route('seccion-inicio.index')->with('error',$th->getMessage());
        }
    }

    public function seccionesDatatables()
    {
        return FacadesDataTables::eloquent(\App\Models\Seccion::orderBy('orden', 'asc'))
                ->addColumn('btn', 'seccion-inicio.actions')
                ->rawColumns(['btn'])
                ->toJson();
    }
}
