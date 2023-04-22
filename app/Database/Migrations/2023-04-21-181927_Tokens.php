<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tokens extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'email'       => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
            ],
            'token'      => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
            ],
            'created_at' => [
                'type'    => 'INT',
            ],
        ]);

        $this->forge->addKey('id', TRUE);

        $this->forge->createTable('tokens', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('tokens', TRUE);
    }
}
