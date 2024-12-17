<?php

namespace App\Controllers;

use App\Models\UsersModel;
use CodeIgniter\API\ResponseTrait;

class Usuarios extends BaseController
{
    use ResponseTrait;
    public function validar_usuario()
    {
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $usuario = (new UsersModel())->where('email', $email)->where('password', $password)->first();

        if (!empty($usuario)){
            $data['user'] = $usuario;

            $session = session();
            $session->set($data);
            
             $response = [
                'status' => 200,
                "error" => FALSE,
                'message' => 'USUARIO LOGEADO'
            ];
            return $this->respondCreated($response);
        }else{
            $response = [
                'status' => 401,
                "error" => TRUE,
                'message' => 'ERROR AL LOGEAR'
            ];
            return $this->respondCreated($response);
        }
    }
}
