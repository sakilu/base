<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Debug extends CI_Controller
{
    public function index()
    {
        $this->db->query("SET time_zone='+8:00'");
        $this->db->order_by('api_logs_id desc');
        $this->db->where('api_logs_url !=', '/test/debug');
        $this->db->like('api_logs_url', '/test/');
        $this->db->or_like('api_logs_url', '/api/');
        $this->db->or_like('api_logs_url', '/batch/');

        $this->load->view('api_logs/index', [
            'rows' => $this->db->get('api_logs')->result()
        ]);
    }
}
