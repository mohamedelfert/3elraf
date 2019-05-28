<?php

class Adverts extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Mdl_adverts');
    }

    public function index()
    {
        $this->data['advertsDetails'] = $this->Mdl_adverts->get();
        $this->data['sub_view'] = 'adverts/index';
        $this->load->view('_main_layout',$this->data);
    }

    public function addAdvert($advertId = null)
    {
        if($advertId){
            $this->data['advertDetails'] = $advertDetails = $this->Mdl_adverts->get($advertId);
            if(empty($advertDetails)){
                $this->session->set_flashdata('errorMsg','لا يوجد اعلان بهذا الرابط الرجاء التاكد واعادة المحاوله');
                redirect(site_url('adverts'));
            }
        } else {
            $this->data['advertDetails'] = $advertsDetails = $this->Mdl_adverts->getNew();
        }

        $rules = $this->Mdl_adverts->rules;
        $this->form_validation->set_rules($rules);
        if($this->form_validation->run() === true){
            $data = $this->Mdl_adverts->getPosts($rules);

            $imgName = $this->uploadImg('advertImg');
            if($imgName){
                if($advertId && $advertDetails->advertImg != NULL
                    && is_file('../assets/img/advertImgs/'.$advertDetails->advertImg)){
                    @unlink('../assets/img/advertImgs/'.$advertDetails->advertImg);
                }
                $data['advertImg'] = $imgName;
            } elseif($this->input->post('advertId') == null) {
                if($advertId){
                    $this->session->set_flashdata('errorMsg', 'Error uploading Advert Img');
                    redirect(site_url('adverts/updateAdvert/'.$advertId));
                }else{
                    $this->session->set_flashdata('errorMsg', 'Error Creating Advert Img');
                    redirect(site_url('adverts/updateAdvert'));
                }
            }else{
                unset($data['advertImg']);
            }

            $updateAdvert = $this->Mdl_adverts->save($data,$advertId);
            if($updateAdvert){
                if($advertId){
                    $this->session->set_flashdata('successMsg', 'Advert Updated Successfully');
                    redirect(site_url('adverts/'));
                }else{
                    $this->session->set_flashdata('successMsg', 'Advert Created Successully');
                    redirect(site_url('adverts/'));
                }
            }else{
                if($advertId){
                    $this->session->set_flashdata('errorMsg', 'Error Updating Advert');
                    redirect(site_url('adverts/updateAdvert/'.$advertId));
                }else{
                    $this->session->set_flashdata('errorMsg', 'Error Creating Advert');
                    redirect(site_url('adverts/'));
                }
            }
        }

        $this->data['sub_view'] = 'adverts/update';
        $this->load->view('_main_layout',$this->data);

    }

    public function updateAdvert($advertId = null)
    {
        if($advertId == null || (int) $advertId <= 0){
            $this->session->set_flashdata('errorMsg','لا يوجد اعلان بهذا الرابط الرجاء التاكد واعادة المحاوله');
            redirect(site_url('adverts'));
        }

        $this->addAdvert($advertId);
    }

    public function _notEmptyImg($imgField)
    {
        if($_FILES['advertImg']['error'] > 0 && $this->input->post('advertId') == null){
            $this->form_validation->set_message('_notEmptyImg', 'Error uploading Img ,, Please Select A valid Image');
            return false;
        }else{
            return true;
        }
    }

    function uploadImg($fieldName) {
        $config['upload_path'] = '../assets/img/advertImgs';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);
        if ($this->upload->do_upload($fieldName)) {
            return $this->upload->data()['file_name'];
        } else {
            return FALSE;
        }
    }

    public function delAdvert($advertId = null)
    {
        if($advertId == null || (int) $advertId <= 0){
            $this->session->set_flashdata('errorMsg','لا يوجد اعلان بهذا الرابط الرجاء التاكد واعادة المحاوله');
            redirect(site_url('adverts'));
        }
        $advertDetails = $this->Mdl_adverts->get($advertId);
        if($advertId && $advertDetails->advertImg != NULL
            && is_file('../assets/img/advertImgs/'.$advertDetails->advertImg)){
            @unlink('../assets/img/advertImgs/'.$advertDetails->advertImg);
        }

        $delAdv = $this->Mdl_adverts->delete($advertId);
        if($delAdv){
            $this->session->set_flashdata('successMsg','تم حذف الاعلان بنجاح');
            redirect(site_url('adverts'));
        } else {
            $this->session->set_flashdata('errorMsg','حدث خطا اثناء الحذف  برجاء المحاوله مره اخرى');
            redirect(site_url('adverts'));
        }
    }
    
}