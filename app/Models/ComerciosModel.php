<?php
namespace App\Models;

use CodeIgniter\Model;

class ComerciosModel extends Model {
    protected $table = 'comercios';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id', 'cuit', 'razon_social', 'user_id'
    ];
}

