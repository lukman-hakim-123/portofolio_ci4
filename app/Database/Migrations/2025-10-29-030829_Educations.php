<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Educations extends Migration
{
    public function up()
    {
        $this->forge->addField(
            [
                'id' => [
                    'type'           => 'INT',
                    'unsigned'       => true,
                    'auto_increment' => true
                ],
                'user_id' => [
                    'type'       => 'INT',
                    'unsigned'   => true,
                ],
                'institution' => [
                    'type'       => 'VARCHAR',
                    'constraint' => '255',
                ],
                'logo' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 255,
                ],
                'major' => [
                    'type'       => 'VARCHAR',
                    'constraint' => '255',
                ],
                'start_year' => [
                    'type' => 'INT',
                ],
                'end_year' => [
                    'type' => 'INT',
                    'null' => true
                ],
                'created_at' => [
                    'type' => 'DATETIME',
                    'null' => true,
                ],
                'updated_at' => [
                    'type' => 'DATETIME',
                    'null' => true,
                ],
            ]
        );

        $this->forge->addKey('id', true);
        $this->forge->addKey('user_id');

        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('educations');
    }

    public function down()
    {
        $this->forge->dropTable('educations');
    }
}
