<?php

class Mdl_admins extends MY_Model {

    protected $_table_name = 'bookStoreAdmins';
    protected $_primary_key = 'adminId';
    protected $_validate_primary = 'intval';
    public $rules = array(
        array('field' => 'bookStoreAdminName', 'label' => 'User Name', 'rules' => 'trim|required|xss_clean'),
        array('field' => 'bookStoreAdminType', 'label' => 'admin Type', 'rules' => 'trim|required|xss_clean'),
        array('field' => 'bookStoreAdminEmail', 'label' => 'admin Email', 'rules' => 'trim|required|xss_clean|valid_email|callback__unique_email'),
        array('field' => 'bookStoreAdminPhone', 'label' => 'admin Phone', 'rules' => 'trim|required|numeric|xss_clean'),
        array('field' => 'bookStoreAdminAnotherData', 'label' => 'Another Data', 'rules' => 'trim|xss_clean'),
        array('field' => 'password', 'label' => 'Password', 'rules' => 'trim|xss_clean'),
        array('field' => 'password_confirm', 'label' => 'Password Confirm', 'rules' => 'trim|matches[password]|xss_clean'),
    );
    public $loginRules = array(
        array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|xss_clean|valid_email'),
        array('field' => 'password', 'label' => 'Password', 'rules' => 'trim|required'),
    );
    public $getRules = array(
        array('field' => 'userId', 'label' => 'Email', 'rules' => 'trim|required|xss_clean'),
    );
    protected $_order_by = '';
    protected $_timestamp = FALSE;

    public function __construct() {
        parent::__construct();
    }

    public function login($managerId = NULL) {
        $managerId = (int) $managerId;
        if ($managerId == NULL || $managerId == 0) {
            return FALSE;
        }
        $userData = $this->get($managerId);
        if(empty($userData))
            return FALSE;
        
        $dataSession = array(
            'bookStoreAdminName' => $userData->bookStoreAdminName,
            'bookStoreAdminId' => $userData->adminId,
            'bookStoreAdminEmail' => $userData->bookStoreAdminEmail,
            'bookStoreAdminPhone' => $userData->bookStoreAdminPhone,
            'bookStoreAdminLoggedInType' => $userData->bookStoreAdminType,
            'bookStoreAdminSessLoggedIn' => 1,
        );

        $this->session->set_userdata($dataSession);
        return TRUE;
    }
    public function getNew() {
        $rules = $this->rules;
        $data = array();
        foreach ($rules as $key => $formInput) {
            $data[$this->db->escape_str(form_prep($formInput['field']))] = $this->db->escape_str(form_prep($this->input->post($formInput['field'])));
        }
        return (object)$data;
    }



}
