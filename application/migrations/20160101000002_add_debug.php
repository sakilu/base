<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_debug extends CI_Migration
{

    protected $table = 'debug';

    public function up()
    {
        $prefix = $this->table . '_';
        $this->dbforge->add_field([
            $prefix . 'id' => [
                'type' => 'bigint',
                'unsigned' => TRUE,
                'constraint' => 11,
                'auto_increment' => TRUE
            ],
            $prefix . 'msg' => [
                'type' => 'text',
            ],
            $prefix . 'created_at' => [
                'type' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            ],
        ]);
        $this->dbforge->add_key($prefix . 'id', TRUE);
        $this->dbforge->create_table($this->table);
    }

    public function down()
    {
        $this->dbforge->drop_table($this->table);
    }
}