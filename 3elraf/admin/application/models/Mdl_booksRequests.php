<?php

class Mdl_booksRequests extends MY_Model
{

    protected $_table_name = 'booksRequests';
    protected $_primary_key = 'bookRequestId';
    protected $_validate_primary = 'intval';
    public $rules = array(//        array('field' => 'b_id', 'label' => 'Book Id', 'rules' => 'trim|required|xss_clean'),
    );
    protected $_order_by = '';
    protected $_timestamp = FALSE;

    public function __construct()
    {
        parent::__construct();
    }

    public function getRequestsCount($userId = null)
    {
        if ($userId == null || (int)$userId <= 0) {
            return null;
        }
        return $this->db->where(array('userId' => $userId))->count_all_results($this->_table_name);
    }

    public function setViewed()
    {
        $updated = $this->db->set(array("state" => 1))->update($this->_table_name);
        if ($updated)
            return true;
        else
            return false;
    }

    public function getWithDetails($whereCond = null)
    {
        $this->db->select("concat(bookStoreUsersDetails.bookStoreUsersDetailFirstName,' ',
                    bookStoreUsersDetails.bookStoreUsersDetailLastName) as userName ,
                    bookStoreUsersDetails.bookStoreUsersDetailUserProfileImg,
                    bookStoreBooksDetails.bookStoreBookTitle,
                    bookStoreBooksDetails.bookStoreBookImg,
                    bookStoreBooksDetails.bookStoreBookWriter,booksRequests.bookId,
                    booksRequests.userId,bookStoreUsersDetails.bookStoreUsersDetailEmail,
                    bookStoreUsersDetails.bookStoreUsersDetailPhoneNumber,
                    booksRequests.bookRequestId")
            ->from("booksRequests")
            ->join("bookStoreBooksDetails", "bookStoreBooksDetails.bookStoreBookId = booksRequests.bookId")
            ->join("bookStoreUsersDetails", "bookStoreUsersDetails.bookStoreUsersDetailId = booksRequests.userId");
        if ($whereCond != null && !empty($whereCond))
            $this->db->where($whereCond);

        return $this->db->get()->result();
    }

}
