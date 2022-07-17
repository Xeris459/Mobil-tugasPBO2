<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Cars extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'series_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'status' => [
                'type' => 'enum',
                'constraint' => ["publish", "unpublish"],
            ],
            'detail' => [
                'type' => 'longtext'
            ],
            'image' => [
                'type' => 'varchar',
                "constraint" => 255
            ],
            'brand_id' => [
                'type' => 'int',
                "constraint" => 11
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('series_id');
        $this->forge->createTable('cars');
    }

    public function down()
    {
        //
    }
}