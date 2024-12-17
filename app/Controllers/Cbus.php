<?php

namespace App\Controllers;

use App\Models\CbusModel;
use App\Models\ComerciosModel;
use CodeIgniter\API\ResponseTrait;

class Cbus extends BaseController
{
    use ResponseTrait;
    public function editar_cbu($comercio_id = 0,$cbu_id = 0){
        $comercio = (new ComerciosModel())->where('id', $comercio_id)->first();

        $cbu = (new CbusModel())->where('id',$cbu_id)->first();

        return view('cbu', ['comercio'=>$comercio,'cbu' => $cbu]);
    }
    public function save_cbu(){
        $cbu_id = $this->request->getVar('cbu_id') ? : 0;
        $comercio_id = $this->request->getVar('comercio_id') ? : 0;
        $alias = $this->request->getVar('alias');
        $cbu = $this->request->getVar('cbu');

        $datos = [
            'alias' => $alias,
            'cbu' => $cbu,
            'comercios_id' => $comercio_id
        ];
        
        $CBU = (new CbusModel())->where('id',$cbu_id)->first();
        
        if(!empty($CBU)){
            (new CbusModel())->update($cbu_id,$datos);
            $message = "SE EDITO";
        }else{
            (new CbusModel())->insert($datos);
            $message = "SE CREO";
        }

        $response = [
            'message' => $message
        ]; 

        return $this->respondCreated($response);
    }
    public function borrar_cbu($cbu_id = 0){
        $cbu = (new CbusModel())->where('id',$cbu_id)->first();

        if(!empty($cbu)){
            (new CbusModel())->delete($cbu_id);
            
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
    public function actualizar_listado_cbu($comercio_id = 0){
        $cbus = (new CbusModel())->where('comercios_id', $comercio_id)->get()->getResultArray();

        $response = [
            'cbus' => $cbus
        ]; 

        return $this->respondCreated($response);
    }
}
