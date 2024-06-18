<?php

namespace App\Http\Controllers;

use App\Models\Repositorio;
use App\Rules\Recaptcha;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;

class RepositorioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('repositorios.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('repositorios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datos = $request->all();

        $validated = $request->validate([
            'titulo'                => 'required|string',
            'archivo'               => 'required|mimes:jpg,jpeg,png,doc,pdf,docx,xlsx,webp',
            //'g-recaptcha-response'  => ['required', new Recaptcha],
        ]);

        if($request->hasFile('archivo')){

            // Nnombre de la imagen (haciendola unica)
            $archivo = $request->file('archivo');
            $hora = Str::slug(date('h:i:s'),'_');
            $nombreArchivo = $hora.'_'.$archivo->getClientOriginalName();

            // Tipo de archivo (extension)
            $datos['tipo'] = $archivo->getClientOriginalExtension();
            
            // Guardando la imagen en el disco
            $datos['archivo'] = $request->file('archivo')->storeAs('uploads/repositorio/archivos', $nombreArchivo, 'public');
        }

        Repositorio::create($datos);

        return redirect()->route('repositorios.index')->with('success', 'Registro creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $repositorio = Repositorio::find($id);

        return view('repositorios.edit', compact('repositorio'));
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
        $datos = $request->all();
        $repositorio = Repositorio::find($id);

        $validated = $request->validate([
            'titulo'                => 'required|string',
            'archivo'               => 'required|mimes:jpg,jpeg,png,doc,pdf,docx,xlsx,webp',
            //'g-recaptcha-response'  => ['required', new Recaptcha],
        ]);

               // Si el request tiene una imagen se elimina la actual para almacenar la nueva
        if($request->hasFile('archivo')){
            
            if(Storage::exists($repositorio->archivo)){

                // borrando la imagen del storage
                $repositorio = Repositorio::findOrFail($id);
                Storage::delete($repositorio->archivo);
    
                // Nnombre de la imagen (haciendola unica)
                $archivo = $request->file('archivo');
                $hora = Str::slug(date('h:i:s'),'_');
                $nombreArchivo = $hora.'_'.$archivo->getClientOriginalName();

                // Tipo de archivo (extension)
                $datos['tipo'] = $archivo->getClientOriginalExtension();
                
                // Guardando la imagen en el disco
                $datos['archivo'] = $request->file('archivo')->storeAs('uploads/repositorio/archivos', $nombreArchivo, 'public');
            }
        }
            
        $repositorio->update($datos);
        
        return redirect()->route('repositorios.edit', $id)->with('success', 'Registro actualizado correctamente');
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
            $repositorio = Repositorio::find($id);
            $archivo = $repositorio->archivo;

            // Si existe una imagen va a eliminar la imagen y la sección
            // Caso contrario, si la imagen es null (no hay iamgen), unicamente va a eliminar la sección
            if ($archivo){
                Storage::delete($archivo);
                Repositorio::destroy($id);
            }
        
            return redirect()->route('repositorios.index')->with('success', 'Registro eliminado correctamente');
        } catch (\Throwable $th) {
            return redirect()->route('repositorios.index')->with('error',$th->getMessage());
        }
    }

    public function repositoriosDatatables()
    {
        return FacadesDataTables::eloquent(Repositorio::orderBy('tipo', 'asc'))
                ->addColumn('btn', 'repositorios.actions')
                ->rawColumns(['btn'])
                ->toJson();
    }
}
