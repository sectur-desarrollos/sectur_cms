<?php

namespace App\Http\Controllers;

use App\Models\PaginaV2;
use Illuminate\Http\Request;
use App\Models\User;
use App\Rules\Recaptcha;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:admin.users.index')->only('index');
        $this->middleware('can:admin.users.create')->only('create', 'store');
        $this->middleware('can:admin.users.edit')->only('edit', 'update');
        $this->middleware('can:admin.users.destroy')->only('destroy');
    }

    public function index()
    {
        return view('users.index');
    }

    public function create()
    {
        $roles = Role::all();

        $paginas = PaginaV2::select("titulo", "id")
                        ->where('activo',1)
                        ->get();

        return view('users.create', compact('roles', 'paginas'));
    }

    public function store(Request $request)
    {
        $valores = request()->except(['roles','paginas']);
        
        // Se obtienen los roles del request
        $roles = $request->roles;

        $paginas = $request->paginas;

         /* Reglas de validación del request */
        $validation = Validator::make($request->all(), [
            'name'                  => ['required', 'string', 'max:255'],
            'email'                 => ['required', 'string', 'email', 'max:255'],
            'password'              => ['required', 'min:8'],
            'password2'             => ['required', 'min:8'],
            'estado'                => ['required'],
            'roles'                 => ['required'],
            //'paginas'               => ['required'],
            //'g-recaptcha-response'  => ['required', new Recaptcha],
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

        // Se asigna los valores de las paginas recibidos a la columna
        $valores['paginas'] = $paginas;
        
        /* Se llena el modelo con los datos en caso de que todo esté correcto y también se usa la relación "assignRole" para llenar
        el rol del usuario*/
        $registro = new User();
        $registro->fill($valores);
        $registro->assignRole($roles);
        $registro->save();

        return redirect()->route('users.edit', $registro->id)->with('success', 'Registro creado exitosamente');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        $roles = Role::all();

        $paginas = PaginaV2::select("titulo", "id")
                        ->where('activo','1')
                        ->get();

        return view('users.edit', compact('user', 'roles','paginas'));
    }

    public function update(Request $request, $id)
    {
        
        // Obtenemos los valores del request
        $valores = request()->except(['roles']);
        $roles = $request->roles;
        
        $validation = Validator::make($request->all(), [
            'name'                  => ['required', 'string'],
            'email'                 => ['required', 'string'],
            'estado'                => ['required'],
            //'g-recaptcha-response'  => ['required', new Recaptcha],
        ]);

        /* Fallo en caso de que las reglas de validación fallen */
        if ($validation->fails()) {
            return redirect()->back()->with('error','Por favor complete bien los campos')->withInput()->withErrors($validation);
        }
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

        // Se guardan los valores en el Modelo
        $user = User::findOrFail($id);
        $user->fill($valores);
        $user->roles()->sync($roles);
        $user->save();

        return redirect()->route('users.edit', $user->id)->with('success', 'Registro actualizado exitosamente');

    }
    
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        
        return redirect()->route('users.index', $user->id)->with('success', 'Registro eliminado exitosamente');
    }

    public function usersDatatables()
    {
        return FacadesDataTables::eloquent(\App\Models\User::orderBy('name', 'asc'))
                ->addColumn('btn', 'users.actions')
                ->rawColumns(['btn'])
                ->toJson();
    }
}
