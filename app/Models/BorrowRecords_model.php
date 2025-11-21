<?php

namespace App\Models;

use CodeIgniter\Model;

class BorrowRecords_Model extends Model
{
    protected $table            = 'borrow_records';
    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;

    protected $returnType       = 'array';

    protected $allowedFields    = [
        'user_id',
        'equipment_id',
        'borrowed_at',
        'returned_at',
        'status'
    ];

    protected $useTimestamps = false;
}
