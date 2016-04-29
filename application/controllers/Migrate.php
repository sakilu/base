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

        if ($this->migration->latest() === FALSE) {
            show_error($this->migration->error_string());
        }
    }

    public function restart()
    {
        $this->reset();
        $this->index();
    }

}