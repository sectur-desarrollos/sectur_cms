<?php

namespace App\Http\Controllers;

use App\Models\EnlaceV2;
use App\Models\PaginaV2;
use App\Models\SeccionV2;
use App\Models\HistorialLog;
use App\Models\SubseccionV2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnlaceV2Controller extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'url' => 'required|string|url',
            'ordenamiento' => 'required|integer',
            'entity_id' => 'required|integer',
            'entity_type' => 'required|string|in:pagina,seccion,subseccion',
            'folder' => 'required|string'
        ]);
    
        $validated['activo'] = $request->has('activoEnlace');
    
        $entityType = $request->input('entity_type');
        $entityId = $request->input('entity_id');
        $entity = $this->getEnlaceable($entityType, $entityId);
    
        $entity->enlaces()->create($validated);

        // Registrar en el log
        $this->log('Creación', $validated['folder'], 'Agregó el registro: "' . $validated['nombre'] . '" con enlace '. $validated['url']);
    
        return redirect()->back()->with('success', 'Enlace agregado correctamente');
    }

    public function update(Request $request, $type, $id, EnlaceV2 $enlace)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'url' => 'required|string|url',
            'ordenamiento' => 'required|integer',
            'folder' => 'required|string'
        ]);

        $validated['activo'] = $request->has('activoEnlaceEditar');

        $enlace->update($validated);

        // Registrar en el log
        $this->log('Actualización', $validated['folder'], 'Actualizó registro: "' . $validated['nombre'] . '" con enlace '. $validated['url']);
    
        return redirect()->back()->with('success', 'Enlace actualizado correctamente');
    }

    public function destroy($type, $id, EnlaceV2 $enlace)
    {

        if($type == 'pagina'){
            $pagina = PaginaV2::findOrFail($id);
            $folder = $pagina->slug;
        } elseif ($type == 'seccion') {
            $seccion = SeccionV2::with('pagina')->where('id', $id)->first();
            $folder = $seccion->pagina->slug . '/'. $seccion->slug;
        } elseif ($type == 'subseccion') {
            $subseccion = SubseccionV2::with('seccion.pagina')->where('id', $id)->first();
            $folder = $subseccion->seccion->pagina->slug . '/'. $subseccion->seccion->slug . '/' . $subseccion->slug;
        }

        session(['url' => $enlace->url]);
        session(['nombre' => $enlace->nombre]);

        $enlace->delete();

        // Registrar en el log
        $this->log('Eliminación', $folder, 'Eliminó el registro: "' . session('nombre') . '" con enlace '. session('url'));
        session()->forget(['url', 'nombre']);


        return redirect()->back()->with('success', 'Enlace eliminado correctamente');
    }

    private function getEnlaceable($type, $id)
    {
        switch ($type) {
            case 'pagina':
                return PaginaV2::findOrFail($id);
            case 'seccion':
                return SeccionV2::findOrFail($id);
            case 'subseccion':
                return SubseccionV2::findOrFail($id);
            default:
                throw new \Exception("Invalid type");
        }
    }
    
    public function log($accion, $lugar, $informacion)
    {
        HistorialLog::create([
            'usuario_id' => Auth::user()->id,
            'usuario_nombre' => Auth::user()->name,
            'modulo' => 'Enlace',
            'accion' => $accion,
            'lugar' => $lugar,
            'informacion' => $informacion,
            'fecha_accion' => now(),
        ]);
    }
}
