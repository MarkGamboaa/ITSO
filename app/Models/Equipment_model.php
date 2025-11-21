<?php

namespace App\Models;

use CodeIgniter\Model;

class Equipment_model extends Model
{
    protected $table            = 'equipment';
    protected $primaryKey       = 'equipment_id';

    protected $useAutoIncrement = true;

    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields    = [
        'name',
        'description',
        'accessories',
        'total_count',
        'available_count',
        'is_active',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    //validation rules
    protected $validationRules = [
        'name' => 'required|min_length[2]',
        'total_count' => 'required|integer',
        'available_count' => 'required|integer',
        'is_active' => 'in_list[0,1]'
    ];
}
