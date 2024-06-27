<?php

namespace App\Http\Controllers;

use App\Models\ArchivoV2;
use App\Models\PaginaV2;
use App\Models\SeccionV2;
use App\Models\SubseccionV2;
use App\Models\HistorialLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ArchivoV2Controller extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'archivo' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt,png,jpg|max:25480', // 20MB max
            'ordenamiento' => 'required|integer',
            'entity_id' => 'required|integer',
            'entity_type' => 'required|string|in:pagina,seccion,subseccion'
        ]);


        $validated['activo'] = $request->has('activoArchivo');

        $file = $request->file('archivo');
        $entityType = $request->input('entity_type');
        $entityId = $request->input('entity_id');

        // Determinar la ruta de almacenamiento
        $entity = null;
        $folder = '';
        if ($entityType === 'pagina') {
            $entity = PaginaV2::findOrFail($entityId);
            $folder = 'paginas/' . Str::slug($entity->slug);
        } elseif ($entityType === 'seccion') {
            $entity = SeccionV2::findOrFail($entityId);
            $folder = 'paginas/' . Str::slug($entity->pagina->slug) . '/secciones/' . Str::slug($entity->titulo);
        } elseif ($entityType === 'subseccion') {
            $entity = SubseccionV2::findOrFail($entityId);
            $folder = 'paginas/' . Str::slug($entity->seccion->pagina->slug) . '/secciones/' . Str::slug($entity->seccion->titulo) . '/subsecciones/' . Str::slug($entity->titulo);
        }

        // Crear el nombre del archivo en forma de slug
        $slugFileName = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
        $fileExtension = $file->getClientOriginalExtension();
        $fileName = time() . '_' . $slugFileName . '.' . $fileExtension;

        // Guardar el archivo utilizando storeAs
        $filePath = $file->storeAs($folder, $fileName, 'public');

        // Guardar la ruta sin 'public/' para acceder correctamente desde el navegador
        $validated['path'] = $filePath;
        $validated['tipo'] = $fileExtension;
        $validated['tamaño'] = $this->tamanoArchivo($file);
        
        if ($entityType === 'pagina') {
            $validated['pagina_id'] = $entity->id;
        } elseif ($entityType === 'seccion') {
            $validated['seccion_id'] = $entity->id;
        } elseif ($entityType === 'subseccion') {
            $validated['subseccion_id'] = $entity->id;
        }

        ArchivoV2::create($validated);

         // Registrar en el log
        $this->log('Creación', $folder, 'Agregó el registro: "' . $validated['nombre'] . '" con archivo '. $fileName);

        return redirect()->back()->with('success', 'Archivo subido y guardado correctamente');
    }

    public function update(Request $request, ArchivoV2 $archivo)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'archivo' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt,png,jpg|max:20480', // 20MB max
            'ordenamiento' => 'required|integer',
            'activo' => 'nullable|boolean',
        ]);
    
        $validated['activo'] = $request->has('activoArchivoEditar');
    
        $folder = '';
        $fileName = '';
        // Solo eliminar y reemplazar el archivo si se ha subido uno nuevo
        if ($request->hasFile('archivo')) {
            // Eliminar el archivo actual del servidor
            Storage::disk('public')->delete($archivo->path);
    
            $file = $request->file('archivo');
            $entityType = $archivo->pagina_id ? 'pagina' : ($archivo->seccion_id ? 'seccion' : 'subseccion');
            $entityId = $archivo->pagina_id ?? $archivo->seccion_id ?? $archivo->subseccion_id;
    
            // Determinar la ruta de almacenamiento
            $entity = null;
            if ($entityType === 'pagina') {
                $entity = PaginaV2::findOrFail($entityId);
                $folder = 'paginas/' . Str::slug($entity->slug);
            } elseif ($entityType === 'seccion') {
                $entity = SeccionV2::findOrFail($entityId);
                $folder = 'paginas/' . Str::slug($entity->pagina->slug) . '/secciones/' . Str::slug($entity->titulo);
            } elseif ($entityType === 'subseccion') {
                $entity = SubseccionV2::findOrFail($entityId);
                $folder = 'paginas/' . Str::slug($entity->seccion->pagina->slug) . '/secciones/' . Str::slug($entity->seccion->titulo) . '/subsecciones/' . Str::slug($entity->titulo);
            }
    
            // Crear el nombre del archivo en forma de slug
            $slugFileName = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
            $fileExtension = $file->getClientOriginalExtension();
            $fileName = time() . '_' . $slugFileName . '.' . $fileExtension;
    
            // Guardar el nuevo archivo utilizando storeAs
            $filePath = $file->storeAs($folder, $fileName, 'public');
    
            // Guardar la ruta sin 'public/' para acceder correctamente desde el navegador
            $validated['path'] = $filePath;
            $validated['tipo'] = $fileExtension;
            $validated['tamaño'] = $this->tamanoArchivo($file);
        }
    
        $archivo->update($validated);

        if($folder == '' && $fileName == ''){
            $folder = $archivo->path;
            $fileName = $archivo->path;
        }

        // Registrar en el log
        $this->log('Actualización', $folder, 'Actualizó registro: "' . $validated['nombre'] . '" con archivo '. $fileName);
    
        return redirect()->back()->with('success', 'Archivo actualizado y guardado correctamente');
    }
    

    public function destroy(ArchivoV2 $archivo)
    {
        try {

            session(['folder' => $archivo->path]);
            session(['archivoNombre' => $archivo->nombre]);

            // Eliminar el archivo del servidor
            Storage::disk('public')->delete($archivo->path);

            $archivo->delete();

            // Registrar en el log
            $this->log('Eliminación', session('folder'), 'Eliminó el registro: ' . session('archivoNombre'));
            session()->forget(['folder', 'archivoNombre']);

            return redirect()->back()->with('success', 'Archivo eliminado correctamente');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'No se pudo eliminar archivo');
        }
    }

    public function tamanoArchivo($file)
    {
        // Tamaño del archivo
        $fileSize = $file->getSize();
        $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
        $power = $fileSize > 0 ? floor(log($fileSize, 1024)) : 0;
        $fileSizeFormatted = number_format($fileSize / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
    
        return $fileSizeFormatted;
    }

    public function log($accion, $lugar, $informacion)
    {
        HistorialLog::create([
            'usuario_id' => Auth::user()->id,
            'usuario_nombre' => Auth::user()->name,
            'modulo' => 'Archivo',
            'accion' => $accion,
            'lugar' => $lugar,
            'informacion' => $informacion,
            'fecha_accion' => now(),
        ]);
    }
}
