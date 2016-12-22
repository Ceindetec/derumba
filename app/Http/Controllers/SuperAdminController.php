<?php

namespace App\Http\Controllers;

use App\Marca;
use Carbon\Carbon;
use App\Persona;
use App\Departamento;
use App\Municipio;
use App\Sitio;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SuperAdminController extends Controller
{
    /**
     * @return string
     */
    public function registroPropietario()
    {
        $departamentos= Departamento::select('id','departamento')->get();

        $arrayDepartamento = array();

        foreach ($departamentos as $departamento){
            $arrayDepartamento[$departamento->id]= $departamento->departamento;
        }

        $data["arrayDepartamento"]=$arrayDepartamento;
        return view("superAdmin.registroAdmin",$data);
    }

    /**
     * @param Request $request
     * @return string
     */
    public function addPropietario(Request $request)
    {
        DB::beginTransaction();
        try {
            $user = new User();
            $user->email = $request->email;
            $user->password = bcrypt($request->documento);
            $user->rol = "Propietario";
            $user->save();

            $persona = new Persona($request->all());
            $persona->user_id = $user->id;
            $persona->save();

            $file = $request->file('file');
            $name = time().$file->getClientOriginalName();
            $file->move('image', $name);

            $marca = new Marca($request->all());
            $marca->imagen=$name;
            $marca->user_id = $user->id;
            $marca->save();


            $sitio = new Sitio();
            $sitio->nombre= $request->nombreS;
            $sitio->telefono= $request->telefonoS;
            $sitio->municipio_id= $request->municipio_id;
            $sitio->marca_id=$marca->id;
            $sitio->save();

            DB::table('password_resets')->insert(
                ['email' => $request->email, 'token' => $request->_token, 'created_at' => Carbon::now()]
            );


            DB::commit();
            $data=["estado"=>true,"mensaje"=>"exito"];
        }catch (\Exception $e){
            DB::rollBack();
            $data=["estado"=>false,"mensaje"=>"error en la transaccion, intentar nuevamente.".$e->getMessage()];
        }
        return $data;


    }

    public function getMunicipios(Request $request){
        $municipios = Municipio::select('id', 'municipio')->where('departamento_id', $request->input('id'))->get();
        $arrayMunicipio = array();

        foreach ($municipios as $municipio) {
            $arrayMunicipio[$municipio->id] = $municipio->municipio;
        }
        //dd($arrayMunicipio);

        return $arrayMunicipio;
    }


    /**
     * @return string
     */
    public function addMarcas()
    {
        return view("superAdmin.addMarcas");
    }

    /**
     * @return string
     */
    public function addSitios()
    {
        return view("superAdmin.addSitios");
    }

    /**
     * @return string
     */
    public function getInfoUser(Request $request)
    {
        return $this->validatesRequestErrorBag;
    }

    /**
     * @return string
     */
    public function autoCompleUsuarios(Request $request)
    {
        $usuarios = User::where("email","like","%".$request->input("nombre")."%")->where('rol','Propietario')->get();

        $arrayUsuarios = array();
        foreach ($usuarios as $usuario){
            $arrayUsuarios[]=$usuario->email;
        }
        return $arrayUsuarios;
    }


    /**
     * @return string
     */
    public function traerUserXEmail(Request $request)
    {
        $user = User::where("email",$request->input("email"))->first();
        $user->getMarcas;
        $data["user"]=$user;
        return view("superAdmin.marcas",$data);

    }

    /**
     * @return string
     */
    public function addNuevaMarca(Request $request)
    {
        DB::beginTransaction();
        try {
        $file = $request->file('file');
        $name = time().$file->getClientOriginalName();
        $file->move('image', $name);

        $marca = new Marca($request->all());
        $marca->imagen=$name;
        $marca->user_id = $request->user_id;
        $marca->save();
            DB::commit();
            $data=["estado"=>true,"mensaje"=>"exito"];
        }catch (\Exception $e){
            DB::rollBack();
            $data=["estado"=>false,"mensaje"=>"error en la transaccion, intentar nuevamente.".$e->getMessage()];
        }
        return $data;

    }


    /**
     * @return string
     */
    public function removeMarca(Request $request)
    {
        $marca = Marca::find($request->id)->delete();
            $data=["estado"=>$marca];
        return $data;
    }

    public function editMarca(Request $request){
        $marca = Marca::find($request->id);
        $marca->nit=$request->nit;
        $marca->razon= $request->razon;
        if($request->file('file')){
            unlink('image/'.utf8_decode($marca->imagen));
            $file = $request->file('file');
            $name = time().$file->getClientOriginalName();
            $file->move('image', $name);
            $marca->imagen=$name;

        }
        $marca->save();
        $data=["estado"=>true];
        return $data;
    }

    ////------- para administracion de Sitios

    public function traerUserXEmailSitio(Request $request)
    {
        $user = User::where("email",$request->input("email"))->first();
        $user->getMarcas;
        $data["user"]=$user;
        return view("superAdmin.marcasSitio",$data);

    }

    /**
     * @return string
     */
    public function sitioXMarca(Request $request)
    {
        $sitios = Sitio::where("marca_id",$request->marca)->get();

        foreach ($sitios as $sitio){
            $sitio->departamento=$sitio->getMunicipio->departamento_id;
            $municipios = Municipio::select('id', 'municipio')->where('departamento_id', $sitio->departamento)->get();
            $arrayMunicipio = array();

            foreach ($municipios as $municipio) {
                $arrayMunicipio[$municipio->id] = $municipio->municipio;
            }
            $sitio->arrayMunicipio= $arrayMunicipio;
        }

        $data["sitios"]=$sitios;

        $departamentos= Departamento::select('id','departamento')->get();

        $arrayDepartamento = array();

        foreach ($departamentos as $departamento){
            $arrayDepartamento[$departamento->id]= $departamento->departamento;
        }

        $data["arrayDepartamento"]=$arrayDepartamento;

        //dd($data);
        return view("superAdmin.sitios",$data);
    }

    /**
     * @return string
     */
    public function editarSitio(Request $request)
    {
        $sitio=Sitio::find($request->idSitio)->update($request->all());
        return "exito";
    }

    /**
     * @return string
     */
    public function nuevoSitio(Request $request)
    {
        DB::beginTransaction();
        try {
            $sitio = new Sitio($request->all());
            $sitio->save();

            DB::commit();
            $data=["estado"=>true,"mensaje"=>"exito"];
        }catch (\Exception $e){
            DB::rollBack();
            $data=["estado"=>false,"mensaje"=>"error en la transaccion, intentar nuevamente.".$e->getMessage()];
        }
        return $data;

    }

    /**
     * @return string
     */
    public function removeSitio(Request $request)
    {
        $sitio = Sitio::find($request->id)->delete();
        $data=["estado"=>$sitio];
        return $data;
    }

}
