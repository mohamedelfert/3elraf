<?php

class Mdl_adverts extends MY_Model {

    protected $_table_name = 'adverts';
    protected $_primary_key = 'advertId';
    protected $_validate_primary = 'intval';
    public $rules = array(
        array('field' => 'advertStart', 'label' => 'Start Date', 'rules' => 'trim|required|xss_clean'),
        array('field' => 'advertEnd', 'label' => 'End Date', 'rules' => 'trim|required|xss_clean'),
        array('field' => 'advertLink', 'label' => 'Advert Link', 'rules' => 'trim|required|xss_clean'),
        array('field' => 'agentName', 'label' => 'Agent Name', 'rules' => 'trim|required|xss_clean'),
        array('field' => 'syndicalName', 'label' => 'Syndical Name', 'rules' => 'trim|required|xss_clean'),
        array('field' => 'advertPrice', 'label' => 'Advert Price', 'rules' => 'trim|required|xss_clean'),
        array('field' => 'advertImg', 'label' => 'Advert Position', 'rules' => 'trim|callback__notEmptyImg|xss_clean'),
    );
    protected $_order_by = '';
    protected $_timestamp = FALSE;

    public function __construct() {
        parent::__construct();
    }


    public function getWithTime()
    {
        return $this->db
            ->where('DATE(now()) BETWEEN advertStart AND (advertEnd)')
            ->get($this->_table_name)->result();
    }

    public function getNew() {
        $rules = $this->rules;
        $data = array();
        foreach ($rules as $key => $formInput) {
            $data[$this->db->escape_str(form_prep($formInput['field']))] = 
                    $this->db->escape_str(form_prep($this->input->post($formInput['field'])));
        }
        return (object)$data;
    }

}
