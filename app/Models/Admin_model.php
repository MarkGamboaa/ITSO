<?php
namespace App\Models;

use CodeIgniter\Model;

class Admin_model extends Model {
    protected $table      = 'tbladmin';
    protected $primaryKey = 'admin_id';
    protected $useAutoIncrement = true;

    protected $returnType     = 'array';

    protected $allowedFields = [
        'username',
        'password',
        'email',
        'role',
        'datecreated',
    ];

    protected bool $allowEmptyInserts = false;
}
?>