<?php

class Mdl_cities extends MY_Model {

    protected $_table_name = 'cities';
    protected $_primary_key = 'id';
    protected $_validate_primary = 'intval';
    public $rules = array(
        array('field' => 'cityName', 'label' => 'City Name', 'rules' => 'trim|required|xss_clean'),
    );
    protected $_order_by = '';
    protected $_timestamp = false;

    function __construct() {
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
