<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sections extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mdl_sections');
    }

    public function index() {

        $this->data['sections'] = $this->Mdl_sections->get();
        $this->data['sub_view'] = 'sections/index';
        $this->load->view('_main_layout', $this->data);
    }


    public function addSection($sectionId = NULL) {
        $sectionId = (int) $sectionId;
        if ($sectionId == NULL || $sectionId <= 0) {
            $this->data['sectionData'] = $sectionData = $this->Mdl_sections->getNew();
        } else {
            $this->data['sectionData'] = $sectionData = $this->Mdl_sections->get($sectionId);
            if (empty($sectionData)) {
                $this->session->set_flashdata('errorMsg', 'Error ,, There Is No Section With In This Url');
                redirect(site_url('sections'));
            }
        }
        $rules = $this->Mdl_sections->rules;
        $this->form_validation->set_error_delimiters('<p style="color: red;"></p>');
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() === TRUE) {
            $data = $this->Mdl_sections->getPosts($rules);

            if ($sectionId == 0) {
                $sectionId = NULL;
            }
            $sectionUpdateId = $this->Mdl_sections->save($data, $sectionId);
            if ($sectionUpdateId) {
                if ($sectionId) {
                    $this->session->set_flashdata('successMsg', 'تم تعديل القسم بنجاح');
                } else {
                    $this->session->set_flashdata('successMsg', 'تم اضافه القسم بنجاح');
                }
                redirect(site_url('sections/'));
            } else {
                if ($sectionId) {
                    $this->session->set_flashdata('errorMsg', 'حدث خطا اثناء تعديل القسم الرجاء المحاوله مره اخرى');
                    redirect(site_url('sections/addSection'));
                } else {
                  $this->session->set_flashdata('errorMsg', 'حدث خطا اثناء اضافه القسم برجاء المحاوله مره اخرى');
                    redirect(site_url('sections/updateSection/' . $sectionUpdateId));
                }
            }
        }

        $this->data['sub_view'] = 'sections/register';
        $this->load->view('_main_layout', $this->data);
    }

    public function updateSection($sectionId = NULL) {
        $sectionId = (int) $sectionId;
        if ($sectionId == NULL || $sectionId == 0) {
            $this->session->set_flashdata('errorMsg', 'خطا لا يوجد القسم بهذا الرابط');
            redirect(site_url('sections'));
        }
        $this->addSection($sectionId);
    }

    public function delSection($sectionId = null)
    {
        if($sectionId == null || (int) $sectionId <= 0){
            $this->session->set_flashdata('errorMsg', 'خطا لا يوجد القسم بهذا الرابط');
            redirect(site_url('sections'));
        }

        $delSection = $this->Mdl_sections->delete($sectionId);
        if($delSection){
            $this->session->set_flashdata('successMsg', 'تم حذف القسم');
            redirect(site_url('sections'));
        }else{
            $this->session->set_flashdata('errorMsg', 'حدث خطا اثناء حذف القسم الرجاء المحاوله مره اخرى');
            redirect(site_url('sections'));
        }
    }

}
