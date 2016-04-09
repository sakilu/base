<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 使用各action 對Crud影響
 * index & ajax_form => 列表以及新增編輯的方式
 * form => 單純只有 form

 */
class Admin extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->_get_auth()->check($this->_get_crud()->get_module_name())) {
            $this->_get_auth()->redirect_unauthorized_page();
        }
    }

    public function _get_column()
    {
        $table = $this->_get_crud()->get(Crud::KEY_TABLE);
        $columns['admin_id'] = new Column($table, 'admin_id', '流水號', '70px');
        $columns['admin_name'] = new Column($table, 'admin_name', '姓名', '150px');
        $columns['admin_mail'] = new Column($table, 'admin_mail', '信箱', '200px');
        $columns['admin_role'] = new Column($table, 'admin_role', '權限');
        $columns['admin_role']->set(Column::KEY_OPTIONS, $this->config->item('role'));
        $columns['edit'] = new Column_edit($table, 'admin_id', ' 操作');
        return $columns;
    }

    public function index()
    {
        $this->_get_crud()->set(Crud::KEY_COLUMNS, $this->_get_column());
        $this->_get_crud()->get_db()->where($this->_get_crud()->get_module_name() . '_trash', 0);
        $this->_get_layout()->view('crud/content/list');
    }

    public function ajax_form($action = 'view', $id = null)
    {
        $module = $this->_get_crud()->get_module_name();
        $columns = $this->_get_column();

        $columns['admin_password'] =
            new Column_password($this->_get_crud()->get(Crud::KEY_TABLE), 'admin_password', '密碼');
        $columns['admin_password_confirm'] =
            new Column_prototype($this->_get_crud()->get(Crud::KEY_TABLE), 'admin_password_confirm', '密碼確認');
        $this->_get_form()->set(Form::KEY_COLUMN, $columns);

        $this->form_validation->set_rules('admin_name', '姓名', 'trim|required');
        $this->form_validation->set_rules('admin_role[]', '權限', 'trim|required');

        if ($action == 'add') {
            $this->form_validation->set_rules('admin_mail', '信箱(帳號)', 'trim|required|valid_email');
            $data = [];
            $data['admin_password'] = trim($this->input->post('admin_password'));
            if (!empty($data['admin_password'])) {
                $this->form_validation->set_rules('admin_password', '密碼', 'trim|required|min_length[8]');
                $this->form_validation->set_rules('admin_password_confirm', '密碼確認',
                    'trim|required|matches[admin_password]');
                $data['admin_password'] = hash_pwd($data['admin_password']);
            }
            if ($this->form_validation->run() == FALSE) {
                echo validation_errors();
                $this->output->set_status_header(400);
                return;
            }

            $data['admin_mail'] = trim($this->input->post('admin_mail'), true);
            $data['admin_name'] = trim($this->input->post('admin_name'), true);
            $data['admin_role'] = implode(',', $this->input->post('admin_role[]'));
            $data[$module . '_created_by'] = $this->_get_auth()->get_name();
            $this->db->insert($module, (array)$data);
            echo base_url(sprintf('%s/ajax_form/view/%d', $this->_get_crud()->get_module_url(),
                $this->db->insert_id()));
        } else if ($action == 'edit') {
            if ($this->form_validation->run() == FALSE) {
                echo validation_errors();
                $this->output->set_status_header(400);
                return;
            }
            $data = [];
            $data['admin_name'] = trim($this->input->post('admin_name'), true);
            $data['admin_role'] = implode(',', $this->input->post('admin_role[]'));
            $data[$module . '_updated_by'] = $this->_get_auth()->get_name();
            $this->db->where($module . '_id', $id);
            $this->db->update($module, $data);
            echo base_url(sprintf('%s/ajax_form/view/%d', $this->_get_crud()->get_module_url(), $id));
        } else if ($action == 'view') {
            $this->_get_form()->set_primary_key($id);
            $this->db->where($module . '_id', intval($id));
            $this->db->where($this->_get_crud()->get_module_name() . '_trash', 0);
            $data = $this->db->get($module)->row();
            $this->_get_form()->set(Form::KEY_FORM_DATA, $data);

            $view_path = sprintf('%s/form', $this->_get_crud()->get_module_url());
            $this->_get_layout()->view($view_path, [
                'data' => $data
            ]);
        }

    }

}

