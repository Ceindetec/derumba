<?php

namespace App\Http\Controllers;

use App\Http\Requests\updatePropietarioRequest;
use App\Marca;
use App\Persona;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PropietarioController extends Controller
{
    public function editarPerfil()
    {
        $usuario = User::find(Auth::user()->id);
        $usuario->getPersona;
        $data['usuario'] = $usuario;
        return view('propietario.perfil', $data);
    }

    public function setInfo(updatePropietarioRequest $request)
    {
        $buscarCorreo = User::select('id')->where('email', '=', $request->email)->get();
        $mensaje = 'exito';

        $usuario = Auth::user();
        $usuario->getPersona;
        $usuario->getPersona->telefono = $request->telefono;
        $usuario->getPersona->save();
        if (count($buscarCorreo) == 0)
            $usuario->email = $request->email;
        else{
            if ($buscarCorreo[0]->id != $usuario->id)
                $mensaje = 'error';
        }
        $usuario->save();
        return $mensaje;
    }

    public function setContrasena(Request $request)
    {
        $mensaje = 'exito';
        if(Hash::check($request->cActual, Auth::user()->password)){
            if ($request->cActual != $request->cConfirm){
                if($request->cNueva == $request->cConfirm){
                    $usuario = Auth::user();
                    $usuario->password = bcrypt($request->cConfirm);
                    $usuario->save();
                }
                else
                    $mensaje = "La nueva contraseña no coincide con la confirmacion.";
            }
            else
                $mensaje = 'La contraseña nueva no puede ser igual a la actual.';
        }
        else
            $mensaje = 'Parece que esta no es tu contraseña actual.';
        return $mensaje;
    }

    public function editarMarcas()
    {
        $marcas = Marca::where('user_id', '=', Auth::user()->id)->get();
        $data['marcas'] = $marcas;
        return view('propietario.marcas', $data);
    }
}
