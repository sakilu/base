<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_logs
{
    public function add()
    {
        $header = json_encode(getallheaders());
        $uri = $_SERVER['REQUEST_URI'];
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        $ci = &get_instance();
        $body = file_get_contents('php://input');
        if (!$body && count($_POST)) {
            $body = http_build_query($_POST);
        }

        $ci->db->where('api_logs_created_at <=', date('Y-m-d', time() - 3600 * 24));
        $ci->db->delete('api_logs');
        $ci->db->insert('api_logs', [
            'api_logs_url' => $uri,
            'api_logs_method' => $_SERVER['REQUEST_METHOD'],
            'api_logs_ip' => $ip,
            'api_logs_request_head' => $header,
            'api_logs_request_body' => $body
        ]);
    }
}
