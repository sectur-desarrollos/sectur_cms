<?php

namespace App\Http\Controllers;

use App\Models\PaginaV2;
use App\Models\SeccionV2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SeccionV2Controller extends Controller
{
    public function index(Request $request, PaginaV2 $pagina)
    {
        // Validar el campo de búsqueda
        $request->validate([
            'search' => 'nullable|string|max:255',
        ]);
    
        $search = $request->input('search', '');
    
        // Construir la consulta
        $query = $pagina->secciones();
    
        if (!empty($search)) {
            $query->where('titulo', 'like', "%{$search}%");
        }
    
        $secciones = $query->paginate(10);
    
        return view('admin-v2.seccion.index', compact('pagina', 'secciones', 'search'));
    }
    

    public function store(Request $request, PaginaV2 $pagina)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'slug' => 'required|string',
            'ordenamiento' => 'required|integer',
        ]);

        $validated['activo'] = $request->has('activoCrear');

        $pagina->secciones()->create($validated);
        return redirect()->route('paginas.secciones.index', $pagina)->with('success', 'Sección creada exitosamente.');
    }

    public function edit(PaginaV2 $pagina, SeccionV2 $seccion)
    {
        return view('admin-v2.seccion.edit', compact('pagina', 'seccion'));
    }

    public function update(Request $request, PaginaV2 $pagina, SeccionV2 $seccion)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            // 'slug' => 'required|string|unique:secciones,slug,' . $seccion->id,
            'ordenamiento' => 'required|integer',
        ]);

        $validated['activo'] = $request->has('activoEditar');

        $seccion->update($validated);

        return redirect()->route('paginas.secciones.index', $pagina)->with('success', 'Sección actualizada exitosamente.');
    }

    public function destroy(PaginaV2 $pagina, SeccionV2 $seccion)
    {
        try {
            // Eliminar archivos relacionados
            foreach ($seccion->archivos as $archivo) {
                Storage::disk('public')->delete($archivo->path); // Eliminar archivo del almacenamiento
                $archivo->delete(); // Eliminar registro del archivo
            }
    
            // Eliminar enlaces relacionados
            foreach ($seccion->enlaces as $enlace) {
                $enlace->delete(); // Eliminar registro del enlace
            }
    
            // Eliminar el directorio de la sección en el almacenamiento
            $paginaSlug = Str::slug($pagina->slug);
            $seccionSlug = Str::slug($seccion->slug);
            $directoryPath = "paginas/{$paginaSlug}/secciones/{$seccionSlug}";
            if (Storage::disk('public')->exists($directoryPath)) {
                Storage::disk('public')->deleteDirectory($directoryPath);
            }
    
            // Finalmente, eliminar la sección
            $seccion->delete();
    
            return redirect()->route('paginas.secciones.index', $pagina)->with('success', 'Sección y sus archivos eliminados correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('paginas.secciones.index', $pagina)->with('error', 'Hubo un problema al eliminar la sección: ' . $e->getMessage());
        }
    }

    public function contenido(PaginaV2 $pagina, SeccionV2 $seccion)
    {
        $archivos = $seccion->archivos()->paginate(10);
        $enlaces = $seccion->enlaces()->paginate(10);

        return view('admin-v2.seccion.contenido', compact('pagina', 'seccion', 'archivos', 'enlaces'));
    }
}