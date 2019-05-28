<?php

class Mdl_usersDetails extends MY_Model
{

    protected $_table_name = 'bookStoreUsersDetails';
    protected $_primary_key = 'bookStoreUsersDetailId';
    protected $_validate_primary = 'intval';
    public $registrationRules = array(
        array('field' => 'first_name', 'label' => 'FirstName', 'rules' => 'trim|required|xss_clean'),
        array('field' => 'last_name', 'label' => 'LastName', 'rules' => 'trim|required|xss_clean'),
        array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|valid_email|callback__uniqueEmail|required|xss_clean'),
        array('field' => 'password', 'label' => 'Password', 'rules' => 'trim|required|xss_clean'),
        array('field' => 'about', 'label' => 'About', 'rules' => 'trim|xss_clean'),
        array('field' => 'phone_number', 'label' => 'Phone Number', 'rules' => 'trim|required|greater_than[0]|numeric|xss_clean'),
    );
    public $detailsRules = array(
        array('field' => 'user_city', 'label' => 'FirstName', 'rules' => 'trim|numeric|required|xss_clean'),
        array('field' => 'age', 'label' => 'Password', 'rules' => 'trim|required|numeric|xss_clean'),
        array('field' => 'graduation_year', 'label' => 'Graduation year', 'rules' => 'trim|numeric|xss_clean'),
        array('field' => 'user_address', 'label' => 'User address', 'rules' => 'trim|required|xss_clean'),
    );

    public $loginRules = array(
        array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|valid_email|required|xss_clean'),
        array('field' => 'password', 'label' => 'Password', 'rules' => 'trim|required|xss_clean'),
    );
    protected $_order_by = '';
    protected $_timestamp = FALSE;

    public function __construct()
    {
        parent::__construct();
    }

    public $details = array(
        // start of basic info
        'bookStoreUsersDetailId', 'bookStoreUsersDetailFirstName', 'bookStoreUsersDetailLastName',
        'bookStoreUsersDetailCv', 'bookStoreUsersDetailEmail', 'bookStoreUsersDetailHashPass',
        'bookStoreUsersDetailAbout', 'bookStoreUsersDetailPhoneNumber',
        // end of basic info

        'bookStoreUsersDetailFrom', 'bookStoreUsersDetailFromId',


        'bookStoreUsersDetailUserProfileImg', 'bookStoreUsersDetailSpecialityId',
        'bookStoreUsersDetailCityId', 'bookStoreUsersDetailUniversityId', 'bookStoreUsersDetailAge',
        'bookStoreUsersDetailGraduationYear', 'bookStoreUsersDetailAddress', 'bookStoreUsersDetailHospitalAddress',
        'bookStoreUsersDetailHighestDegree'
    );

    public function checkLogin($email = null, $password = null)
    {
        if (trim($email) == null || trim($password) == null)
            return false;

        $userDetails = $this->get_where(array('bookStoreUsersDetailEmail' => $email));
        if (!empty($userDetails)) {
            $userDetails = $userDetails[0];
            if (password_verify($password, $userDetails->bookStoreUsersDetailHashPass)) {
                $userSess = array(
                    'bookStoreUserSessId' => $userDetails->bookStoreUsersDetailId,
                    'bookStoreUserSessName' => $userDetails->bookStoreUsersDetailFirstName . ' ' . $userDetails->bookStoreUsersDetailLastName,
                    'bookStoreSessType' => 2,
                    'bookStoreSessLoggedIn' => true
                );
                $this->session->set_userdata($userSess);
                return $userDetails;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    public function setUserSeesionDetails($userId = null)
    {
        if ($userId == null || (int)$userId <= 0)
            return false;

        $userDetails = $this->get($userId);
        if (empty($userDetails))
            return FALSE;

        $userSess = array(
            'bookStoreUserSessId' => $userDetails->bookStoreUsersDetailId,
            'bookStoreUserSessName' => $userDetails->bookStoreUsersDetailFirstName . ' ' . $userDetails->bookStoreUsersDetailLastName,
            'bookStoreSessType' => 2,
            'bookStoreSessLoggedIn' => true
        );

        $sessionSet = $this->session->set_userdata($userSess);
        return true;
    }

    public function getWithDetails($conditionalArr = null)
    {

        if ($conditionalArr == null || empty($conditionalArr)) {
            return [];
        }
        return $this->db
            ->where($conditionalArr)
            ->from('bookStoreUsersDetails')
            ->get()
            ->result();
    }


    public function getNewDetails()
    {
        $rules = $this->detailsRules;
        $data = array();
        foreach ($rules as $key => $formInput) {
            $data[$this->db->escape_str(form_prep($formInput['field']))] = $this->db->escape_str(form_prep($this->input->post($formInput['field'])));
        }
        return (object)$data;
    }


}
