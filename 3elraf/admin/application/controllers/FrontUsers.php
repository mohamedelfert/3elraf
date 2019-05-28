<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class FrontUsers extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mdl_usersDetails');
    }

    public function index()
    {
        $this->data['users'] = $this->Mdl_usersDetails->get();
        $this->data['sub_view'] = 'users/frontUsers';
        $this->load->view('_main_layout', $this->data);
    }

    public function delUser($userId = null)
    {
        if ($userId == null || (int)$userId <= 0) {
            $this->session->set_flashdata('errorMsg',"There's no user in the link");
            redirect(site_url('frontUsers'));

        }
        $delUser = $this->Mdl_usersDetails->delete($userId);
        if ($delUser) {
            $this->session->set_flashdata('successMsg',"user deleted successfully");
            redirect(site_url('frontUsers'));
        } else {
            $this->session->set_flashdata('errorMsg',"There's no user in the link");
            redirect(site_url('frontUsers'));
        }
    }
}
