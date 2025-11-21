<?php

namespace App\Models;

use CodeIgniter\Model;

class Users_model extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'user_id';

    protected $useAutoIncrement = true;

    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields    = [
        'first_name',
        'last_name',
        'email',
        'password_hash',
        'role',
        'token',
        'is_active',
        'email_verified',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true; // automatically fills created_at & updated_at

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation rules
    protected $validationRules = [
        'first_name' => 'required|min_length[2]',
        'last_name'  => 'required|min_length[2]',
        'email'      => 'required|valid_email|is_unique[users.email,user_id,{user_id}]',
        'role' => 'required|in_list[ITSO,Associate,Student]'
    ];
}
