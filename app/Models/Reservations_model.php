<?php

namespace App\Models;

use CodeIgniter\Model;

class ReservationsModel extends Model
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

    protected $validationRules = [
        'user_id'      => 'required|integer',
        'equipment_id' => 'required|integer',
        'quantity'     => 'required|integer',
        'reserved_date' => 'required|valid_date',
        'status'       => 'required|in_list[Active,Cancelled,Completed]'
    ];
}
