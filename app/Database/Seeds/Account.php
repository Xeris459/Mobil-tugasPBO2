<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Account extends Seeder
{
    public function run()
    {
        $data = [
            'username' => 'admin',
            'email'    => 'admin@gmail.com',
            'password'    => password_hash("admin", PASSWORD_BCRYPT),
            "created_at"    => date("Y-m-d"),
            "updated_at"    => date("Y-m-d")
        ];
        
        // Using Query Builder
        $this->db->table('users')->insert($data);
    }
}