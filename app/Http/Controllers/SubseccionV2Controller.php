<?php

namespace App\Http\Controllers;

use App\Models\SeccionV2;
use App\Models\SubseccionV2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SubseccionV2Controller extends Controller
{
    public function index(Request $request, SeccionV2 $seccion)
    {
        // Validar el campo de búsqueda
        $request->validate([
            'search' => 'nullable|string|max:255',
        ]);

        $search = $request->input('search', '');

        $query = $seccion->subsecciones();
        
        if (!empty($search)) {
            $query->where('titulo', 'like', "%{$search}%");
        }
        
        $subsecciones = $query->paginate(10);
    
        return view('admin-v2.subsecciones.index', compact('seccion', 'subsecciones', 'search'));
    }

    public function create(SeccionV2 $seccion)
    {
        return view('admin-v2.subsecciones.create', compact('seccion'));
    }

    public function store(Request $request, SeccionV2 $seccion)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'slug' => 'required|string',
            'ordenamiento' => 'required|integer',
        ]);

        $validated['activo'] = $request->has('activoCrear');

        $seccion->subsecciones()->create($validated);
        return redirect()->route('secciones.subsecciones.index', $seccion)->with('success', 'Subsección creada correctamente.');
    }

    public function edit(SeccionV2 $seccion, SubseccionV2 $subseccion)
    {
        return view('admin-v2.subsecciones.edit', compact('seccion', 'subseccion'));
    }

    public function update(Request $request, SeccionV2 $seccion, SubseccionV2 $subseccion)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'ordenamiento' => 'required|integer',
        ]);
        
        $validated['activo'] = $request->has('activoEditar');
        
        $subseccion->update($validated);
        return redirect()->route('secciones.subsecciones.index', $seccion)->with('success', 'Subsección actualizada correctamente.');
    }

    public function destroy(SeccionV2 $seccion, SubseccionV2 $subseccion)
    {
        try {
            // Eliminar archivos relacionados
            foreach ($subseccion->archivos as $archivo) {
                Storage::disk('public')->delete($archivo->path); // Eliminar archivo del almacenamiento
                $archivo->delete(); // Eliminar registro del archivo
            }

            // Eliminar enlaces relacionados
            foreach ($subseccion->enlaces as $enlace) {
                $enlace->delete(); // Eliminar registro del enlace
            }

            // Eliminar el directorio de la subsección en el almacenamiento
            $paginaSlug = Str::slug($seccion->pagina->slug);
            $seccionSlug = Str::slug($seccion->slug);
            $subseccionSlug = Str::slug($subseccion->slug);
            $directoryPath = "paginas/{$paginaSlug}/secciones/{$seccionSlug}/subsecciones/{$subseccionSlug}";
            if (Storage::disk('public')->exists($directoryPath)) {
                Storage::disk('public')->deleteDirectory($directoryPath);
            }

            // Finalmente, eliminar la subsección
            $subseccion->delete();

            return redirect()->route('secciones.subsecciones.index', $seccion)->with('success', 'Subsección y sus archivos eliminados correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('secciones.subsecciones.index', $seccion)->with('error', 'Hubo un problema al eliminar la subsección: ' . $e->getMessage());
        }
    }

    public function contenido(SeccionV2 $seccion, SubseccionV2 $subseccion)
    {
        $archivos = $subseccion->archivos()->paginate(10);
        $enlaces = $subseccion->enlaces()->paginate(10);

        return view('admin-v2.subsecciones.contenido', compact('seccion', 'subseccion', 'archivos', 'enlaces'));
    }
}
