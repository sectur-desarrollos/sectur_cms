<?php

namespace App\Http\Controllers;

use App\Models\EnlaceV2;
use App\Models\PaginaV2;
use App\Models\SeccionV2;
use App\Models\SubseccionV2;
use Illuminate\Http\Request;

class EnlaceV2Controller extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'url' => 'required|string|url',
            'ordenamiento' => 'required|integer',
            'entity_id' => 'required|integer',
            'entity_type' => 'required|string|in:pagina,seccion,subseccion'
        ]);
    
        $validated['activo'] = $request->has('activoEnlace');
    
        $entityType = $request->input('entity_type');
        $entityId = $request->input('entity_id');
        $entity = $this->getEnlaceable($entityType, $entityId);
    
        $entity->enlaces()->create($validated);
    
        return redirect()->back()->with('success', 'Enlace agregado correctamente');
    }

    public function update(Request $request, $type, $id, EnlaceV2 $enlace)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'url' => 'required|string|url',
            'ordenamiento' => 'required|integer',
        ]);

        $validated['activo'] = $request->has('activoEnlaceEditar');

        $enlace->update($validated);
        return redirect()->back()->with('success', 'Enlace actualizado correctamente');
    }

    public function destroy($type, $id, EnlaceV2 $enlace)
    {
        $enlace->delete();
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
}
