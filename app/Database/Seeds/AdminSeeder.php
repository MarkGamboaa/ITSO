<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\Users_model;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $email = 'admin@example.com';

        $model = new Users_model();

        // if the admin already exists, do nothing
        if ($model->where('email', $email)->first()) {
            return;
        }

        $model->insert([
            'first_name'     => 'Admin',
            'last_name'      => 'User',
            'email'          => $email,
            'password_hash'  => password_hash('Admin123!', PASSWORD_DEFAULT),
            'role'           => 'ITSO',
            'is_active'      => 1,
            'email_verified' => 1,
            'created_at'     => date('Y-m-d H:i:s'),
            'updated_at'     => date('Y-m-d H:i:s'),
        ]);
    }
}