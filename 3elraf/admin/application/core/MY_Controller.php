<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->data['site_name'] = 'bookStore Admin Area';
        if (!isset($_SESSION['bookStoreAdminSessLoggedIn'])) {
            //must login redirect to home
            if (uri_string() != "login") {
                redirect(site_url("login"));
            }
        } else {

        }
    }

}
