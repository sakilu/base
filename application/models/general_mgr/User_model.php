<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CRUD_Model_Interface
{

    protected $_table = 'user';

    public function validate($action = '', $id = null)
    {
        $this->form_validation->set_rules('user_name', '姓名', 'trim|required');
        return $this->form_validation->run();
    }

    public function get_error()
    {
        return validation_errors();
    }

}