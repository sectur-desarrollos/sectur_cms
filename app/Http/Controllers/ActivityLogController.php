<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Pagina;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;
use Illuminate\Support\Str;

class ActivityLogController extends Controller
{
    public function index()
    {
        return view('activity-logs.index');
    }

    public function show($id)
    {
        $log = Activity::findOrFail($id);

        $logs = Activity::where('id', $id)->get();

        // Declarando variables en caso de que no existan en una vista
        $nombrePag = '';
        $propiedadesAntiguas = null;
        $propiedadesActualizadas = null;
        $propiedadesEliminadas = null;
        
        /* 
        if($log->log_name == 'Archivo'){

            foreach($logs as $value){
                foreach($value->properties as $propiedad){
                    $pagina = Pagina::where('id', $propiedad['pagina_id'])->select('titulo')->get();
                }
            }
            $nombrePagina = json_encode($pagina, JSON_UNESCAPED_UNICODE);
            $nombrePag = Str::between($nombrePagina, '[{"titulo":"', '"}]');

        }

        //Con base al evento de un log se obtiene el evento y las propiedades de un log, ya sea para crear, actualizar ó eliminar.
        if($log->event == 'created'){
            $propiedades = $log->properties;
            $evento = 'created';
        }
        
        if($log->event == 'updated'){
            $propiedades = $log->properties;
            $propiedadesAntiguas = $propiedades['old'];
            $propiedadesActualizadas = $propiedades['attributes'];
            $evento = 'updated';
        }
        
        if($log->event == 'deleted'){
            $propiedades = $log->properties;
            $propiedadesEliminadas = $propiedades['old'];
            $evento = 'deleted';
        }

        return view('activity-logs.show', [
                                            'log' => $log, 
                                            'propiedades' => $propiedades, 
                                            'evento' => $evento, 
                                            'pagina' => $nombrePag,
                                            'propiedadesAntiguas' => $propiedadesAntiguas,
                                            'propiedadesActualizado' => $propiedadesActualizadas,
                                            'propiedadesEliminadas' => $propiedadesEliminadas,
                                        ]);
 */
        
        switch ($log->log_name) {
            case 'Archivo':
                foreach($logs as $value){
                    foreach($value->properties as $propiedad){
                        $pagina = Pagina::where('id', $propiedad['pagina_id'])->select('titulo')->get();
                    }
                }
                $nombrePagina = json_encode($pagina, JSON_UNESCAPED_UNICODE);
                $nombrePag = Str::between($nombrePagina, '[{"titulo":"', '"}]');
    
                //Con base al evento de un log se obtiene el evento y las propiedades de un log, ya sea para crear, actualizar ó eliminar.
                if($log->event == 'created'){
                    $propiedades = $log->properties;
                    $evento = 'created';
                }
                
                if($log->event == 'updated'){
                    $propiedades = $log->properties;
                    $propiedadesAntiguas = $propiedades['old'];
                    $propiedadesActualizadas = $propiedades['attributes'];
                    $evento = 'updated';
                }
                
                if($log->event == 'deleted'){
                    $propiedades = $log->properties;
                    $propiedadesEliminadas = $propiedades['old'];
                    $evento = 'deleted';
                }

                return view('activity-logs.show', [
                                                    'log'                       => $log, 
                                                    'propiedades'               => $propiedades, 
                                                    'evento'                    => $evento, 
                                                    'pagina'                    => $nombrePag,
                                                    'propiedadesAntiguas'       => $propiedadesAntiguas,
                                                    'propiedadesActualizado'    => $propiedadesActualizadas,
                                                    'propiedadesEliminadas'     => $propiedadesEliminadas,
                                                ]);

            break;
            
            case 'Página':

                    //Con base al evento de un log se obtiene el evento y las propiedades de un log, ya sea para crear, actualizar ó eliminar.
                    if($log->event == 'created'){
                        $propiedades = $log->properties;
                        $evento = 'created';
                    }
                    
                    if($log->event == 'updated'){
                        $propiedades = $log->properties;
                        $propiedadesAntiguas = $propiedades['old'];
                        $propiedadesActualizadas = $propiedades['attributes'];
                        $evento = 'updated';
                    }
                    
                    if($log->event == 'deleted'){
                        $propiedades = $log->properties;
                        $propiedadesEliminadas = $propiedades['old'];
                        $evento = 'deleted';
                    }

                    return view('activity-logs.show', [
                                                        'log'                       => $log, 
                                                        'propiedades'               => $propiedades, 
                                                        'evento'                    => $evento, 
                                                        'pagina'                    => $nombrePag,
                                                        'propiedadesAntiguas'       => $propiedadesAntiguas,
                                                        'propiedadesActualizadas'   => $propiedadesActualizadas,
                                                        'propiedadesEliminadas'     => $propiedadesEliminadas,
                                                    ]);
            break;

            case 'Menú':
                foreach($logs as $value){
                    foreach($value->properties as $propiedad){
                        $menu = Menu::where('id', $propiedad['parent'])->select('name')->get();
                    }
                }
                $nombreM = json_encode($menu, JSON_UNESCAPED_UNICODE);
                $nombreMenu = Str::between($nombreM, '[{"name":"', '"}]');
    
                //Con base al evento de un log se obtiene el evento y las propiedades de un log, ya sea para crear, actualizar ó eliminar.
                if($log->event == 'created'){
                    $propiedades = $log->properties;
                    $evento = 'created';
                }
                
                if($log->event == 'updated'){
                    $propiedades = $log->properties;
                    $propiedadesAntiguas = $propiedades['old'];
                    $propiedadesActualizadas = $propiedades['attributes'];
                    $evento = 'updated';
                }
                
                if($log->event == 'deleted'){
                    $propiedades = $log->properties;
                    $propiedadesEliminadas = $propiedades['old'];
                    $evento = 'deleted';
                }

                return view('activity-logs.show', [
                                                    'log'                       => $log, 
                                                    'propiedades'               => $propiedades, 
                                                    'evento'                    => $evento, 
                                                    'pagina'                    => $nombrePag,
                                                    'propiedadesAntiguas'       => $propiedadesAntiguas,
                                                    'propiedadesActualizadas'   => $propiedadesActualizadas,
                                                    'propiedadesEliminadas'     => $propiedadesEliminadas,
                                                    'menu'                      => $nombreMenu
                                                ]);
            break;
            
            case 'Footer':
                //Con base al evento de un log se obtiene el evento y las propiedades de un log, ya sea para crear, actualizar ó eliminar.
                if($log->event == 'created'){
                    $propiedades = $log->properties;
                    $evento = 'created';
                }
                
                if($log->event == 'updated'){
                    $propiedades = $log->properties;
                    $propiedadesAntiguas = $propiedades['old'];
                    $propiedadesActualizadas = $propiedades['attributes'];
                    $evento = 'updated';
                }
                
                if($log->event == 'deleted'){
                    $propiedades = $log->properties;
                    $propiedadesEliminadas = $propiedades['old'];
                    $evento = 'deleted';
                }
                
                return view('activity-logs.show', [
                                                    'log'                       => $log, 
                                                    'propiedades'               => $propiedades, 
                                                    'evento'                    => $evento, 
                                                    'pagina'                    => $nombrePag,
                                                    'propiedadesAntiguas'       => $propiedadesAntiguas,
                                                    'propiedadesActualizadas'   => $propiedadesActualizadas,
                                                    'propiedadesEliminadas'     => $propiedadesEliminadas,
                                                ]);
            break;

            case 'Usuario':

                // Inicializando arreglos vacíos para almacenar los nombres de las páginas
                $nomPageAntiguas = [];
                $nomPageAntiguasFinal = [];
                $page = [];
                $paginasEncontradas = [];
                $paginasNuevas = [];

                //Con base al evento de un log se obtiene el evento y las propiedades de un log, ya sea para crear, actualizar ó eliminar.
                if($log->event == 'created'){
                    $propiedades = $log->properties;
                    $evento = 'created';
                    /* Aquí empieza para obtener los titulos de las páginas */
                        foreach($logs as $value){
                            foreach($value->properties as $propiedad){
                                $usuario = User::where('id', $propiedad['id'])->get();
                            }
                        }
                        // Se crea un ciclo que va a recorrer por las páginas encontradas del usuario autenticado
                        foreach($usuario as $key => $usr)
                        {
                            // Se crea un ciclo anidado que va a ir encontrando las páginas según las que tenga asignadas un usuario
                            foreach($usr->paginas as $pagina)
                            {
                                // Las páginas encontradas se van a ir almacenando en el arreglo "page", cada página encontrada
                                // Es un espacio del arreglo. Aunado que obtendrá la págin, también va a obtener toda la información
                                // De la página, atributos junto con los botones de acciones (Editar, Ver, Eliminar)
                                $page[] = FacadesDataTables::eloquent(\App\Models\Pagina::orderBy('created_at', 'asc')->where('id', $pagina))
                                            ->addColumn('btn', function(Pagina $pagina) {
                                                return view('paginas.actions', compact('pagina'));
                                            })
                                            ->rawColumns(['btn'])
                                            ->toJson();
                            }
                            
                        }

                        // Se crea un ciclo para hacer una iteración por el tamaño de páginas encontradas asignadas a un usuario.
                        // Por ejemplo, si un usuario tiene 3 páginas asignadas, va a tener 3 recorrdos este ciclo.
                        // El ciclo va a guardar dentro del arreglo "$paginasEncontradas" los atributos "data" de un objeto ResponseJson
                        // Y por cadda página que vaya encontrando va a ir guardandolos en un espacio dentro del arreglo.
                        // Nota: getData() es un objeto
                        foreach ($page as $key => $paginas) {
                            $paginasEncontradas[] = $paginas->getData();
                        }
                        
                        // Se crea un último arreglo para que por cada objeto que haya sido almacenado en "paginasEncontradas" se obtengan
                        // Loa atributos/propiedades de ese objeto, para acceder a esos datos se usa "$item->data"
                        // $paginasNuevas = [];
                        foreach ($paginasEncontradas as $item) {
                            $paginasNuevas[] = $item->data;
                        }
                    /* Aquí finaliza para obtener los titulos de las páginas */   
                }
                
                if($log->event == 'updated'){
                    $propiedades = $log->properties;
                    $propiedadesAntiguas = $propiedades['old'];
                    $propiedadesActualizadas = $propiedades['attributes'];
                    $evento = 'updated';

                    /* Aquí empieza para obtener los titulos de las páginas */
                        foreach($logs as $value){
                            foreach($value->properties as $propiedad){
                                $usuario = User::where('id', $propiedad['id'])->get();
                            }
                        }
                        
                        // Este ciclo obtiene únicamente el titulo en colecciones
                        foreach($propiedadesAntiguas['paginas'] as $pagina){
                            $nomPageAntiguas[] = Pagina::where('id', $pagina)->select('titulo')->get();
                        }

                        // Este ciclo obtiene los titulos de las colecciones
                        foreach($nomPageAntiguas as $key => $nPagina){
                            foreach($nPagina as $pagina){
                                $nomPageAntiguasFinal[] = $pagina->titulo;
                            }
                        }
                        
                        
                        
                        // Se obtiene el usuario autenticado por ID
                        // $usuario = User::where('id', $propiedades['id'])->get();

                        // Se crea un arreglo vacío para almacenar las páginas encontradas con Datatables
                        // $page = [];

                        // Se crea un arreglo vacío que va a almacenar las páginas finales encontradas
                        // $paginasEncontradas = [];

                        // Se crea un ciclo que va a recorrer por las páginas encontradas del usuario autenticado
                        foreach($usuario as $key => $usr)
                        {
                            // Se crea un ciclo anidado que va a ir encontrando las páginas según las que tenga asignadas un usuario
                            foreach($usr->paginas as $pagina)
                            {
                                // Las páginas encontradas se van a ir almacenando en el arreglo "page", cada página encontrada
                                // Es un espacio del arreglo. Aunado que obtendrá la págin, también va a obtener toda la información
                                // De la página, atributos junto con los botones de acciones (Editar, Ver, Eliminar)
                                $page[] = FacadesDataTables::eloquent(\App\Models\Pagina::orderBy('created_at', 'asc')->where('id', $pagina))
                                            ->addColumn('btn', function(Pagina $pagina) {
                                                return view('paginas.actions', compact('pagina'));
                                            })
                                            ->rawColumns(['btn'])
                                            ->toJson();
                            }
                            
                        }

                        // Se crea un ciclo para hacer una iteración por el tamaño de páginas encontradas asignadas a un usuario.
                        // Por ejemplo, si un usuario tiene 3 páginas asignadas, va a tener 3 recorrdos este ciclo.
                        // El ciclo va a guardar dentro del arreglo "$paginasEncontradas" los atributos "data" de un objeto ResponseJson
                        // Y por cadda página que vaya encontrando va a ir guardandolos en un espacio dentro del arreglo.
                        // Nota: getData() es un objeto
                        foreach ($page as $key => $paginas) {
                            $paginasEncontradas[] = $paginas->getData();
                        }
                        
                        // Se crea un último arreglo para que por cada objeto que haya sido almacenado en "paginasEncontradas" se obtengan
                        // Loa atributos/propiedades de ese objeto, para acceder a esos datos se usa "$item->data"
                        // $paginasNuevas = [];
                        foreach ($paginasEncontradas as $item) {
                            $paginasNuevas[] = $item->data;
                        }
                    /* Aquí finaliza para obtener los titulos de las páginas */   
                }
                
                if($log->event == 'deleted'){
                    $propiedades = $log->properties;
                    $propiedadesEliminadas = $propiedades['old'];
                    $evento = 'deleted';
                    /* Aquí empieza para obtener los titulos de las páginas */
                        foreach($logs as $value){
                            foreach($value->properties as $propiedad){
                                $usuario = User::where('id', $propiedad['id'])->get();
                            }
                        }
                        
                        // Este ciclo obtiene únicamente el titulo en colecciones
                        foreach($propiedadesEliminadas['paginas'] as $pagina){
                            $nomPageAntiguas[] = Pagina::where('id', $pagina)->select('titulo')->get();
                        }

                        // Este ciclo obtiene los titulos de las colecciones
                        foreach($nomPageAntiguas as $key => $nPagina){
                            foreach($nPagina as $pagina){
                                $nomPageAntiguasFinal[] = $pagina->titulo;
                            }
                        }
                        
                        
                        
                        // Se obtiene el usuario autenticado por ID
                        // $usuario = User::where('id', $propiedades['id'])->get();

                        // Se crea un arreglo vacío para almacenar las páginas encontradas con Datatables
                        // $page = [];

                        // Se crea un arreglo vacío que va a almacenar las páginas finales encontradas
                        // $paginasEncontradas = [];

                        // Se crea un ciclo que va a recorrer por las páginas encontradas del usuario autenticado
                        foreach($usuario as $key => $usr)
                        {
                            // Se crea un ciclo anidado que va a ir encontrando las páginas según las que tenga asignadas un usuario
                            foreach($usr->paginas as $pagina)
                            {
                                // Las páginas encontradas se van a ir almacenando en el arreglo "page", cada página encontrada
                                // Es un espacio del arreglo. Aunado que obtendrá la págin, también va a obtener toda la información
                                // De la página, atributos junto con los botones de acciones (Editar, Ver, Eliminar)
                                $page[] = FacadesDataTables::eloquent(\App\Models\Pagina::orderBy('created_at', 'asc')->where('id', $pagina))
                                            ->addColumn('btn', function(Pagina $pagina) {
                                                return view('paginas.actions', compact('pagina'));
                                            })
                                            ->rawColumns(['btn'])
                                            ->toJson();
                            }
                            
                        }

                        // Se crea un ciclo para hacer una iteración por el tamaño de páginas encontradas asignadas a un usuario.
                        // Por ejemplo, si un usuario tiene 3 páginas asignadas, va a tener 3 recorrdos este ciclo.
                        // El ciclo va a guardar dentro del arreglo "$paginasEncontradas" los atributos "data" de un objeto ResponseJson
                        // Y por cadda página que vaya encontrando va a ir guardandolos en un espacio dentro del arreglo.
                        // Nota: getData() es un objeto
                        foreach ($page as $key => $paginas) {
                            $paginasEncontradas[] = $paginas->getData();
                        }
                        
                        // Se crea un último arreglo para que por cada objeto que haya sido almacenado en "paginasEncontradas" se obtengan
                        // Loa atributos/propiedades de ese objeto, para acceder a esos datos se usa "$item->data"
                        // $paginasNuevas = [];
                        foreach ($paginasEncontradas as $item) {
                            $paginasNuevas[] = $item->data;
                        }
                    /* Aquí finaliza para obtener los titulos de las páginas */
                }
                
                return view('activity-logs.show', [
                                                    'log'                       => $log, 
                                                    'propiedades'               => $propiedades, 
                                                    'evento'                    => $evento, 
                                                    'pagina'                    => $nombrePag,
                                                    'propiedadesAntiguas'       => $propiedadesAntiguas,
                                                    'propiedadesActualizadas'   => $propiedadesActualizadas,
                                                    'propiedadesEliminadas'     => $propiedadesEliminadas,
                                                    'paginas'                   => collect($paginasNuevas),
                                                    'nomPageAntiguas'           => $nomPageAntiguasFinal,
                                                ]);
            break;
            default:
                abort(404);
                break;
        }
    }

    public function activityLogsDatatables()
    {
        return FacadesDataTables::eloquent(Activity::with('causer')->orderBy('updated_at', 'desc'))
                ->addColumn('causer', function (Activity $activity) {
                    // return $activity->causer->name;
                    $user = User::where('id', $activity->causer_id)->select('name')->get();
                    $nombre_json = json_encode($user, JSON_UNESCAPED_UNICODE);
                    $nameUser = Str::between($nombre_json, '[{"name":"', '"}]');
                    return $nameUser;
                })
                ->addColumn('btn', 'activity-logs.actions')
                ->rawColumns(['btn'])
                ->toJson();
    }
}
