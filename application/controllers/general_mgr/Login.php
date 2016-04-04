<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use OAuth\OAuth2\Service\Google;
use OAuth\Common\Storage\Session;
use OAuth\Common\Consumer\Credentials;
use OAuth\ServiceFactory;

class Login extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->crud->set(Crud::KEY_TABLE, 'admin');
        $this->form->set(Form::KEY_ACTION, 'settings');
    }

    public function index()
    {
        $auth = $this->_get_auth();
        if ($auth->check()) {
            redirect(base_url('general_mgr/dashboard'));
            return;
        }
        $this->load->view('general_mgr/login/login');
    }

    /**
     * 登入處理
     */
    public function login_do()
    {
        $auth = $this->_get_auth();

        $admin_mail = $this->input->post('admin_mail');
        $admin_password = $this->input->post('admin_password');
        if (empty($admin_mail) || empty($admin_password)) {
            echo '帳密空白!!';
            $this->output->set_status_header(400);
            return;
        }

        if (!$auth->login($admin_mail, $admin_password)) {
            echo '帳密錯誤喔!!';
            $this->output->set_status_header(400);
            return;
        }
        echo base_url('/general_mgr/dashboard');
    }

    public function fb()
    {
        $appid = $this->db->get_where('general_settings', array(
            'type' => 'fb_appid'
        ))->row()->value;
        $secret = $this->db->get_where('general_settings', array(
            'type' => 'fb_secret'
        ))->row()->value;

        $fb = new Facebook\Facebook([
            'app_id' => $appid,
            'app_secret' => $secret,
            'default_graph_version' => 'v2.5',
        ]);

        $helper = $fb->getRedirectLoginHelper();
        if (!empty($_GET['code'])) {
            $accessToken = $helper->getAccessToken();

            $fb->setDefaultAccessToken($accessToken);
            $response = $fb->get('/me?fields=email,name');
            $body = $response->getDecodedBody();
            if ($this->_get_auth()->fb_login($body)) {
                redirect(base_url('general_mgr/dashboard'));
            } else {
                $this->session->set_flashdata('error', '登入失敗 請洽詢管理員將信箱加入允許清單');
                redirect(base_url('general_mgr/login'));
            }
        } else {
            $permissions = ['email'];
            $loginUrl = $helper->getLoginUrl(base_url('/general_mgr/login/fb'), $permissions);
            header('Location: ' . $loginUrl);
        }
    }

    public function google()
    {
        $uriFactory = new \OAuth\Common\Http\Uri\UriFactory();
        $currentUri = $uriFactory->createFromSuperGlobalArray($_SERVER);
        $currentUri->setQuery('');

        // Session storage
        $storage = new Session();

        // Setup the credentials for the requests
        $credentials = new Credentials($this->db->get_where('general_settings', array(
            'type' => 'google_id'
        ))->row()->value, $this->db->get_where('general_settings', array(
            'type' => 'google_key'
        ))->row()->value, $currentUri->getAbsoluteUri());
        /** @var $googleService Google */
        $serviceFactory = new \OAuth\ServiceFactory();
        $googleService = $serviceFactory->createService('google', $credentials, $storage, array(
            'userinfo_email',
            'userinfo_profile'
        ));
        if (!empty($_GET['code'])) {
            // retrieve the CSRF state parameter
            $state = isset($_GET['state']) ? $_GET['state'] : null;
            // This was a callback request from google, get the token
            $googleService->requestAccessToken($_GET['code'], $state);

            // Send a request with it
            $result = json_decode($googleService->request('userinfo'), true);
            if ($this->_get_auth()->google_login($result)) {
                redirect(base_url('general_mgr/dashboard'));
            } else {
                $this->session->set_flashdata('error', '登入失敗 請洽詢管理員將帳號加入允許清單');
                redirect(base_url('general_mgr/login'));
            }
        } else {
            $url = $googleService->getAuthorizationUri();
            header('Location: ' . $url);
        }
    }

    public function form($action = '')
    {
        $columns['admin_password'] = new Column_password('admin', 'admin_password', '密碼');
        if ($action == 'submit') {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('new_password', '新密碼', 'trim|required|min_length[8]');
            $this->form_validation->set_rules('new_password_confirm', '新密碼確認', 'trim|required|matches[new_password]');
            if ($this->form_validation->run() == FALSE) {
                echo validation_errors();
                $this->output->set_status_header(400);
                return;
            }

            $admin_password = $this->input->post('admin_password');
            $new_password = $this->input->post('new_password');
            if ($admin_password == $new_password) {
                echo '新密碼不得和舊密碼一樣!';
                $this->output->set_status_header(400);
                return;
            }
            if ((hash_pwd($admin_password) != $this->_get_auth()->get()->admin_password) &&
                !empty($this->_get_auth()->get()->admin_password)
            ) {
                echo '密碼錯誤';
                $this->output->set_status_header(400);
                return;
            }
            $this->db->update('admin', ['admin_password' => hash_pwd($new_password)],
                sprintf('admin_id = %d', $this->_get_auth()->get_id()));
        } else {
            $this->form->set(Form::KEY_COLUMN, $columns);
            $this->_get_layout()->view('general_mgr/login/form');
        }
    }

}

