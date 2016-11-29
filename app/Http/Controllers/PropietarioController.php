<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PropietarioController extends Controller
{
    public function editarPerfil()
    {
//        $user = Auth::user()->id;

        return view('propietario.perfil');
    }
}
