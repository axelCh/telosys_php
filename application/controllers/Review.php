<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Review extends CI_Controller {

	/* NUMBER OF RECORDS PER PAGE */
	private $limit = 10;

	function __construct() {
		parent::__construct();
	
		$this->load->library(array('table','form_validation'));
		$this->load->helper('url');
		$this->load->model('Review_model','',TRUE);
	}
		
	function index($offset = 0) {
	
		/* OFFSET */
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		
		/* LOAD DATA */
		$reviews = $this->Review_model->get_paged_list($this->limit, $offset)->result();
		
		/* GENERATE PAGINATION */
		$this->load->library('pagination');
		$config['base_url'] = site_url('review/index/');
		$config['total_rows'] = $this->Review_model->count_all();
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		/* GENERATE TABLE DATA */
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('CUSTOMER CODE', 'BOOK ID', 'BODY', 'NOTE', 'CREATION DATE', 'LAST UPDATE', 'Actions');
		$i = 0 + $offset;
		foreach ($reviews as $review) {
			$this->table->add_row(++$i,
			$review->book_id,
$review->body,
$review->note,
$review->creation_date,
$review->last_update,
				anchor('review/view/'.$review->customerCode,'view',array('class'=>'view')).' '.
				anchor('review/update/'.$review->customerCode,'update',array('class'=>'update')).' '.
				anchor('review/delete/'.$review->customerCode,'delete',array('class'=>'delete','onclick'=>"return confirm('Are you sure want to delete this Review ?')"))
			);
		}
		$data['table'] = $this->table->generate();
		
		/* LOAD VIEW */
		$this->load->view('reviewList', $data);
	}
	
	function add() {
	
		/* SET EMPTY DEFAULT FROM FIELD VALUES */
		$this->_set_fields();
		
		/* SET VALIDATION PROPERTIES */
		$this->_set_rules();
	
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Add new Review';
		$data['message'] = '';
		$data['action'] = site_url('review/addReview');
		$data['link_back'] = anchor('review/index/','Back to list of Reviews',array('class'=>'back'));
	
		/* LOAD VIEW */
		$this->load->view('reviewEdit', $data);
	}
	
	function addReview() {
	
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Add new Review';
		$data['action'] = site_url('review/addReview');
		$data['link_back'] = anchor('review/index/','Back to list of Reviews',array('class'=>'back'));
	
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
			$review = array(
			'book_id' => $this->input->post('book_id'),
'body' => $this->input->post('body'),
'note' => $this->input->post('note'),
'creation_date' => $this->input->post('creation_date'),
'last_update' => $this->input->post('last_update'),
			);
			$customerCode = $this->Review_model->save($review);
				
			/* SET USER MESSAGE */
			$data['message'] = '<div class="success">add new Review success</div>';
		}
	
		/* LOAD VIEW */
		$this->load->view('reviewEdit', $data);
	}
	
	function view($customerCode) {
	
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Review Details';
		$data['link_back'] = anchor('review/index/','Back to list of Reviews',array('class'=>'back'));
	
		/* GET Review DETAILS */
		$data['review'] = $this->Review_model->get_by_customerCode($customerCode)->row();
	
		/* LOAD VIEW */
		$this->load->view('reviewView', $data);
	}
	
	function update($customerCode) {
	
		/* SET VALIDATION PROPERTIES */
		$this->_set_rules();
	
		/* PREFILL FORM VALUES */
		$review = $this->Review_model->get_by_customer_code($customerCode)->row();
		$this->form_data->customer_code = $customer_code;
		$this->form_data->book_id = $review->book_id; 
$this->form_data->body = $review->body; 
$this->form_data->note = $review->note; 
$this->form_data->creation_date = $review->creation_date; 
$this->form_data->last_update = $review->last_update; 
		
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Update Review';
		$data['message'] = '';
		$data['action'] = site_url('review/updateReview');
		$data['link_back'] = anchor('review/index/','Back to list of Reviews',array('class'=>'back'));
	
		/* LOAD VIEW */
		$this->load->view('reviewEdit', $data);
	}
	
	function updateReview() {
	
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Update Review';
		$data['action'] = site_url('review/updateReview');
		$data['link_back'] = anchor('review/index/','Back to list of Reviews',array('class'=>'back'));
	
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
			$customerCode = $this->input->post('customer_code');
			$review = array(
				'book_id' => $this->input->post('book_id'),
'body' => $this->input->post('body'),
'note' => $this->input->post('note'),
'creation_date' => $this->input->post('creation_date'),
'last_update' => $this->input->post('last_update')
			);
			$this->Review_model->update($customerCode, $review);
				
			/* SET USER MESSAGE */
			$data['message'] = '<div class="success">update Review success</div>';
		}
	
		/* LOAD VIEW */
		$this->load->view('reviewEdit', $data);
	}
	
	function delete($customerCode) {
	
		/* DELETE Review */
		$this->Review_model->delete($customerCode);
	
		/* REDIRECT TO Review LIST PAGE */
		redirect('review/index/','refresh');
	}
	
	/* SET EMPTY DEFAULT FROM FIELD VALUES */
	function _set_fields() {
		$this->form_data->customer_code = '';
		$this->form_data->book_id = '';
		$this->form_data->body = '';
		$this->form_data->note = '';
		$this->form_data->creation_date = '';
		$this->form_data->last_update = '';
		}
	
	/* VALIDATION RULES */
	function _set_rules() {
		$this->form_validation->set_rules('book_id', 'BOOK ID', 'trim|required');
$this->form_validation->set_rules('body', 'BODY', 'trim|required');
$this->form_validation->set_rules('note', 'NOTE', 'trim|required');
$this->form_validation->set_rules('creation_date', 'CREATION DATE', 'trim|required');
$this->form_validation->set_rules('last_update', 'LAST UPDATE', 'trim|required');
	
		$this->form_validation->set_message('required', '* required');
		$this->form_validation->set_message('isset', '* required');
		$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
	}
	
}
?>