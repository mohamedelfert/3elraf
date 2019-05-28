<?php

class Mdl_adminPrevilleges extends MY_Model {

    protected $_table_name = 'subAdminsPrivileges';
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

    public function save($data, $id = NULL) {

        if($id){
            $this->db->where(array('`adminId`' => $id))->delete($this->_table_name);
        }
            //insert new one
            //make primary key null because we don't want to change it
            !isset($data[$this->_primary_key]) || $data[$this->_primary_key] = NULL;
            //set data and insert it
            $this->db->insert_batch($this->_table_name, $data);
            //return id of new element
            $id = $this->db->insert_id();

        return $id;
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
