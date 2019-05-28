<?php

class Mdl_sections extends MY_Model {

    protected $_table_name='booksSections';
    protected $_primary_key ='bookSectionId';
    public $rules =array(
        array('field' => 'bookSectionTitle','label' => 'Section Title', 'rules' => 'trim|required|xss_clean'),
        array('field' => 'showInHome','label' => 'Show in home', 'rules' => 'trim|required|xss_clean'),
    );
    protected $_primary_filter ='intval';
    protected $_order_by = '';
    protected $_timestamps = TRUE;

    function __construct() {
        parent::__construct();
    }


    public function getNew($rules = null) {
        $rules = $this->rules;
        $data = array();
        foreach ($rules as $key => $formInput) {
            $data[$this->db->escape_str(form_prep($formInput['field']))] = $this->db->escape_str(form_prep($this->input->post($formInput['field'])));
        }
        return (object)$data;
    }

}
