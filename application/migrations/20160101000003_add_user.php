<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_user extends CI_Migration
{

    protected $table = 'user';

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
            $prefix . 'mail' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => true,
            ],
            $prefix . 'password' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => true,
            ],
            $prefix . 'fb_id' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => true,
            ],
            $prefix . 'google_id' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => true,
            ],
            $prefix . 'android_push_token' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => true,
            ],
            $prefix . 'ios_push_token' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => true,
            ],
            $prefix . 'created_at' => [
                'type' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            ],
            $prefix . 'updated_at' => [
                'type' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            ],
            $prefix . 'trash' => [
                'type' => 'tinyint',
                'default' => 0,
            ],
        ]);
        $this->dbforge->add_key($prefix . 'id', TRUE);
        $this->dbforge->add_key($prefix . 'fb_id');
        $this->dbforge->add_key($prefix . 'google_id');
        $this->dbforge->add_key($prefix . 'mail');

        $this->dbforge->create_table($this->table);
        $this->deploy();
    }

    public function down()
    {
        $this->dbforge->drop_table($this->table);
    }
}