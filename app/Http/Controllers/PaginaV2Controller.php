<?php

namespace App\Http\Controllers;

use App\Models\PaginaV2;
use Illuminate\Http\Request;
use App\Models\ArchivoV2;
use App\Models\EnlaceV2;
use App\Models\HistorialLog;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\Auth;
use App\Enums\AreaEnum;

class PaginaV2Controller extends Controller
{
    public function index(Request $request)
    {
        // Validar el campo de búsqueda
        $request->validate([
            'search' => 'nullable|string|max:255',
        ]);
    
        $search = $request->input('search', '');
    
        // Construir la consulta
        $query = PaginaV2::query();
    
        if (!empty($search)) {
            $query->where('titulo', 'like', "%{$search}%")
                  ->orWhere('slug', 'like', "%{$search}%");
        }
    
        $paginas = $query->paginate(10);
    
        return view('admin-v2.paginas.index', compact('paginas', 'search'));
    }
    
    public function create()
    {
        $areas = AreaEnum::cases();
        return view('admin-v2.paginas.create', compact('areas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'imagen_destacada' => 'nullable|file|mimes:jpeg,png,jpg|max:20480', // 20MB max
            'contenido' => 'nullable',
            'slug' => 'required|string|unique:paginas_v2,slug',
            'seo_titulo' => 'nullable',
            'seo_keywords' => 'nullable',
            'seo_descripcion' => 'nullable',
            'fecha_actualizacion' => 'nullable|date',
            'fuente' => 'nullable|string|max:255',
        ]);
    
        $validated['activo'] = $request->has('activo');
    
        if ($request->has('areas')) {
            $validated['fuente'] = implode(', ', $request->areas);
        }

        if ($request->hasFile('imagen_destacada')) {
            $validated['imagen_destacada'] = $this->guardarImagenDestacada($request->file('imagen_destacada'));
        }
    
        PaginaV2::create($validated);

        // Registrar en el log
        $this->log('Creación', $validated['slug'], 'Agregó el registro: "' . $validated['titulo'] . '" con la informacion "'. implode(', ', $validated).'"');
    
        return redirect()->route('paginas.index')->with('success', 'Página creada exitosamente');
    }
    
    public function edit(Paginav2 $pagina)
    {
        // Cargar relaciones con paginación
        $archivos = ArchivoV2::where('pagina_id', $pagina->id)->paginate(5, ['*'], 'archivosPage');
        $enlaces = EnlaceV2::where('pagina_id', $pagina->id)->paginate(5, ['*'], 'enlacesPage');
        $areas = AreaEnum::cases();
        $selectedAreas = explode(', ', $pagina->fuente);    

        return view('admin-v2.paginas.edit', compact('pagina','areas', 'selectedAreas', 'archivos', 'enlaces'));
    }    

    public function show($slug)
    {
        // Encontrar la página por su slug
        $pagina = PaginaV2::where('slug', $slug)->firstOrFail();
    
        // Cargar las relaciones con condiciones de activo y ordenamiento usando with
        $pagina->load([
            'archivos' => function($query) {
                $query->where('activo', 1)->orderBy('ordenamiento', 'asc');
            },
            'enlaces' => function($query) {
                $query->where('activo', 1)->orderBy('ordenamiento', 'asc');
            },
            'secciones' => function($query) {
                $query->where('activo', 1)->orderBy('ordenamiento', 'asc')
                    ->with([
                        'subsecciones' => function($query) {
                            $query->where('activo', 1)->orderBy('ordenamiento', 'asc')
                                ->with([
                                    'archivos' => function($query) {
                                        $query->where('activo', 1)->orderBy('ordenamiento', 'asc');
                                    },
                                    'enlaces' => function($query) {
                                        $query->where('activo', 1)->orderBy('ordenamiento', 'asc');
                                    }
                                ]);
                        },
                        'archivos' => function($query) {
                            $query->where('activo', 1)->orderBy('ordenamiento', 'asc');
                        },
                        'enlaces' => function($query) {
                            $query->where('activo', 1)->orderBy('ordenamiento', 'asc');
                        }
                    ]);
            }
        ]);
    
        return view('admin-v2/paginas/pagina-publica', compact('pagina'));
    }

    public function update(Request $request, Paginav2 $pagina)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'imagen_destacada' => 'nullable|file|mimes:jpeg,png,jpg|max:20480', // 20MB max
            'contenido' => 'nullable|string',
            'slug' => 'required|string|unique:paginas_v2,slug,' . $pagina->id,
            'seo_titulo' => 'nullable',
            'seo_keywords' => 'nullable',
            'seo_descripcion' => 'nullable',
            'fecha_actualizacion' => 'nullable|date',
            'fuente' => 'nullable|string|max:255',
        ]);
    
        $validated['activo'] = $request->has('activo');
    
        if ($request->hasFile('imagen_destacada')) {
            // Eliminar la imagen anterior si existe
            if ($pagina->imagen_destacada) {
                Storage::disk('public')->delete($pagina->imagen_destacada);
            }
    
            $validated['imagen_destacada'] = $this->guardarImagenDestacada($request->file('imagen_destacada'));
        }
        
        $validated['fecha_actualizacion'] = now();
    
        $pagina->update($validated);

        // Registrar en el log
        $this->log('Actualización', $validated['slug'], 'Actualizó el registro: "' . $validated['titulo'] . '" con la informacion "'. implode(', ', $validated).'"');
    
    
        return redirect()->route('paginas.edit', $pagina->id)->with('success', 'Página actualizada de forma correcta');
    }
    
    public function destroy(Paginav2 $pagina)
    {
        try {
            // Eliminar imagen destacada
            if ($pagina->imagen_destacada) {
                Storage::disk('public')->delete($pagina->imagen_destacada);
            }
    
            // Eliminar archivos relacionados
            foreach ($pagina->archivos as $archivo) {
                Storage::disk('public')->delete($archivo->path); // Eliminar archivo del almacenamiento
                $archivo->delete(); // Eliminar registro del archivo
            }
    
            // Eliminar enlaces relacionados
            foreach ($pagina->enlaces as $enlace) {
                $enlace->delete(); // Eliminar registro del enlace
            }
    
            // Eliminar el directorio de la página en el almacenamiento
            $paginaSlug = Str::slug($pagina->slug);
            $directoryPath = "paginas/{$paginaSlug}";
            if (Storage::disk('public')->exists($directoryPath)) {
                Storage::disk('public')->deleteDirectory($directoryPath);
            }
    
            session(['nombre' => $pagina->titulo]);
            session(['slug' => $pagina->slug]);
            session(['paginaData' => $pagina]);

            // Finalmente, eliminar la página
            $pagina->delete();

            // Registrar en el log
            $this->log('Eliminación', session('slug'), 'Eliminó el registro: "' . session('nombre') . '" con la informacion "'. session('paginaData') .'"');
            session()->forget(['nombre', 'slug','paginaData']);
    
            return redirect()->route('paginas.index')->with('success', 'Página y sus archivos eliminados correctamente');
        } catch (\Exception $e) {
            return redirect()->route('paginas.index')->with('error', 'Hubo un problema al eliminar la página: ' . $e->getMessage());
        }
    }
    
    private function guardarImagenDestacada($file)
    {
        $folder = 'paginas/imagenes_destacadas';
        $slugFileName = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
        $fileExtension = $file->getClientOriginalExtension();
        $fileName = time() . '_' . $slugFileName . '.' . $fileExtension;

        // Guardar el archivo utilizando storeAs
        $filePath = $file->storeAs($folder, $fileName, 'public');

        return $filePath;
    }
    
    public function uploadImage(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('ckeditor/images', $filename, 'public');
    
            $url = Storage::disk('public')->url($path);
    
            return response()->json([
                'uploaded' => true,
                'url' => $url
            ]);
        }
    
        return response()->json([
            'uploaded' => false,
            'error' => [
                'message' => 'No file uploaded.'
            ]
        ]);
    }

    public function log($accion, $lugar, $informacion)
    {
        HistorialLog::create([
            'usuario_id' => Auth::user()->id,
            'usuario_nombre' => Auth::user()->name,
            'modulo' => 'Pagina',
            'accion' => $accion,
            'lugar' => $lugar,
            'informacion' => $informacion,
            'fecha_accion' => now(),
        ]);
    }
}
