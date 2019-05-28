<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Books extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mdl_usersBooks');
        $this->load->model('Mdl_booksRequests');
        $this->load->model('Mdl_sections');
        $this->load->model('Mdl_booksFavorites');

        $this->load->library('upload');
    }

    public function index($state = null)
    {
        if ($state == 1) {
            $condition['bookStoreBooksDetails.state'] = 1;
        } else {
            $condition['bookStoreBooksDetails.state != '] = 1;
        }
        $this->data['booksDetails'] = $this->Mdl_usersBooks->getWithSection($condition);
        $this->data['sub_view'] = 'books/index';
        $this->load->view('_main_layout', $this->data);
    }

    public function active()
    {
        $this->index(1);
    }

    public function disabled()
    {
        $this->index(2);
    }

    public function changeState($bookId = null, $state = 0)
    {
        if ($state == 1) {
            $saveData = ['state' => 1];
        } else {
            $saveData = ['state' => 0];
        }

        $bookChangeState = $this->Mdl_usersBooks->save($saveData, $bookId);
        if ($bookChangeState) {
            return true;
        } else {
            return false;
        }
    }

    public function activateBook($bookId)
    {
        if ($bookId == null || (int)$bookId <= 0) {
            $this->session->set_flashdata("errorMsg", "There's no book with this id");
            redirect(site_url());
        }
        $bookState = $this->changeState($bookId, 1);
        if ($bookState) {
            $this->session->set_flashdata("successMsg", "Book activated successfully");
            redirect(site_url('books'));
        } else {
            $this->session->set_flashdata("errorMsg", "Error activating book");
            redirect(site_url('books'));
        }
    }

    public function disableBook($bookId)
    {
        if ($bookId == null || (int)$bookId <= 0) {
            $this->session->set_flashdata("errorMsg", "There's no book with this id");
            redirect(site_url());
        }
        $bookState = $this->changeState($bookId, 0);
        if ($bookState) {
            $this->session->set_flashdata("successMsg", "Book disabled successfully");
            redirect(site_url('books'));
        } else {
            $this->session->set_flashdata("errorMsg", "Error disabling book");
            redirect(site_url('books'));
        }
    }

    public function view($bookId = null)
    {
        $this->load->model("Mdl_booksReviews");
        if ($bookId == null || (int)$bookId <= 0) {
            $this->session->set_flashdata("errorMsg", "There's no book with this id");
            redirect(site_url());
        }

        $bookDetails = $this->Mdl_usersBooks->get($bookId);
        if (empty($bookDetails)) {
            $this->session->set_flashdata("errorMsg", "There's no book with this id");
            redirect(site_url());
        }

        $this->data['favoriteJs'] = true;
        $this->data['booksJs'] = true;
        $this->data['userFavorite'] = $this->Mdl_booksFavorites->getFavoriteState($bookId);
        $this->data['bookDetails'] = $bookDetails;
        $this->data['bookReviews'] = $this->Mdl_booksReviews->getReviews($bookId);
        $this->data['sub_view'] = 'books/view';
        $this->load->view('_main_layout', $this->data);

    }

    public function addBook($bookId = null)
    {
        $rules = $this->Mdl_usersBooks->rules;
        if ($bookId) {
            $bookDetails = $this->Mdl_usersBooks->get($bookId);
            if (empty($bookDetails)) {
                $this->session->set_flashdata("errorMsg", "There's no book with this id");
                redirect(site_url());
            }
            $this->data['bookDetails'] = $bookDetails;
        }

        $this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() === true) {

            $data = $this->Mdl_usersBooks->getPosts($rules);


            $this->db->trans_begin(TRUE); // Query will be rolled back
            $bookData = [
                'bookStoreBookTitle' => $data['b_tl'],
                'bookStoreBookDescription' => $data['b_ds'],
                'bookStoreBookWriter' => $data['b_wrt'],
                'bookStoreBookPrice' => $data['b_prc'],
                'bookStoreBookOverView' => $data['b_ov'],
                "bookStoreBookRate" => $data['b_rt'],
                "bookStoreBookPriceType" => $data['b_prctp'],
                "bookStoreBookSection" => $data['b_sec']
            ];
            if ($bookId == null || $bookId == 0) {
                $bookData['bookStoreBookUserId'] = 0;
            }
            if ($_FILES['bookImg']['error'] == 0) {
                $bookImg = $this->uploadImg("bookImg");
                if ($bookImg['state'] == true) {
                    if (isset($bookDetails->bookStoreBookImg) && $bookDetails->bookStoreBookImg != NULL) {
                        @unlink('./assets/img/usersBooks/' . $bookDetails->bookStoreBookImg);
                    }
                    $bookData['bookStoreBookImg'] = $bookImg['imgName'];
                } else {
                    $bookImg = null;
                }
            }
            if ($_FILES['bookFile']['error'] == 0) {
                $bookFile = $this->uploadImg("bookFile", true);
                if ($bookFile['state'] == true) {
                    if (isset($bookDetails->bookStoreBookFile) && $bookDetails->bookStoreBookFile != NULL) {
                        @unlink('./assets/books/usersBooks/' . $bookDetails->bookStoreBookFile);
                    }
                    $bookData['bookStoreBookFile'] = $bookFile['imgName'];
                } else {
                    $bookFile = null;
                }
            }

            $updateBookId = $this->Mdl_usersBooks->save($bookData, $bookId);
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $this->session->set_flashdata("errorMsg", "There's no book with this id");
                return false;
            } else {
                $this->db->trans_commit();
                if ($bookId)
                    $this->session->set_flashdata("successMsg", "Book uploaded successfully");
                else
                    $this->session->set_flashdata("successMsg", "Book added successfully");

                redirect(site_url("books/view/$updateBookId"));
                return true;
            }

        }
        $sections = $this->Mdl_sections->get();
        $sectionsToSend[''] = 'Please Select a section';
        foreach ($sections as $section) {
            $sectionsToSend[$section->bookSectionId] = $section->bookSectionTitle;
        }
        $this->data['booksSections'] = $sectionsToSend;
        $this->data['sub_view'] = 'books/editBook';
        $this->load->view('_main_layout', $this->data);
    }

    public function updateBook($bookId = null)
    {
        if ($bookId == null || (int)$bookId <= 0) {
            $this->session->set_flashdata("errorMsg", "There's no book with this id");
            redirect(site_url());
        }
        $this->addBook($bookId);
    }


    function uploadImg($fieldName, $pdf = false)
    {
        if ($pdf) {
            $config['upload_path'] = '../assets/books/usersBooks';
            $config['allowed_types'] = 'pdf';
        } else {
            $config['upload_path'] = '../assets/img/usersBooks';
            $config['allowed_types'] = 'jpg|png|jpeg';
        }
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload');
        $this->upload->initialize($config);
        if ($this->upload->do_upload($fieldName)) {
            $data = $this->upload->data();
            return array('state' => true, 'imgName' => $data['file_name']);
        } else {
            return array('state' => false, 'errors' => $this->upload->display_errors());
        }
    }

    public function requests($bookId = null)
    {
        $this->session->set_userdata('referred_from', current_url());
        $bookRequestExist = $this->Mdl_booksRequests->getWithDetails(['bookId' => $bookId]);
        $this->data['bookRequests'] = $bookRequestExist;
        $this->data['sub_view'] = 'books/requests';
        $this->load->view('_main_layout', $this->data);
    }

    public function requestsView($state = null)
    {
        $this->session->set_userdata('referred_from', current_url());

        if ($state == 0) {
            $conditions['booksRequests.state'] = 0;
        } else {
            $conditions['booksRequests.state'] = 1;
        }
        $bookRequestExist = $this->Mdl_booksRequests->getWithDetails($conditions);
        $this->Mdl_booksRequests->setViewed();

        $this->data['viewTitle'] = true;
        $this->data['bookRequests'] = $bookRequestExist;
        $this->data['sub_view'] = 'books/requests';
        $this->load->view('_main_layout', $this->data);
    }

    public function newRequests()
    {
        return $this->requestsView(0);
    }

    public function viewedRequests()
    {
        return $this->requestsView(1);
    }

    public function search()
    {
        $args = $this->input->get();
        $resultBooks = $this->db->like(array("bookStoreBookTitle" => $args['keyword']))
            ->join('booksSections', 'booksSections.bookSectionId = bookStoreBooksDetails.bookStoreBookSection')
            ->get('bookStoreBooksDetails')->result();
        $this->data['booksStyle'] = true;
        $this->data['searchResult'] = $resultBooks;
        $this->data['sub_view'] = 'books/search';
        $this->load->view('_main_layout', $this->data);
    }

    public function delRequest($requestId = null)
    {
        if ($requestId == null) {
            $this->session->set_flashdata("errorMsg", "There's no request with this id");
            redirect(site_url('books'));
        }

        $delRequest = $this->Mdl_booksRequests->delete($requestId);
        if ($delRequest) {
            $this->session->set_flashdata("successMsg", "request deleted successfully");
            redirect($this->session->userdata('referred_from'));
        } else {
            $this->session->set_flashdata("errorMsg", "Error deleting request ,, please try again");
            redirect($this->session->userdata('referred_from'));
        }
    }

    public function delBook($bookId = null)
    {
        if ($bookId == null) {
            $this->session->set_flashdata("errorMsg", "There's no request with this id");
            redirect(site_url('books'));
        }
        $delBook = $this->Mdl_usersBooks->delete($bookId);
        if ($delBook) {
            $this->session->set_flashdata("successMsg", "book deleted successfully");
            redirect(site_url('books'));
        } else {
            $this->session->set_flashdata("errorMsg", "Error deleting book ,, please try again");
            redirect(site_url('books'));
        }
    }
}
