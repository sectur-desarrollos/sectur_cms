<?php

namespace App\Http\Controllers;

use App\Models\SubSeccion;
use App\Rules\Recaptcha;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class SubSeccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('seccion-inicio.subseccion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subSeccionDatos = $request->all();

        $validated = $request->validate([
            'titulo'                => 'nullable|string',
            'descripcion'           => 'nullable|string|max:50',
            'imagen'                => 'nullable|mimes:jpg,jpeg,png,webp',
            'imagen_telefono'       => 'nullable|mimes:jpg,jpeg,png,webp',
            'enlace'                => 'nullable',
            'estado'                => 'required',
            //'g-recaptcha-response'  => ['required', new Recaptcha],
        ]);

        $subSeccionDatos['seccion_id'] = Session::get('seccion_id');

        // Si el request eiene una imagen
        if($request->hasFile('imagen')){

            // Nnombre de la imagen (haciendola unica)
            $imagen = $request->file('imagen');
            $hora = Str::slug(date('h:i:s'),'_');
            $nombre_de_imagen = $hora.'_'.$imagen->getClientOriginalName();
    
            $subSeccionDatos['imagen'] = $request->file('imagen')->storeAs('uploads/seccion_inicio/subseccion/archivos/imagenes', $nombre_de_imagen, 'public');
        }
        
        // Si el request eiene una imagen
        if($request->hasFile('imagen_telefono')){

            // Nnombre de la imagen (haciendola unica)
            $imagen = $request->file('imagen_telefono');
            $hora = Str::slug(date('h:i:s'),'_');
            $nombre_de_imagen = $hora.'_'.$imagen->getClientOriginalName();
    
            $subSeccionDatos['imagen_telefono'] = $request->file('imagen_telefono')->storeAs('uploads/seccion_inicio/subseccion/archivos/imagenes', $nombre_de_imagen, 'public');
        }
        
        SubSeccion::create($subSeccionDatos);
        
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
        $subseccion = SubSeccion::findOrFail($id);
        return view('seccion-inicio.subseccion.edit', compact('subseccion'));
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
        $subSeccionDatos = $request->all();

        // Seleccionando la sección a editar
        $subSeccion = SubSeccion::find($id);

        $validated = $request->validate([
            'titulo'                => 'nullable|string',
            'descripcion'           => 'nullable|string|max:50',
            'imagen'                => 'nullable|mimes:jpg,jpeg,png',
            'imagen_telefono'       => 'nullable|mimes:jpg,jpeg,png',
            'enlace'                => 'nullable',
            'estado'                => 'required',
            //'g-recaptcha-response'  => ['required', new Recaptcha],
        ]);

        $subSeccionDatos['seccion_id'] = Session::get('seccion_id');

        // Si el request no tiene una imagen, la crea
        // Caso contrario que si exista en el request una imagen 
        // se elimina la actual para almacenar la nueva
        if($request->hasFile('imagen')){
                    
            if(is_null($subSeccion->imagen)){
                // Nnombre de la imagen (haciendola unica)
                $imagen = $request->file('imagen');
                $hora = Str::slug(date('h:i:s'),'_');
                $nombre_de_imagen = $hora.'_'.$imagen->getClientOriginalName();
        
                $subSeccionDatos['imagen'] = $request->file('imagen')->storeAs('uploads/seccion_inicio/subseccion/archivos/imagenes', $nombre_de_imagen, 'public');

            } elseif (Storage::exists($subSeccion->imagen)){

                Storage::delete($subSeccion->imagen);
                
                // Nombre de la imagen (haciendola unica)
                $imagen = $request->file('imagen');
                $hora = Str::slug(date('h:i:s'),'_');
                $nombre_de_imagen = $hora.'_'.$imagen->getClientOriginalName();

                $subSeccionDatos['imagen'] = $request->file('imagen')->storeAs('uploads/seccion_inicio/subseccion/archivos/imagenes', $nombre_de_imagen, 'public');
            }
        }

        // Si el request no tiene una imagen para teléfono, la crea
        // Caso contrario que si exista en el request una imagen 
        // se elimina la actual para almacenar la nueva
        if($request->hasFile('imagen_telefono')){
                    
            if(is_null($subSeccion->imagen_telefono)){
                // Nnombre de la imagen (haciendola unica)
                $imagen_telefono = $request->file('imagen_telefono');
                $hora = Str::slug(date('h:i:s'),'_');
                $nombre_de_imagen_telefono = $hora.'_'.$imagen_telefono->getClientOriginalName();
        
                $subSeccionDatos['imagen_telefono'] = $request->file('imagen_telefono')->storeAs('uploads/seccion_inicio/subseccion/archivos/imagenes', $nombre_de_imagen_telefono, 'public');

            } elseif (Storage::exists($subSeccion->imagen_telefono)){

                Storage::delete($subSeccion->imagen_telefono);
                
                // Nombre de la imagen (haciendola unica)
                $imagen_telefono = $request->file('imagen_telefono');
                $hora = Str::slug(date('h:i:s'),'_');
                $nombre_de_imagen_telefono = $hora.'_'.$imagen_telefono->getClientOriginalName();

                $subSeccionDatos['imagen_telefono'] = $request->file('imagen_telefono')->storeAs('uploads/seccion_inicio/subseccion/archivos/imagenes', $nombre_de_imagen_telefono, 'public');
            }
        }

        $subSeccion->update($subSeccionDatos);

        return redirect()->route('subseccion.edit', $id)->with('success','Registro actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //imagen
        //imagen_telefono
        try {
            // Obteniendo la colección del archivo junto con la imagen y el documento
            $seccion = SubSeccion::find($id);
            $imagen = $seccion->imagen;
            $imagen_telefono = $seccion->imagen_telefono;
            
            // Si existe una imagen va a eliminar la imagen y la sección
            // Caso contrario, si la imagen es null (no hay iamgen), unicamente va a eliminar la sección
            if ($imagen && $imagen_telefono){
                Storage::delete($imagen);
                Storage::delete($imagen_telefono);
                SubSeccion::destroy($id);
            } elseif(is_null($imagen) && is_null($imagen_telefono)){
                SubSeccion::destroy($id);
            }
        
            return redirect()->route('seccion-inicio.show', Session::get('seccion_id'))->with('success','Registro creado correctamente');
        } catch (\Throwable $th) {
            return redirect()->route('seccion-inicio.show', Session::get('seccion_id'))->with('error', 'Error, no se pudo eliminar');
        }
    }
}
