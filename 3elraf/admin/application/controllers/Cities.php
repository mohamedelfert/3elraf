<?php

class Cities extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Mdl_cities');
    }

    public function index()
    {
        $this->data['cities'] = $this->Mdl_cities->get();
        $this->data['sub_view'] = 'cities/index';
        $this->load->view('_main_layout', $this->data);
    }

    public function addCity($cityId = NULL) {
        $rules = $this->Mdl_cities->rules;

        if($cityId != null){
            $city = $this->Mdl_cities->get($cityId);
            if(empty($city)){
                $this->session->set_flashdata('msg', 'تم تعديل المدينه بنجاح');
                redirect(site_url('cities/'));
            }
            $this->data['city'] = $city;
        }else{
            $this->data['city'] = $this->Mdl_cities->getNew($rules);
        }

        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == TRUE) {
            $data = $this->Mdl_cities->getPosts($rules);
            $updatedId = $this->Mdl_cities->save($data, $cityId);
            if ($updatedId) {
                if($cityId){
                    $this->session->set_flashdata('successMsg', 'تم تعديل المدينه بنجاح');
                    redirect(site_url('cities/editCity/'.$cityId));
                }else{
                    $this->session->set_flashdata('successMsg', 'تم اضافه المدينه بنجاح');
                    redirect(site_url('cities/'));
                }
            } else {
                if($cityId){
                    $this->session->set_flashdata('errorMsg', 'حدث خطا اثناء التعديل الرجاء المحاوله مره اخرى');
                    redirect(site_url('cities/editCity/'.$cityId));
                }else{
                    $this->session->set_flashdata('errorMsg', 'حدث خطا اثناء الاضافه الرجاء المحاوله مره اخرى');
                    redirect(site_url('cities/addCity/'));
                }
                redirect(site_url('cities/'));
            }
        }
        $this->data['sub_view'] = 'cities/edit';
        $this->load->view('_main_layout', $this->data);
    }
    
    public function editCity($cityId = null) {
        $this->addCity($cityId);
    }

}
