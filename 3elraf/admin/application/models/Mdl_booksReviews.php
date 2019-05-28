<?php

class Mdl_booksReviews extends MY_Model
{

    protected $_table_name = 'booksReviews';
    protected $_primary_key = 'bookReviewId';
    protected $_validate_primary = 'intval';
    public $rules = array(
        array('field' => 'userReview', 'label' => 'review description', 'rules' => 'trim|required|xss_clean'),
        array('field' => 'reviewRate', 'label' => 'review rate', 'rules' => 'trim|required|xss_clean'),
    );
    protected $_order_by = '';
    protected $_timestamp = FALSE;

    public function __construct()
    {
        parent::__construct();
    }


    public function getReviews($bookId = null)
    {
        return $this->db->select('concat(bookStoreUsersDetails.bookStoreUsersDetailFirstName," ",
                    bookStoreUsersDetails.bookStoreUsersDetailLastName) as userName ,
                    bookStoreUsersDetails.bookStoreUsersDetailUserProfileImg,booksReviews.bookReviewUserId,
                    booksReviews.bookReviewDescription,booksReviews.bookReviewUserRate,booksReviews.bookReviewTime')
            ->join("bookStoreUsersDetails","bookStoreUsersDetails.bookStoreUsersDetailId = booksReviews.bookReviewUserId")
            ->where(array("booksReviews.bookReviewBookId" => $bookId))
            ->get("booksReviews")->result();
    }

}
