<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Rules\Recaptcha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class AutenticarController extends Controller
{
    public function credenciales(){
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
        Auth::logout();
        return redirect('/');
    }
}
