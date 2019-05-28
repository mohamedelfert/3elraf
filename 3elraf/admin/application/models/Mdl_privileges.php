<?php

class Mdl_privileges extends MY_Model {

    protected $_table_name = 'bookStorePrivileges';
    protected $_primary_key = 'privilegeId';
    protected $_validate_primary = 'intval';
    public $rules = array(
        array('field' => 'privilegeTitle', 'label' => 'privilege Title', 'rules' => 'trim|required|xss_clean'),
    );
    protected $_order_by = '';
    protected $_timestamp = FALSE;

    public function __construct() {
        parent::__construct();
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
