<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_debug extends CI_Migration
{

    protected $table = 'debug';

    public function up()
    {
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'url' => [
                'type' => 'text',
            ],
            'datetime' => [
                'type' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            ],
            'header' => [
                'type' => 'text',
            ],
            'body' => [
                'type' => 'text',
            ],
            'timestamp' => [
                'type' => 'bigint',
            ],
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table($this->table);
    }

    public function down()
    {
        $this->dbforge->drop_table($this->table);
    }
}