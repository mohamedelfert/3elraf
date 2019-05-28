<?php

class Mdl_usersBooks extends MY_Model
{

    protected $_table_name = 'bookStoreBooksDetails';
    protected $_primary_key = 'bookStoreBookId';
    protected $_validate_primary = 'intval';
    public $rules = array(
        array('field' => 'b_tl', 'label' => 'Book Title', 'rules' => 'trim|required|xss_clean'),
        array('field' => 'b_ds', 'label' => 'Book Description', 'rules' => 'trim|required|xss_clean'),
        array('field' => 'b_wrt', 'label' => 'Book Writer', 'rules' => 'trim|required|xss_clean'),
        array('field' => 'b_prc', 'label' => 'Book Price', 'rules' => 'trim|required|xss_clean'),
        array('field' => 'b_ov', 'label' => 'Book overview', 'rules' => 'trim|required|xss_clean'),
        array('field' => 'b_prctp', 'label' => 'Book Price Type', 'rules' => 'trim|required|xss_clean'),
        array('field' => 'b_rt', 'label' => 'Book Rate', 'rules' => 'trim|required|xss_clean'),
        array('field' => 'b_sec', 'label' => 'Book Section', 'rules' => 'trim|required|xss_clean'),
    );
    protected $_order_by = '';
    protected $_timestamp = FALSE;

    public function __construct()
    {
        parent::__construct();
    }


    public function getWithDetails()
    {

        $sectionToShowInHome = $this->Mdl_sections->get_where(array('showInHome' => 1));

        foreach ($sectionToShowInHome as $section){
            $section->books = $this->db->limit(4)
                ->where(array("bookStoreBookSection" => $section->bookSectionId))
                ->get("bookStoreBooksDetails")
                ->result();
        }

        return $sectionToShowInHome;
    }

    public function getWithSection($condArr = null, $likeArr=null)
    {

        $this->db
            ->join("bookStoreBooksDetails","bookStoreBooksDetails.bookStoreBookSection = booksSections.bookSectionId");
            if($condArr != null && !empty($condArr))
                $this->db->where($condArr);

            if($likeArr != null && !empty($likeArr))
                $this->db->where($condArr);

        return $this->db->get("booksSections")->result();
        
    }

    public function getNew()
    {
        $rules = $this->rules;
        $data = array();
        foreach ($rules as $key => $formInput) {
            $data[$this->db->escape_str(form_prep($formInput['field']))] = $this->db->escape_str(form_prep($this->input->post($formInput['field'])));
        }
        return (object)$data;
    }

}
