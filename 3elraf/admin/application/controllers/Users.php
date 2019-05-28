<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mdl_admins');
        $this->load->model('Mdl_privileges');
        $this->load->model('Mdl_adminPrevilleges');
    }

    public function index() {
        $this->data['users'] = $this->Mdl_admins->get_where(array('adminId !=' => $this->session->userdata('bookStoreAdminId')));
        $this->data['sub_view'] = 'users/index';
        $this->load->view('_main_layout', $this->data);
    }


    public function addAdmin($userId = NULL) {
        $userId = (int) $userId;
        if ($userId == NULL || $userId == 0) {
            $this->data['userData'] = $userData = $this->Mdl_admins->getNew();
            $this->data['adminPrevilleges'] = [];
        } else {
            $this->data['userData'] = $userData = $this->Mdl_admins->get($userId);
            if (empty($userData)) {
                $this->session->set_flashdata('errorMsg', 'Error ,, There Is No User With In This Url ,, Please Check Url And Try Again');
                redirect(site_url('users'));
            }
            $this->data['adminPrevilleges'] = $this->Mdl_adminPrevilleges->get_where(array('adminId' => $userId));
        }
        $rules = $this->Mdl_admins->rules;
        ($userId != NULL || $userId != 0) || $rules[5]['rules'] .= '|required';
        ($userId != NULL || $userId != 0) || $rules[6]['rules'] .= '|required';
        $this->form_validation->set_error_delimiters('<p style="color: red;"></p>');
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() === TRUE) {
            $data = $this->Mdl_admins->getPosts($rules);

            if ($data['password'] != NULL) {
                $data['bookStoreAdminHashPass'] = password_hash($data['password'], PASSWORD_DEFAULT);
            }
            unset($data['password'], $data['password_confirm']);
            if ($userId == 0) {
                $userId = NULL;
            }
            $managerUpdateId = $this->Mdl_admins->save($data, $userId);
            if ($managerUpdateId) {
                if($this->input->post('adminPrivileges') != null){
                    $privilegesToSend = [];
                    foreach ($this->input->post('adminPrivileges') as $privilege){
                        $privilegesToSend[] = ['privilegeId' => $privilege , 'adminId' => $managerUpdateId];
                    }
                    $setPrivileges = $this->Mdl_adminPrevilleges->save($privilegesToSend,$managerUpdateId);
                    if(!$setPrivileges){
                        if ($userId != 0) {
                            $this->session->set_flashdata('errorMsg', 'Error Adding New Admin ,, Please Try Again');
                            redirect(site_url('users/addUser'));
                        } else {
                            $this->session->set_flashdata('errorMsg', 'Error Updating Admin ,, Please Try Again');
                            redirect(site_url('users/updateManager/' . $userId));
                        }
                    }
                }
                if ($userId != 0) {
                    $this->session->set_flashdata('successMsg', 'Admin has been Updated successfully');
                    redirect(site_url('users/'));
                } else {
                    $this->session->set_flashdata('successMsg', 'Admin has been added successfully');
                    redirect(site_url('users/updateAdmin/' . $managerUpdateId));
                }
            } else {
                if ($userId != 0) {
                    $this->session->set_flashdata('errorMsg', 'Error Adding New Manager ,, Please Try Again');
                    redirect(site_url('users/addUser'));
                } else {
                    $this->session->set_flashdata('errorMsg', 'Error Updating Manager ,, Please Try Again');
                    redirect(site_url('users/updateAdmin/' . $userId));
                }
            }
        }

        $this->data['managerPrivileges'] = true;
        $this->data['privileges'] = $this->Mdl_privileges->get();
        $this->data['sub_view'] = 'users/register';
        $this->load->view('_main_layout', $this->data);
    }

    public function updateAdmin($userId = NULL) {
        $userId = (int) $userId;
        if ($userId == NULL || $userId == 0) {
            $this->session->set_flashdata('errorMsg', 'Error ,, There Is No Admin With In This Url ,, Please Check Url And Try Again');
            redirect(site_url('users'));
        }
        $this->addAdmin($userId);
    }

    function _unique_email($userEmail) {
        $condition = array('bookStoreAdminEmail' => $userEmail);
        if (isset($_POST['adminId'])) {
            $condition['adminId !='] = $this->input->post('adminId');
        }
        $user = $this->Mdl_admins->get_where($condition);
        if (count($user)) {
            $this->form_validation->set_message('_unique_email', '%s Must be unique');
            return FALSE;
        }
        return TRUE;
    }


    public function updateMyDetails()
    {
        if($this->session->userdata('bookStoreAdminLoggedInType') != 1){
            $this->session->set_flashdata('errorMsg', 'Error ,, There Is No Admin With In This Url ,, OR you are not allowed to get here');
            redirect(site_url('users'));
        }
        $this->addAdmin($this->session->userdata('bookStoreAdminId'));
    }
    
    public function logout() {
        $this->session->sess_destroy();
        redirect(base_url());
    }


    public function delAdmin($adminId = null)
    {
        if ($adminId == null || (int)$adminId <= 0) {
            $this->session->set_flashdata('errorMsg',"There's no admin in the link");
            redirect(base_url('users'));

        }
        $delUser = $this->Mdl_admins->delete($adminId);
        if ($delUser) {
            $this->session->set_flashdata('successMsg',"admin deleted successfully");
            redirect(site_url('users'));
        } else {
            $this->session->set_flashdata('errorMsg',"There's no admin in the link");
            redirect(site_url('users'));
        }
    }
}
