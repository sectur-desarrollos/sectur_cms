<?php

namespace App\Http\Controllers;

use App\Models\Pagina;
use App\Rules\Recaptcha;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:admin.roles.index')->only('index');
        $this->middleware('can:admin.roles.create')->only('create', 'store');
        $this->middleware('can:admin.roles.edit')->only('edit', 'update');
        $this->middleware('can:admin.roles.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('roles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        $paginas = Pagina::select("titulo", "id")
                    ->where('estado','Si')
                    ->get();

        return view('roles.create', compact('permissions','paginas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $valores = $request->all();

        $request->validate([
            'name'                  => 'required',
            //'g-recaptcha-response'  => ['required', new Recaptcha],
        ]);
        
        $rol = Role::create($valores);

        $rol->permissions()->sync($request->permissions);

        return redirect()->route('roles.edit', $rol->id)->with('success', 'Registro creado exitosamente');
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
        $role = Role::findOrFail($id);
        $permissions = Permission::all();

        $paginas = Pagina::select("titulo", "id")
                        ->where('estado','Si')
                        ->get();
        
        $paginasRol = explode(',',$role->paginas);

        foreach ($paginasRol as $key => $rol) {
            $paginasActuales = Pagina::select("titulo", "id")
                                ->where('estado','Si')
                                ->where('id', $rol)
                                ->get();
        }
        $paginas = Arr::collapse([$paginas,$paginasActuales]);
        
        $paginas = collect($paginas);

        return view('roles.edit', compact('role', 'permissions', 'paginas'));
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
        $valores = $request->all();

        $request->validate([
            'name'                  => 'required',
            //'g-recaptcha-response'  => ['required', new Recaptcha],
        ]);

        $role = Role::findOrFail($id);
        
        $role->update($valores);

        $role->permissions()->sync($request->permissions);

        return redirect()->route('roles.edit', $role->id)->with('success', 'Registro actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return redirect()->route('roles.index', $role->id)->with('success', 'Registro eliminado exitosamente');
    }

    public function rolesDatatables()
    {
        return FacadesDataTables::eloquent(Role::orderBy('name', 'asc'))
        ->addColumn('btn', 'roles.actions')
        ->rawColumns(['btn'])
        ->toJson();
    }

    // Función asincrona para enviar información a la vista de las paginas (SELECT2)
    // public function paginaSearch(Request $request)
    // {
    //     $data = Pagina::where('estado','Si')->get();

    //     if($request->filled('q')){
    //         $data = Pagina::select("titulo", "id")
    //                     ->where('estado','Si')
    //                     ->where('titulo', 'LIKE', '%'. $request->get('q'). '%')
    //                     ->get();
    //     }
    
    //     return response()->json($data);
    // }
}
