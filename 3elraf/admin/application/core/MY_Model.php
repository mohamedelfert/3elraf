<?php

class MY_Model extends CI_Model {

    protected $_table_name = '';
    protected $_primary_key = 'id';
    protected $_validate_primary = 'intval';
    public $rules = array();
    protected $_order_by = '';
    protected $_timestamp = FALSE;

    function __construct() {
        parent::__construct();
    }

    public function getPosts($rules) {
        $data = array();
        foreach ($rules as $key => $formInput) {
            $data[$this->db->escape_str(form_prep($formInput['field']))] = $this->db->escape_str(form_prep($this->input->post($formInput['field'])));
        }
        return $data;
    }
    public function getPostsNottNull($rules) {
        $data = array();
        foreach ($rules as $key => $formInput) {
            if($this->input->post($formInput['field']) != NULL && $this->input->post($formInput['field']) != 0){
                $data[$this->db->escape_str(form_prep($formInput['field']))] =
                        $this->db->escape_str(form_prep($this->input->post($formInput['field'])));
            }
        }
        return $data;
    }

    public function getPostsErrors($rules) {
        $errors = array();
        foreach ($rules as $key => $formInput) {
            if (form_error($formInput['field'])) {
                $errorMessage = form_error($formInput['field']);
                $errors[$formInput['field']] = strip_tags($errorMessage);
            }
        }
        return $errors;
    }

    function get($id = NULL, $single = FALSE) {
        if ($id != NULL) {
            $filter = $this->_validate_primary;
            $id = $filter($id);
            $this->db->where($this->_primary_key, $id);
            $method = 'row';
        } elseif ($single != FALSE) {
            $method = 'row';
        } else {
            $method = 'result';
        }

        if ($this->_order_by) {
            $this->db->order_by($this->_order_by);
        }
        return $this->db->get($this->_table_name)->$method();
    }

    function get_where($where = null, $single = NULL,$limit = NULL,$offset = NULL) {
        if($where != NULL){
            $this->db->where($where);
        }
        if($limit != NULL){
            $this->db->limit($limit,$offset);
        }
        if ($this->_order_by) {
            $this->db->order_by($this->_order_by);
        }
        return $this->db->get($this->_table_name, $single)->result();
    }
    
    

    function save($data, $id = NULL) {
        if ($this->_timestamp != FALSE) {
            $now = date('Y-m-d H-i-s');
            $id || $data['postDate'] = $now;
            !$id || $data['updateDate'] = $now;
        }

        if ($id === NULL) {
            //insert new one
            //make primary key null because we don't want to change it
            !isset($data[$this->_primary_key]) || $data[$this->_primary_key] = NULL;
            //set data and insert it
            $this->db->set($data);
            $this->db->insert($this->_table_name);
            //return id of new element
            $id = $this->db->insert_id();
        } else {
            //security to filter id
            $filter = $this->_validate_primary;
            $id = $filter($id);
            $this->db->set($data);
            $this->db->where($this->_primary_key, $id);
            $this->db->update($this->_table_name);
        }
        return $id;
    }

    function delete($id) {
        $filter = $this->_validate_primary;
        $id = $filter($id);
        $this->db->where($this->_primary_key, $id);
        $this->db->limit(1);
        return $this->db->delete($this->_table_name);
    }
}
