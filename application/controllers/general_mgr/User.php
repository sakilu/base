<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once FCPATH . 'crud/include/CRUD_Controller.php';

class User extends CRUD_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->_get_auth()->check($this->_get_crud()->get_module_name())) {
            $this->_get_auth()->redirect_unauthorized_page();
        }
    }

    public function _get_columns()
    {
        $table = $this->_get_crud()->get(Crud::KEY_TABLE);
        $columns['user_id'] = new Column($table, 'user_id', '流水號', '70px');
        $columns['user_name'] = new Column($table, 'user_name', '姓名');
        $columns['user_phone'] = new Column($table, 'user_phone', '手機號碼', '100px');
        $columns['user_mail'] = new Column($table, 'user_mail', '信箱', '200px');
        $columns['user_created_at'] = new Column($table, 'user_created_at', '建立時間', '120px');
        $columns['edit'] = new Column_edit($table, 'user_id', ' 操作');
        return $columns;
    }

    public function index()
    {
        $this->_get_crud()->set(Crud::KEY_COLUMNS, $this->_get_columns());
        $this->_get_crud()->get_db()->where($this->_get_crud()->get_module_name() . '_trash', 0);
        $this->_get_layout()->view('crud/content/list');
    }

    public function ajax_form($action = '', $id = null)
    {
        $table = $this->_get_crud()->get(Crud::KEY_TABLE);
        $columns = $this->_get_columns();
        $columns['user_password'] = new Column($table, 'user_password', '密碼');

        $model = $this->get_model();
        if ($action == 'add') {
            if ($model->validate($action, $id) == false) {
                echo $model->get_error();
                $this->output->set_status_header(400);
                return;
            }
            $data = [];
            $data["user_name"] = $this->input->post('user_name', true);
            $data["user_phone"] = $this->input->post('user_phone', true);
            $data["user_mail"] = $this->input->post('user_mail', true);
            if ($this->input->post('user_password')) {
                $data["user_password"] = hash_pwd($this->input->post('user_password', true));
            }

            $model->insert($data);
            echo base_url(sprintf('%s/index', $this->crud->get_module_url()));
        } else if ($action == 'edit') {
            if ($model->validate($action, $id) == false) {
                echo $model->get_error();
                $this->output->set_status_header(400);
                return;
            }
            $data = [];
            $data["user_name"] = $this->input->post('user_name', true);
            $data["user_phone"] = $this->input->post('user_phone', true);
            $data["user_mail"] = $this->input->post('user_mail', true);
            if ($this->input->post('user_password')) {
                $data["user_password"] = hash_pwd($this->input->post('user_password', true));
            }

            $model->update($data, $id);
            echo base_url(sprintf('%s/index', $this->crud->get_module_url()));
        } else if ($action == 'view') {
            $this->_get_form()->set_primary_key($id);
            $this->_get_form()->set(Form::KEY_COLUMN, $columns);
            $data = $model->get($id);
            $this->_get_form()->set(Form::KEY_FORM_DATA, $data);
            $view_path = sprintf('%s/form', $this->_get_crud()->get_module_url());
            $this->_get_layout()->view($view_path, [
                'data' => $data
            ]);
        } else if ($action == 'read') {
            $this->_get_form()->set_primary_key($id);
            $this->_get_form()->set(Form::KEY_COLUMN, $columns);
            $data = $model->get($id);
            $this->_get_form()->set(Form::KEY_FORM_DATA, $data);
            $view_path = sprintf('%s/form', $this->_get_crud()->get_module_url());
            $this->_get_form()->readonly(true);
            $this->_get_layout()->view($view_path, [
                'data' => $data
            ]);
        }
    }

}

