<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class DashBoard extends MY_Controller {

    public function index() {
        $this->data['sub_view'] = 'dashboard/index';
        $this->load->view('_main_layout' ,  $this->data);
    }

}
