<?php

class Migrate extends CI_Controller
{

    public function reset()
    {
        $this->load->library('migration');
        $this->migration->version('20160101000001');
    }

    public function index()
    {
        $this->load->library('migration');

        if ($this->migration->current() === FALSE) {
            show_error($this->migration->error_string());
        }
    }

}