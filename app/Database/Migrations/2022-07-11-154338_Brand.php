<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Brand extends Migration
{
    public function up()
    {
        $fields = [
            'image' => [
                'type' => 'varchar',
                'constraint' => 255,
            ],
            'status' => [
                'type' => 'enum',
                'constraint' => ["publish", "unpublish"],
            ],
        ];
    
        $this->forge->addColumn('brand',$fields);
    }

    public function down()
    {
        //
    }
}