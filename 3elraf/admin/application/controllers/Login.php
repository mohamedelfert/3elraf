<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mdl_admins');
    }

      public function index() {

        $rules = $this->Mdl_admins->loginRules;
        $this->form_validation->set_error_delimiters('<p style="color: red;"></p>');
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() === TRUE) {
            $data = $this->Mdl_admins->getPosts($rules);
            $userData = $this->Mdl_admins->get_where(array('bookStoreAdminEmail' => $data['email']));
            if (!empty($userData)) {
                $userData = $userData[0];
                if (password_verify($data['password'], $userData->bookStoreAdminHashPass) == TRUE) {
                    $managerLoggedIn = $this->Mdl_admins->login($userData->adminId);
                    if ($managerLoggedIn) {
                        $this->session->set_flashdata('successMsg', 'Welcome ' . $userData->bookStoreAdminName);
                        redirect(site_url());
                    } else {
                        $this->session->set_flashdata('errorMsg', 'Please Check Your Email And Password');
                    }
                } else {
                    $this->session->set_flashdata('errorMsg', 'Please Check Your Email And Password');
                }
            } else {
                $this->session->set_flashdata('errorMsg', 'Please Check Your Email And Password');
            }
        }

        $this->data['sub_view'] = 'users/login';
        $this->load->view('_model_layout', $this->data);
    }

}
