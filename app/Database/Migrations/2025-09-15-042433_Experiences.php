<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Experiences extends Migration
{
    public function up()
    {
        $this->forge->addField(
            [
                'id' => [
                    'type' => 'INT',
                    'unsigned' => true,
                    'auto_increment' => true
                ],
                'user_id' => [
                    'type'       => 'INT',
                    'unsigned' => true,
                ],
                'company' => [
                    'type'       => 'VARCHAR',
                    'constraint' => '255',
                ],
                'start_date' => [
                    'type' => 'DATE',
                ],
                'end_date' => [
                    'type' => 'DATE',
                    'null' => true
                ],
                'description' => [
                    'type'       => 'TEXT',
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
        $this->forge->createTable('experiences');
    }

    public function down()
    {
        $this->forge->dropTable('experiences');
    }
}
