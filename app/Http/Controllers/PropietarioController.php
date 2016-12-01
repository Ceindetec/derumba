<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PropietarioController extends Controller
{
    public function editarPerfil()
    {
        return view('propietario.perfil');
    }
}
