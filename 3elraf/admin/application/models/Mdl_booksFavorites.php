<?php

class Mdl_booksFavorites extends MY_Model
{

    protected $_table_name = 'booksFavorites';
    protected $_primary_key = 'bookFavoriteId';
    protected $_validate_primary = 'intval';
    public $rules = array(
        array('field' => 'userId', 'label' => 'user id', 'rules' => 'trim|required|xss_clean'),
        array('field' => 'bookId', 'label' => 'book id', 'rules' => 'trim|required|xss_clean'),
    );
    protected $_order_by = '';
    protected $_timestamp = FALSE;

    public function __construct()
    {
        parent::__construct();
    }


    public function getFavoriteState($bookId = null)
    {
        if($bookId == null)
            return false;

        $favoriteState = $this->get_where(array("bookId" => $bookId));
        if(!empty($favoriteState))
            return true;
        else
            return false;
    }

    public function getWithDetails($whereCond = null)
    {
        $this->db->select("bookStoreBooksDetails.bookStoreBookTitle,bookStoreBooksDetails.bookStoreBookImg,
bookStoreBooksDetails.bookStoreBookWriter,booksFavorites.bookId")
            ->from("booksFavorites")
            ->join("bookStoreBooksDetails", "bookStoreBooksDetails.bookStoreBookId = booksFavorites.bookId");
        if ($whereCond != null && !empty($whereCond))
            $this->db->where($whereCond);

        return $this->db->get()->result();
    }

}
