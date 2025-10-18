<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Projects extends Migration
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
                'title' => [
                    'type'       => 'VARCHAR',
                    'constraint' => '255',
                ],
                'category' => [
                    'type'       => 'VARCHAR',
                    'constraint' => '255',
                ],
                'image' => [
                    'type'       => 'VARCHAR',
                    'constraint' => '255',
                ],
                'description' => [
                    'type'       => 'TEXT',
                ],
                'status' => [
                    'type'       => 'ENUM',
                    'constraint' => ['in progress', 'completed'],
                    'default'    => 'in progress',
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
        $this->forge->createTable('projects');
    }

    public function down()
    {
        $this->forge->dropTable('projects');
    }
}
