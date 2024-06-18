<?php

namespace App\Http\Controllers;

use App\Models\Footer;
use App\Rules\Recaptcha;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;

class FooterController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.footers.index')->only('index');
        $this->middleware('can:admin.footers.create')->only('create', 'store');
        $this->middleware('can:admin.footers.edit')->only('edit', 'update');
        $this->middleware('can:admin.footers.destroy')->only('destroy');
    }

    public function index()
    {
        return view(('footer.index'));
    }

    public function create()
    {
        return view('footer.create');
    }

    public function store(Request $request)
    {

        $valorContenido = $request->all();

        $validated = $request->validate([
            'nombre'                => 'required',
            'tipo'                  => 'required',
            'estado'                => 'required',
            //'g-recaptcha-response'  => ['required', new Recaptcha]
        ]);

        Footer::create($valorContenido);

        return redirect()->route('footers.index')->with('success', 'Registro creado correctamente');
    }

    public function edit($id)
    {
        $contenidoFooter = Footer::findOrFail($id);

        return view('footer.edit', compact('contenidoFooter'));
    }

    public function update(Request $request, $id)
    {
        $valoresMenu = $request->all();

        $validated = $request->validate([
            'nombre'                => 'required',
            'tipo'                  => 'required',
            'estado'                => 'required',
            //'g-recaptcha-response'  => ['required', new Recaptcha]
        ]);

        $footer = Footer::find($id);
        $footer->fill($valoresMenu);
        $footer->save();

        return redirect()->route('footers.index')->with('success', 'Registro actualizado correctamente');
    }

    public function destroy($id)
    {
        try{
            $menu = Footer::findOrFail($id);
            $menu->delete();
            return redirect()->route('footers.index')->with('success', 'Registro eliminado correctamente');
        } catch (\Illuminate\Database\QueryException $e){
            return redirect()->route('footers.index')->with('error',$e->getMessage());
        }
    }

    public function footersDataTables()
    {
        return FacadesDataTables::eloquent(\App\Models\Footer::orderBy('tipo', 'asc'))
                ->addColumn('btn', 'footer.actions')
                ->rawColumns(['btn'])
                ->toJson();
    }
}
