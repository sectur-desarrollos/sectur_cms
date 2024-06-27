<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Rules\Recaptcha;
use Illuminate\Http\Request;
use App\Models\HistorialLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class AutenticarController extends Controller
{
    public function credenciales()
    {
        return view('autenticar.login');
    }

    public function autenticar(Request $request)
    {

        $request->validate(([
            'email'                 => 'required|email',
            'password'              => 'required',
            //'g-recaptcha-response'  => ['required', new Recaptcha]
        ]));

        $email   = $request->input('email');
        $usuario = User::where('email', $email)->first();
        
        if(is_null($usuario)){
            return redirect()->back()->with('error', 'Correo y/o contraseña no coinciden con nuestros registros')->withInput();       
        }
        else{
            $password = $request->input('password');
            $password_bd = $usuario->password;
            $estado_activo = $usuario->estado;
            
            if (Hash::check($password, $password_bd)) {
                if( $estado_activo=='Si'){
		            session()->flush();
                    Auth::login($usuario, true);
                    
                    // Registrar en el log
                    $this->log(Auth::user()->id, Auth::user()->name, 'Iniciar Sesión', 'Autenticar', 'Usuario datos: '.Auth::user()->name . ' | ' . Auth::user()->email);
    
                    return redirect()->route('dashboard');
                }
                else{
                    return redirect()->back()->with('error', 'Tu cuenta no está activa')->withInput(); 
                }
            }
            else{
                return redirect()->back()->with('error', 'Correo y/o contraseña no coinciden con nuestros registros')->withInput();
            }
        }
    }

    public function salida(){
        session(['id' => Auth::user()->id]);
        session(['nombre' => Auth::user()->name]);
        session(['correo' => Auth::user()->email]);
        
        Auth::logout();

        // Registrar en el log
        $this->log(session('id'), session('nombre'), 'Cerrar Sesión', 'Autenticar', 'Usuario datos: '. session('nombre') . ' | ' .  session('correo'));
        session()->forget(['id','nombre', 'correo']);

        return redirect('/');
    }

    public function log($usuario_id, $nombre_usuario, $accion, $lugar, $informacion)
    {
        HistorialLog::create([
            'usuario_id' => $usuario_id,
            'usuario_nombre' => $nombre_usuario,
            'modulo' => 'Autenticar',
            'accion' => $accion,
            'lugar' => $lugar,
            'informacion' => $informacion,
            'fecha_accion' => now(),
        ]);
    }
}
