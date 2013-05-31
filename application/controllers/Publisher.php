<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Publisher extends CI_Controller {

	/* NUMBER OF RECORDS PER PAGE */
	private $limit = 10;

	function __construct() {
		parent::__construct();
	
		$this->load->library(array('table','form_validation'));
		$this->load->helper('url');
		$this->load->model('Publisher_model','',TRUE);
	}
		
	function index($offset = 0) {
	
		/* OFFSET */
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		
		/* LOAD DATA */
		$publishers = $this->Publisher_model->get_paged_list($this->limit, $offset)->result();
		
		/* GENERATE PAGINATION */
		$this->load->library('pagination');
		$config['base_url'] = site_url('publisher/index/');
		$config['total_rows'] = $this->Publisher_model->count_all();
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		/* GENERATE TABLE DATA */
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('CODE', 'NAME', 'EMAIL', 'PHONE', 'CONTACT', 'Actions');
		$i = 0 + $offset;
		foreach ($publishers as $publisher) {
			$this->table->add_row(++$i,
			$publisher->name,
$publisher->email,
$publisher->phone,
$publisher->contact,
				anchor('publisher/view/'.$publisher->code,'view',array('class'=>'view')).' '.
				anchor('publisher/update/'.$publisher->code,'update',array('class'=>'update')).' '.
				anchor('publisher/delete/'.$publisher->code,'delete',array('class'=>'delete','onclick'=>"return confirm('Are you sure want to delete this Publisher ?')"))
			);
		}
		$data['table'] = $this->table->generate();
		
		/* LOAD VIEW */
		$this->load->view('publisherList', $data);
	}
	
	function add() {
	
		/* SET EMPTY DEFAULT FROM FIELD VALUES */
		$this->_set_fields();
		
		/* SET VALIDATION PROPERTIES */
		$this->_set_rules();
	
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Add new Publisher';
		$data['message'] = '';
		$data['action'] = site_url('publisher/addPublisher');
		$data['link_back'] = anchor('publisher/index/','Back to list of Publishers',array('class'=>'back'));
	
		/* LOAD VIEW */
		$this->load->view('publisherEdit', $data);
	}
	
	function addPublisher() {
	
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Add new Publisher';
		$data['action'] = site_url('publisher/addPublisher');
		$data['link_back'] = anchor('publisher/index/','Back to list of Publishers',array('class'=>'back'));
	
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
			$publisher = array(
			'name' => $this->input->post('name'),
'email' => $this->input->post('email'),
'phone' => $this->input->post('phone'),
'contact' => $this->input->post('contact'),
			);
			$code = $this->Publisher_model->save($publisher);
				
			/* SET USER MESSAGE */
			$data['message'] = '<div class="success">add new Publisher success</div>';
		}
	
		/* LOAD VIEW */
		$this->load->view('publisherEdit', $data);
	}
	
	function view($code) {
	
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Publisher Details';
		$data['link_back'] = anchor('publisher/index/','Back to list of Publishers',array('class'=>'back'));
	
		/* GET Publisher DETAILS */
		$data['publisher'] = $this->Publisher_model->get_by_code($code)->row();
	
		/* LOAD VIEW */
		$this->load->view('publisherView', $data);
	}
	
	function update($code) {
	
		/* SET VALIDATION PROPERTIES */
		$this->_set_rules();
	
		/* PREFILL FORM VALUES */
		$publisher = $this->Publisher_model->get_by_code($code)->row();
		$this->form_data->code = $code;
		$this->form_data->name = $publisher->name; 
$this->form_data->email = $publisher->email; 
$this->form_data->phone = $publisher->phone; 
$this->form_data->contact = $publisher->contact; 
		
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Update Publisher';
		$data['message'] = '';
		$data['action'] = site_url('publisher/updatePublisher');
		$data['link_back'] = anchor('publisher/index/','Back to list of Publishers',array('class'=>'back'));
	
		/* LOAD VIEW */
		$this->load->view('publisherEdit', $data);
	}
	
	function updatePublisher() {
	
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Update Publisher';
		$data['action'] = site_url('publisher/updatePublisher');
		$data['link_back'] = anchor('publisher/index/','Back to list of Publishers',array('class'=>'back'));
	
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
			$code = $this->input->post('code');
			$publisher = array(
				'name' => $this->input->post('name'),
'email' => $this->input->post('email'),
'phone' => $this->input->post('phone'),
'contact' => $this->input->post('contact')
			);
			$this->Publisher_model->update($code, $publisher);
				
			/* SET USER MESSAGE */
			$data['message'] = '<div class="success">update Publisher success</div>';
		}
	
		/* LOAD VIEW */
		$this->load->view('publisherEdit', $data);
	}
	
	function delete($code) {
	
		/* DELETE Publisher */
		$this->Publisher_model->delete($code);
	
		/* REDIRECT TO Publisher LIST PAGE */
		redirect('publisher/index/','refresh');
	}
	
	/* SET EMPTY DEFAULT FROM FIELD VALUES */
	function _set_fields() {
		$this->form_data->code = '';
		$this->form_data->name = '';
		$this->form_data->email = '';
		$this->form_data->phone = '';
		$this->form_data->contact = '';
		}
	
	/* VALIDATION RULES */
	function _set_rules() {
		$this->form_validation->set_rules('name', 'NAME', 'trim|required');
$this->form_validation->set_rules('email', 'EMAIL', 'trim|required');
$this->form_validation->set_rules('phone', 'PHONE', 'trim|required');
$this->form_validation->set_rules('contact', 'CONTACT', 'trim|required');
	
		$this->form_validation->set_message('required', '* required');
		$this->form_validation->set_message('isset', '* required');
		$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
	}
	
}
?>