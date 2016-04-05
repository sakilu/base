<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_admin extends CI_Migration
{

    protected $table = 'admin';

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
            $prefix . 'fb_id' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => true
            ],
            $prefix . 'google_id' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => true
            ],
            $prefix . 'android_token' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => true
            ],
            $prefix . 'ios_token' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => true
            ],
            $prefix . 'login_token' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => true
            ],
            $prefix . 'mail' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => true
            ],
            $prefix . 'password' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => true
            ],
            $prefix . 'name' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => true
            ],
            $prefix . 'role' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => true
            ],
            $prefix . 'created_at' => [
                'type' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            ],
            $prefix . 'updated_at' => [
                'type' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            ],
            $prefix . 'created_by' => [
                'type' => 'text',
                'null' => true
            ],
            $prefix . 'updated_by' => [
                'type' => 'text',
                'null' => true
            ],
            $prefix . 'trash' => [
                'type' => 'tinyint',
                'default' => 0,
            ],
        ]);
        $this->dbforge->add_key($prefix . 'id', TRUE);
        $this->dbforge->create_table($this->table);
        $this->db->insert($this->table, [
            'admin_fb_id' => '1161345330551558',
            'admin_google_id' => '107185968711650606534',
            'admin_mail' => 'sakilu@gmail.com',
            'admin_name' => 'Brian',
            'admin_role' =>  'admin'
        ]);
    }

    public function down()
    {
        $this->dbforge->drop_table($this->table);
    }
}