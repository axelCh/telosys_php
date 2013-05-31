<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Book extends CI_Controller {

	/* NUMBER OF RECORDS PER PAGE */
	private $limit = 10;

	function __construct() {
		parent::__construct();
	
		$this->load->library(array('table','form_validation'));
		$this->load->helper('url');
		$this->load->model('Book_model','',TRUE);
	}
		
	function index($offset = 0) {
	
		/* OFFSET */
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		
		/* LOAD DATA */
		$books = $this->Book_model->get_paged_list($this->limit, $offset)->result();
		
		/* GENERATE PAGINATION */
		$this->load->library('pagination');
		$config['base_url'] = site_url('book/index/');
		$config['total_rows'] = $this->Book_model->count_all();
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		/* GENERATE TABLE DATA */
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('ID', 'ISBN', 'TITLE', 'SYNOPSIS', 'AUTHOR ID', 'PUBLISHER CODE', 'COVER', 'BEST SELLER', 'AVAILABILITY', 'PRICE', 'SPECIAL OFFER', 'Actions');
		$i = 0 + $offset;
		foreach ($books as $book) {
			$this->table->add_row(++$i,
			$book->ISBN,
$book->title,
$book->synopsis,
$book->author_id,
$book->publisher_code,
$book->cover,
$book->best_seller,
$book->availability,
$book->price,
$book->special_offer,
				anchor('book/view/'.$book->id,'view',array('class'=>'view')).' '.
				anchor('book/update/'.$book->id,'update',array('class'=>'update')).' '.
				anchor('book/delete/'.$book->id,'delete',array('class'=>'delete','onclick'=>"return confirm('Are you sure want to delete this Book ?')"))
			);
		}
		$data['table'] = $this->table->generate();
		
		/* LOAD VIEW */
		$this->load->view('bookList', $data);
	}
	
	function add() {
	
		/* SET EMPTY DEFAULT FROM FIELD VALUES */
		$this->_set_fields();
		
		/* SET VALIDATION PROPERTIES */
		$this->_set_rules();
	
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Add new Book';
		$data['message'] = '';
		$data['action'] = site_url('book/addBook');
		$data['link_back'] = anchor('book/index/','Back to list of Books',array('class'=>'back'));
	
		/* LOAD VIEW */
		$this->load->view('bookEdit', $data);
	}
	
	function addBook() {
	
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Add new Book';
		$data['action'] = site_url('book/addBook');
		$data['link_back'] = anchor('book/index/','Back to list of Books',array('class'=>'back'));
	
		/* SET EMPTY DEFAULT FROM FIELD VALUES */
		$this->_set_fields();
		
		/* SET VALIDATION PROPERTIES */
		$this->_set_rules();
	
		/* RUN VALIDATION */
		if ($this->form_validation->run() == FALSE) {
			$data['message'] = '';
		}
		else {
		
			/* SAVE DATA */
			$book = array(
			'ISBN' => $this->input->post('ISBN'),
'title' => $this->input->post('title'),
'synopsis' => $this->input->post('synopsis'),
'author_id' => $this->input->post('author_id'),
'publisher_code' => $this->input->post('publisher_code'),
'cover' => $this->input->post('cover'),
'best_seller' => $this->input->post('best_seller'),
'availability' => $this->input->post('availability'),
'price' => $this->input->post('price'),
'special_offer' => $this->input->post('special_offer'),
			);
			$id = $this->Book_model->save($book);
				
			/* SET USER MESSAGE */
			$data['message'] = '<div class="success">add new Book success</div>';
		}
	
		/* LOAD VIEW */
		$this->load->view('bookEdit', $data);
	}
	
	function view($id) {
	
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Book Details';
		$data['link_back'] = anchor('book/index/','Back to list of Books',array('class'=>'back'));
	
		/* GET Book DETAILS */
		$data['book'] = $this->Book_model->get_by_id($id)->row();
	
		/* LOAD VIEW */
		$this->load->view('bookView', $data);
	}
	
	function update($id) {
	
		/* SET VALIDATION PROPERTIES */
		$this->_set_rules();
	
		/* PREFILL FORM VALUES */
		$book = $this->Book_model->get_by_id($id)->row();
		$this->form_data->id = $id;
		$this->form_data->ISBN = $book->ISBN; 
$this->form_data->title = $book->title; 
$this->form_data->synopsis = $book->synopsis; 
$this->form_data->author_id = $book->author_id; 
$this->form_data->publisher_code = $book->publisher_code; 
$this->form_data->cover = $book->cover; 
$this->form_data->best_seller = $book->best_seller; 
$this->form_data->availability = $book->availability; 
$this->form_data->price = $book->price; 
$this->form_data->special_offer = $book->special_offer; 
		
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Update Book';
		$data['message'] = '';
		$data['action'] = site_url('book/updateBook');
		$data['link_back'] = anchor('book/index/','Back to list of Books',array('class'=>'back'));
	
		/* LOAD VIEW */
		$this->load->view('bookEdit', $data);
	}
	
	function updateBook() {
	
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Update Book';
		$data['action'] = site_url('book/updateBook');
		$data['link_back'] = anchor('book/index/','Back to list of Books',array('class'=>'back'));
	
		/* SET EMPTY DEFAULT FROM FIELD VALUES */
		$this->_set_fields();
		
		/* SET VALIDATION PROPERTIES */
		$this->_set_rules();
	
		/* RUN VALIDATION */
		if ($this->form_validation->run() == FALSE) {
			$data['message'] = '';
		}
		else {
		
			/* SAVE DATA */
			$id = $this->input->post('id');
			$book = array(
				'ISBN' => $this->input->post('ISBN'),
'title' => $this->input->post('title'),
'synopsis' => $this->input->post('synopsis'),
'author_id' => $this->input->post('author_id'),
'publisher_code' => $this->input->post('publisher_code'),
'cover' => $this->input->post('cover'),
'best_seller' => $this->input->post('best_seller'),
'availability' => $this->input->post('availability'),
'price' => $this->input->post('price'),
'special_offer' => $this->input->post('special_offer')
			);
			$this->Book_model->update($id, $book);
				
			/* SET USER MESSAGE */
			$data['message'] = '<div class="success">update Book success</div>';
		}
	
		/* LOAD VIEW */
		$this->load->view('bookEdit', $data);
	}
	
	function delete($id) {
	
		/* DELETE Book */
		$this->Book_model->delete($id);
	
		/* REDIRECT TO Book LIST PAGE */
		redirect('book/index/','refresh');
	}
	
	/* SET EMPTY DEFAULT FROM FIELD VALUES */
	function _set_fields() {
		$this->form_data->id = '';
		$this->form_data->ISBN = '';
		$this->form_data->title = '';
		$this->form_data->synopsis = '';
		$this->form_data->author_id = '';
		$this->form_data->publisher_code = '';
		$this->form_data->cover = '';
		$this->form_data->best_seller = '';
		$this->form_data->availability = '';
		$this->form_data->price = '';
		$this->form_data->special_offer = '';
		}
	
	/* VALIDATION RULES */
	function _set_rules() {
		$this->form_validation->set_rules('ISBN', 'ISBN', 'trim|required');
$this->form_validation->set_rules('title', 'TITLE', 'trim|required');
$this->form_validation->set_rules('synopsis', 'SYNOPSIS', 'trim|required');
$this->form_validation->set_rules('author_id', 'AUTHOR ID', 'trim|required');
$this->form_validation->set_rules('publisher_code', 'PUBLISHER CODE', 'trim|required');
$this->form_validation->set_rules('cover', 'COVER', 'trim|required');
$this->form_validation->set_rules('best_seller', 'BEST SELLER', 'trim|required');
$this->form_validation->set_rules('availability', 'AVAILABILITY', 'trim|required');
$this->form_validation->set_rules('price', 'PRICE', 'trim|required');
$this->form_validation->set_rules('special_offer', 'SPECIAL OFFER', 'trim|required');
	
		$this->form_validation->set_message('required', '* required');
		$this->form_validation->set_message('isset', '* required');
		$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
	}
	
}
?>