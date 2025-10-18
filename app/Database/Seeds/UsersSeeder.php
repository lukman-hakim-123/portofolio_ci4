<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'username'      => 'admin',
            'email'         => 'admin@example.com',
            'password'      => password_hash('admin123', PASSWORD_DEFAULT),
            'role'          => 'admin',
            'image' => null,
            'bio'           => 'This is the default admin account.',
            'social_links'  => null,
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ];

        $this->db->table('users')->insert($data);
    }
}
