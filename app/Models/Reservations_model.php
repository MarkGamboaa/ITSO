<?php

namespace App\Models;

use CodeIgniter\Model;

class Reservations_Model extends Model
{
    protected $table            = 'reservations';
    protected $primaryKey       = 'reservation_id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    protected $allowedFields    = [
        'user_id',
        'equipment_id',
        'quantity',
        'reserved_date',
        'status',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
