<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('usuario.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuario.create');
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
	
        /* Reglas de validación del request */
        $validation = Validator::make($request->all(), [
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255'],
            'password'  => ['required', 'min:8'],
            'password2' => ['required', 'min:8'],
            'estado'    => ['required'],
            'rol'       => ['required'],
        ]);

        /* Fallo en caso de que las reglas de validación fallen */
        if ($validation->fails()) {
            return redirect()->back()->with('error','Por favor complete bien los campos')->withInput()->withErrors($validation);
        }

        /* Msj de error si el usuario es sonso y no hace caso al ajax :v que ya está en uso el correo */
        if (User::where('email', $valores['email'])->exists()) {
            return redirect()->back()->with('error','Correo electrónico ya existente, escoja otro')->withInput();
        }

        /* Mensaje de error si la contraseña no está bien confirmada */
        if ($valores['password']!=$valores['password2'])
            return redirect()->back()->with('error','Contraseñas no coinciden')->withInput();
        
        /*Se hashea la contraseña */
        $valores['password'] = Hash::make( $valores['password'] );

        /* Se llena el modelo con los datos en caso de que todo esté correcto */
        $registro = new User();
        $registro->fill($valores);
        $registro->save();

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado correctamente');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('usuario.edit', compact('user'));
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

        /* 
        Verificación si el input password2 está definida y es NULL
        En otras palabras, que el password2 tenga un valor y el input de password también
        Si llega con datos entra al if y verifica si la pass1 diferente al pass 2
        Si son diferentes tira error ( aL NO SER IGUALES)
        Si son iguales, continua el proceso
        */
        if(isset($valores['password2'])){

            $validation_pasword2 = Validator::make($request->all(), [
                'password'  => ['required', 'min:8'],
                'password2' => ['required', 'min:8'],
            ]);

            /* Error en el caso que el usuario no haga bien el input de password2 */
            if ($validation_pasword2->fails()) {
                return redirect()->back()->with('error','Error en el campo confirmar contraseña, vuelve a intentarlo ');
            }

            if ($valores['password']!=$valores['password2']){
                return redirect()->back()->with('error','Contraseñas no coinciden');
            }
        }

        /* 
        Verificación si el input password está vacío
        */
        if(!isset($valores['password'])){
            
            //si el password esta en blanco no lo actualizaremos
            if( is_null($valores['password']))
            {
                unset($valores['password']);
            }
        }
        else{

            $validation_paswords = Validator::make($request->all(), [
                'password'  => ['required', 'min:8'],
                'password2' => ['required', 'min:8'],
            ]);

            /* Error en el caso de que el usuario solamente escriba en el campo password y no en el password2*/
            if ($validation_paswords->fails()) {
                return redirect()->back()->with('error','Error al cambiar la contraseña, vuelve a intentarlo');
            }

            $valores['password'] = Hash::make( $valores['password'] );
        }

        $registro = User::find($id);
        $registro->fill($valores);
        $registro->save();

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $user = User::findOrFail($id);
            $user->delete();
            return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente');
        } catch (\Illuminate\Database\QueryException $e){
            return redirect()->route('usuarios.index')->with('error',$e->getMessage());
        }
    }

    public function usersDatatables()
    {
        return FacadesDataTables::eloquent(\App\Models\User::orderBy('rol', 'asc'))
                ->addColumn('btn', 'usuario.actions')
                ->rawColumns(['btn'])
                ->toJson();
    }
}
