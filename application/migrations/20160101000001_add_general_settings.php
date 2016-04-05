<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_general_settings extends CI_Migration
{

    protected $table = 'general_settings';

    public function up()
    {
        $prefix = $this->table . '_';
        $this->dbforge->add_field([
            $prefix . 'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'type' => [
                'type' => 'varchar',
                'constraint' => 255
            ],
            'value' => [
                'type' => 'text',
                'null' => true
            ],
            $prefix . 'created_at' => [
                'type' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            ],
            $prefix . 'updated_at' => [
                'type' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            ],
        ]);
        $this->dbforge->add_key($prefix . 'id', TRUE);
        $this->dbforge->create_table($this->table);

        $this->db->insert($this->table, [
            'type' => 'google_id',
            'value' => ''
        ]);
        $this->db->insert($this->table, [
            'type' => 'google_key',
            'value' => ''
        ]);
        $this->db->insert($this->table, [
            'type' => 'fb_appid',
            'value' => ''
        ]);
        $this->db->insert($this->table, [
            'type' => 'fb_secret',
            'value' => ''
        ]);
        $this->db->insert($this->table, [
            'type' => 'email_name',
            'value' => ''
        ]);
        $this->db->insert($this->table, [
            'type' => 'email_address',
            'value' => 'sakilu@gmail.com'
        ]);
    }

    public function down()
    {
        $this->dbforge->drop_table($this->table);
    }
}