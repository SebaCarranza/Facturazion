<?php

namespace App\Controllers;

use App\Models\ComerciosModel;
use CodeIgniter\API\ResponseTrait;
use App\Models\CbusModel;

class Comercios extends BaseController
{
    use ResponseTrait;
    public function listado_comercio(){
        $comercios = (new ComerciosModel())->where('user_id', session()->get('user.id'))->get()->getResultArray();

        return view('comercios', ['comercios'=>$comercios]);
    }

    public function editar_comercio($comercio_id = 0){
        $comercio = (new ComerciosModel())->where('id', $comercio_id)->first();
        $cbus = (new CbusModel())->where('comercios_id', $comercio_id)->get()->getResultArray();

        return view('detalles_comercio', ['comercio'=>$comercio, 'cbus'=>$cbus]);
    }
    public function save_comercio(){
        $id = $this->request->getVar('id') ? : 0;
        $cuit = $this->request->getVar('cuit');
        $razon_social = $this->request->getVar('razon_social');

        $comercio = (new ComerciosModel())->where('id', $id)->first();

        $datos = [
            'cuit' => $cuit,
            'razon_social' => $razon_social
        ];

        if(!empty($comercio)){
            (new ComerciosModel())->update($id,$datos);

            $message = "SE ACTUALIZO LOS DATOS";
        }else{
            (new ComerciosModel())->set('user_id',session()->get('user.id'))->set($datos)->insert();

            $message = "SE CREARON LOS DATOS";
        }

        $response = [
            'message' => $message
        ]; 

        return $this->respondCreated($response);
    }
    public function borrar_comercio($comercio_id = 0){
        $comercio = (new ComerciosModel())->where('id',$comercio_id)->first();

        if(!empty($comercio)){
            (new ComerciosModel())->delete($comercio_id);
            (new CbusModel())->where('comercios_id',$comercio_id)->delete();
            
            $message = "SE BORRO";
            $error = false;
        }else{
            $message = "ERROR AL BORRAR";
            $error = true;
        }

        $response = [
            'message' => $message,
            'error' => $error
        ]; 

        return $this->respondCreated($response);
    }
    public function actualizar_listado_comercio(){
        $comercios = (new ComerciosModel())->where('user_id', session()->get('user.id'))->get()->getResultArray();

        $response = [
            'comercios'=>$comercios
        ]; 

        return $this->respondCreated($response);
    }
}
