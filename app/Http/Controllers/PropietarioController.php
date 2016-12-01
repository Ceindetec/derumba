<?php

namespace App\Http\Controllers;

use App\Persona;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PropietarioController extends Controller
{
    public function editarPerfil()
    {
        $usuario = User::find(Auth::user()->id);
        $usuario->getPersona;
        $data['usuario'] = $usuario;
//        dd($data);
        return view('propietario.perfil', $data);
    }

    public function setInfo(Request $request)
    {
        $usuario = User::find(Auth::user()->id);

    }
}
