<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_api_logs extends CI_Migration
{

    protected $table = 'api_logs';

    public function up()
    {
        $prefix = $this->table . '_';
        $fields = [
            $prefix . 'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            $prefix . 'method' => [
                'type' => "varchar",
                'constraint' => 255,
                'null' => true
            ],
            $prefix . 'ip' => [
                'type' => "varchar",
                'constraint' => 255,
            ],
            $prefix . 'url' => [
                'type' => "text",
            ],
            $prefix . 'request_head' => [
                'type' => "text",
            ],
            $prefix . 'request_body' => [
                'type' => "text",
            ],
            $prefix . 'created_at' => [
                'type' => "TIMESTAMP DEFAULT CURRENT_TIMESTAMP",
            ],
        ];
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key($prefix . 'id', TRUE);
        $this->dbforge->add_key($prefix . 'created_at');
        $this->dbforge->create_table($this->table);
    }

    public function down()
    {
        $this->dbforge->drop_table($this->table);
    }
}