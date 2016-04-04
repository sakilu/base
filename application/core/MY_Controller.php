<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->layout->is_ajax_request()) {
            $this->_get_logger()->addDebug('session', $this->session->all_userdata());
        }
        $this->_get_crud()->set_controller($this);
        if ($this->_get_crud()->get_module_name() !== 'login' && !$this->_get_auth()->check()) {
            $this->_get_auth()->redirect_login_page();
        }
        setcookie("a", 1, time() + 3600, '/'); // for ckfinder
        $this->_get_crud()->set(Crud::KEY_TABLE, strtolower(get_class($this)));
    }

    /**
     * @param $id
     */
    public function ajax_remove($id)
    {
        $table = $this->_get_crud()->get(Crud::KEY_TABLE);
        if ($this->db->field_exists($table . '_trash', $table)) {
            $this->db->where($this->_get_crud()->get_primary_key_column_name(), $id);
            $this->db->update($table, [$table . '_trash' => 1]);
            if ($this->db->field_exists($table . '_updated_by', $table)) {
                $this->db->where($this->_get_crud()->get_primary_key_column_name(), $id);
                $this->db->update($table, [$table . '_updated_by' => json_encode($this->_get_auth())]);
            }
            return;
        }
        $this->_get_crud()->single_delete($table, $id);
        $this->crud_model->file_dlt($table, $id);
    }

    public function state_list_save()
    {
        $this->_get_crud()->state_list_save();
    }

    public function state_list_load()
    {
        echo json_encode($this->_get_crud()->state_list_load());
    }

    public function is_logged()
    {
        echo $this->_get_auth()->get_id() > 0 ? 'yah!good' : 'nope!bad';
    }

    /**
     * @return Logger
     */
    public function _get_logger()
    {
        return $this->logger;
    }

    public function logout()
    {
        $this->_get_auth()->logout();
    }

    /**
     * @return Sidebar
     */
    protected function _get_sidebar()
    {
        return $this->sidebar;
    }

    /**
     * @return AbstractAuth
     */
    protected function _get_auth()
    {
        return $this->auth;
    }

    /**
     * @return Crud
     */
    protected function _get_crud()
    {
        return $this->crud;
    }

    /**
     * @return Layout
     */
    protected function _get_layout()
    {
        return $this->layout;
    }

    /**
     * @return Form
     */
    protected function _get_form()
    {
        return $this->form;
    }

}
