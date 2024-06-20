<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Pagina;
use App\Models\PaginaV2;
use App\Rules\Recaptcha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;

class MenuController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('can:admin.menus.index')->only('index');
        $this->middleware('can:admin.menus.create')->only('create', 'store');
        $this->middleware('can:admin.menus.edit')->only('edit', 'update');
        $this->middleware('can:admin.menus.destroy')->only('destroy');
    }

    public function index()
    {
        return view('menu.index');
    }

    public function create()
    {
        // $arreglo1 = Menu::all()->toArray();
        // $arreglo2 = Pagina::all()->toArray();
        // $arreglos = array_merge($arreglo1, $arreglo2);
        // dd($arreglos);

        $menus = Menu::menus();
        // dd($menus);
        // $menus = Menu::all();
        $paginas = DB::table('paginas_v2')->orderBy('titulo','asc')->get();
        return view('menu.create', compact('menus','paginas'));
    }

    public function store(Request $request)
    {

    
        $validated = $request->validate([
            'name'                  => 'required',
            'order'                 => 'required',
            'enabled'               => 'required',
            //'g-recaptcha-response'  => ['required', new Recaptcha]
        ]);

        // dd($request->all());
        // Si del request pagina_id no contiene nada se envía
        if(($request->pagina_id != '0') && (is_null($request->enlace))){
            $valoresMenu = $request->all();
            $pagina_id = $request->pagina_id;
            $paginaNombre = PaginaV2::findOrFail($pagina_id);
            $slugPagina = $paginaNombre->slug;

            $valoresMenu['nombre_pagina'] = $slugPagina;
	    $valoresMenu['menu_id'] = $request->parent;

            Menu::create($valoresMenu);
            return redirect()->route('menus.index')->with('success', 'Registro creado correctamente');
        }
        elseif(($request->pagina_id == '0') && (!is_null($request->enlace)))
        {
            $valoresMenu = $request->all();
            $valoresMenu['pagina_id'] = null;
            $valoresMenu['nombre_pagina'] = null;
	    $valoresMenu['menu_id'] = $request->parent;
            Menu::create($valoresMenu);
            return redirect()->route('menus.index')->with('success', 'Registro creado correctamente');
        }
    }

    public function edit($id)
    {
        // $menus = Menu::menus();
        $menus = Menu::all();
        $paginas = DB::table('paginas_v2')->orderBy('titulo','asc')->get();
        $menuData = Menu::findOrFail($id);
        
        return view('menu.edit', compact('menuData', 'menus', 'paginas'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name'                  => 'required',
            'order'                 => 'required',
            'enabled'               => 'required',
            //'g-recaptcha-response'  => ['required', new Recaptcha]
        ]);
        // $valoresMenu = $request->all();
        // $menu = Menu::find($id);
        // $menu->fill($valoresMenu);
        // $menu->save();
        // return redirect()->route('menus.index', $id)->with('success','Registro actualizado correctamente');
        //Esto de arriba no se mueve
        $menu = Menu::find($id);
        if(($request->pagina_id != '0') && (is_null($request->enlace))){
            $valoresMenu = $request->all();
           // $request->validate([
           //     'slug' => "unique:menus,slug,$menu->id",
           // ]);
            $pagina_id = $request->pagina_id;
            $paginaNombre = PaginaV2::findOrFail($pagina_id);
            $slugPagina = $paginaNombre->slug;

            $valoresMenu['nombre_pagina'] = $slugPagina;
            
            $menu->update($valoresMenu);
            return redirect()->route('menus.index')->with('success', 'Registro actualizado correctamente');
        }
        elseif(($request->pagina_id == '0') && (!is_null($request->enlace)))
        {
            $valoresMenu = $request->all();
            $valoresMenu['pagina_id'] = null;
            $valoresMenu['nombre_pagina'] = null;
            $menu->update($valoresMenu);
            return redirect()->route('menus.index')->with('success', 'Registro actualizado correctamente');
        }

    }

    public function destroy($id)
    {
        try{
            $menu = Menu::findOrFail($id);
            $menu->delete();
            return redirect()->route('menus.index')->with('success', 'Registro eliminado correctamente');
        } catch (\Illuminate\Database\QueryException $e){
            return redirect()->route('menus.index')->with('error',$e->getMessage());
        }
    }

    public function menusDatatables()
    {
        return FacadesDataTables::eloquent(\App\Models\Menu::orderBy('name', 'asc'))
                ->addColumn('btn', 'menu.actions')
                ->rawColumns(['btn'])
                ->toJson();
    }

    // Función que permite verificar de forma asincrona con AJAX 
    // si un SLUG ya existe dentro del sistema en el apartado de Menús
    function check(Request $request)
    {
        if($request->get('slug'))
        {
            $slug = $request->get('slug');

            $data = DB::table("menus")
                    ->where('slug', $slug)
                    ->count();

            if($data > 0)
            {
                echo 'not_unique';
            }
            else
            {
                echo 'unique';
            }
        }
    }

}
