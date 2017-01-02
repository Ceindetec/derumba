<?php

namespace App\Http\Controllers;

use App\Sitio;
use App\Portada;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WebServiceController extends Controller
{
    /**
     * @return string
     */
    public function getEstablecimientos()
    {
        $sitios = Sitio::all();

        $arraySitios = array();
        foreach ($sitios as $sitio){
            $array = array();
            $array["id"]=$sitio->id;
            $array["nombre"]=$sitio->nombre;
            $array["portada"]=$sitio->getPortada->portada;
            $array["genero"]=$sitio->genero;
            $arraySitios[]=$array;
        }

        return json_encode($arraySitios);
    }
}
