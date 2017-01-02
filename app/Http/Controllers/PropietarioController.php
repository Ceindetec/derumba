<?php

namespace App\Http\Controllers;

use App\Departamento;
use App\Galeria;
use App\Http\Requests\updatePropietarioRequest;
use App\Marca;
use App\Municipio;
use App\Persona;
use App\Portada;
use App\Sitio;
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
        $data['marcas'] = Auth::user()->getMarcas;;
        return view('propietario.marcas', $data);
    }

    public function updateImagenMarca(Request $request)
    {
        $marca = Marca::find($request->marca);
        unlink("image/".utf8_decode($marca->imagen));

        $file = $request->file('file');
        $name = time().$file->getClientOriginalName();
        $file->move('image', $name);

        $marca->imagen=$name;
        $marca->save();

        return ["exito", $name];
    }

    public function editarSitios()
    {
        $data['marcas'] = Auth::user()->getMarcas;;
        return view('propietario.sitios', $data);
    }

    public function getSitiosxMarca(Request $request)
    {
        $marca = Marca::find($request->marca);
        $sitios = array();
        foreach ($marca->getSitios as $sitio){
            $sitio->municipio =  ucwords(strtolower($sitio->getMunicipio->municipio));
            $sitio->departamento = ucwords(strtolower($sitio->getMunicipio->getDepartamento->departamento));
            $sitio->foto = $sitio->getPortada;
            $sitios[] = $sitio;
        }
        return $sitios;
    }

    public function getSitio($id)
    {
        $sitio = Sitio::find($id);
        if ($sitio == null || $sitio->getMarca->user_id != Auth::user()->id)
            return redirect()->back();
        else{
            $sitio->dpto_id = $sitio->getMunicipio->getDepartamento->id;
            $data['sitio'] = $sitio;
            $data['arrayDepartamento'] = $this->listarDepartamentos();

            $municipios = $sitio->getMunicipio->getDepartamento->getMunicipios;
            $arrayMunicipios = array();
            foreach ($municipios as $municipio){
                $arrayMunicipios[$municipio->id]= $municipio->municipio;
            }
            $data['arrayMunicipio'] = $arrayMunicipios;
            $data['municipio'] = Municipio::find($sitio->municipio_id);

            $data['imageSlider'] = Galeria::where('sitio_id', $sitio->id)->get();

//            dd($data);
            return view('propietario.editSitio', $data);
        }
    }

    public function editHorarios($id)
    {
        $sitio = Sitio::find($id);
        if ($sitio == null || $sitio->getMarca->user_id != Auth::user()->id)
            return redirect()->back();
        else{
            $data['sitio'] = $sitio;
            return view('propietario.modalHorarios', $data);
        }
    }

    public function updateInfoSitio(Request $request)
    {
        $sitio = Sitio::find($request->sitio)->update($request->all());
        return "exito";
    }

    public function listarDepartamentos()
    {
        $departamentos= Departamento::select('id','departamento')->get();
        $arrayDepartamento = array();
        foreach ($departamentos as $departamento){
            $arrayDepartamento[$departamento->id]= $departamento->departamento;
        }
        return $arrayDepartamento;
    }

    public function subirImagenGaleria(Request $request)
    {
//
        $file = $request->inputGalery[0];

        //dd($file);
//        foreach ($files as $file){
//            //$type=explode("/", $file->getMimeType());
//            dd($file->extension());
//        }

        if ($file != null) {
//            $fotos = $fotos[0];
//
//            $extension = explode(".", $fotos->getClientOriginalName());
//            $cantidad = count($extension) - 1;
//            $extension = $extension[$cantidad];
//            $nombre = time(). $request->file_id. "." . $extension;
//
//            $fotos->move('image', utf8_decode($nombre));

            $imagedata = file_get_contents($file);

            $base64 = base64_encode($imagedata);

            $galeria = new Galeria();
            $galeria->extension=$file->getClientOriginalExtension();
            $galeria->data64 = $base64;
            $galeria->sitio_id = $request->sitio_id;
            $galeria->save();

            return json_encode(array('data' => $base64, 'id' => $galeria->id));
        }
        else
            return json_encode(array('error'=>'Archivo no permitido'));
    }


    /**
     * @return string
     */
    public function deleteImgGaleria(Request $request)
    {
        $affectedRows = Galeria::where('id', $request->id)->delete();
        if ($affectedRows > 0){
            return "exito";
        }else{
            return "error";
        }
    }

    /**
     * @return string
     */
    public function subirImgPerfil(Request $request)
    {
        $file = $request->imagenes[0];

        if ($file != null) {

            $imagedata = file_get_contents($file);
            $base64 = base64_encode($imagedata);

            $sitio = Sitio::find($request->sitio_id);

            if($sitio->portada_id==1){
                $portada = new Portada();
                $portada->portada = $base64;
                $portada->save();
            }else{
                $portada = Portada::find($sitio->portada_id);
                $portada->portada = $base64;
                $portada->save();
            }

            $sitio->portada_id = $portada->id;
            $sitio->save();

            return ['data' => $base64, 'id' => $portada->id];
        }
        else
            return ['error'=>'Archivo no permitido'];
    }



}
