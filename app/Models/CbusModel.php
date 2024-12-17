<?php
namespace App\Models;

use CodeIgniter\Model;

class CbusModel extends Model {
    protected $table = 'cbus';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id', 'alias', 'cbu', 'comercios_id'
    ];
}

