<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PublisherAddressList extends CI_Controller {

	/* NUMBER OF RECORDS PER PAGE */
	private $limit = 10;

	function __construct() {
		parent::__construct();
	
		$this->load->library(array('table','form_validation'));
		$this->load->helper('url');
		$this->load->model('PublisherAddressList_model','',TRUE);
	}
		
	function index($offset = 0) {
	
		/* OFFSET */
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		
		/* LOAD DATA */
		$publisher_address_lists = $this->PublisherAddressList_model->get_paged_list($this->limit, $offset)->result();
		
		/* GENERATE PAGINATION */
		$this->load->library('pagination');
		$config['base_url'] = site_url('publisher_address_list/index/');
		$config['total_rows'] = $this->PublisherAddressList_model->count_all();
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		/* GENERATE TABLE DATA */
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('PUBLISHER CODE', 'ADDRESS CODE', 'Actions');
		$i = 0 + $offset;
		foreach ($publisher_address_lists as $publisher_address_list) {
			$this->table->add_row(++$i,
			$publisher_address_list->address_code,
				anchor('publisher_address_list/view/'.$publisher_address_list->publisherCode,'view',array('class'=>'view')).' '.
				anchor('publisher_address_list/update/'.$publisher_address_list->publisherCode,'update',array('class'=>'update')).' '.
				anchor('publisher_address_list/delete/'.$publisher_address_list->publisherCode,'delete',array('class'=>'delete','onclick'=>"return confirm('Are you sure want to delete this PublisherAddressList ?')"))
			);
		}
		$data['table'] = $this->table->generate();
		
		/* LOAD VIEW */
		$this->load->view('publisher_address_listList', $data);
	}
	
	function add() {
	
		/* SET EMPTY DEFAULT FROM FIELD VALUES */
		$this->_set_fields();
		
		/* SET VALIDATION PROPERTIES */
		$this->_set_rules();
	
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Add new PublisherAddressList';
		$data['message'] = '';
		$data['action'] = site_url('publisher_address_list/addPublisherAddressList');
		$data['link_back'] = anchor('publisher_address_list/index/','Back to list of PublisherAddressLists',array('class'=>'back'));
	
		/* LOAD VIEW */
		$this->load->view('publisher_address_listEdit', $data);
	}
	
	function addPublisherAddressList() {
	
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Add new PublisherAddressList';
		$data['action'] = site_url('publisher_address_list/addPublisherAddressList');
		$data['link_back'] = anchor('publisher_address_list/index/','Back to list of PublisherAddressLists',array('class'=>'back'));
	
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
			$publisher_address_list = array(
			'address_code' => $this->input->post('address_code'),
			);
			$publisherCode = $this->PublisherAddressList_model->save($publisher_address_list);
				
			/* SET USER MESSAGE */
			$data['message'] = '<div class="success">add new PublisherAddressList success</div>';
		}
	
		/* LOAD VIEW */
		$this->load->view('publisher_address_listEdit', $data);
	}
	
	function view($publisherCode) {
	
		/* SET COMMON PROPERTIES */
		$data['title'] = 'PublisherAddressList Details';
		$data['link_back'] = anchor('publisher_address_list/index/','Back to list of PublisherAddressLists',array('class'=>'back'));
	
		/* GET PublisherAddressList DETAILS */
		$data['publisher_address_list'] = $this->PublisherAddressList_model->get_by_publisherCode($publisherCode)->row();
	
		/* LOAD VIEW */
		$this->load->view('publisher_address_listView', $data);
	}
	
	function update($publisherCode) {
	
		/* SET VALIDATION PROPERTIES */
		$this->_set_rules();
	
		/* PREFILL FORM VALUES */
		$publisher_address_list = $this->PublisherAddressList_model->get_by_publisher_code($publisherCode)->row();
		$this->form_data->publisher_code = $publisher_code;
		$this->form_data->address_code = $publisher_address_list->address_code; 
		
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Update PublisherAddressList';
		$data['message'] = '';
		$data['action'] = site_url('publisher_address_list/updatePublisherAddressList');
		$data['link_back'] = anchor('publisher_address_list/index/','Back to list of PublisherAddressLists',array('class'=>'back'));
	
		/* LOAD VIEW */
		$this->load->view('publisher_address_listEdit', $data);
	}
	
	function updatePublisherAddressList() {
	
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Update PublisherAddressList';
		$data['action'] = site_url('publisher_address_list/updatePublisherAddressList');
		$data['link_back'] = anchor('publisher_address_list/index/','Back to list of PublisherAddressLists',array('class'=>'back'));
	
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
			$publisherCode = $this->input->post('publisher_code');
			$publisher_address_list = array(
				'address_code' => $this->input->post('address_code')
			);
			$this->PublisherAddressList_model->update($publisherCode, $publisher_address_list);
				
			/* SET USER MESSAGE */
			$data['message'] = '<div class="success">update PublisherAddressList success</div>';
		}
	
		/* LOAD VIEW */
		$this->load->view('publisher_address_listEdit', $data);
	}
	
	function delete($publisherCode) {
	
		/* DELETE PublisherAddressList */
		$this->PublisherAddressList_model->delete($publisherCode);
	
		/* REDIRECT TO PublisherAddressList LIST PAGE */
		redirect('publisher_address_list/index/','refresh');
	}
	
	/* SET EMPTY DEFAULT FROM FIELD VALUES */
	function _set_fields() {
		$this->form_data->publisher_code = '';
		$this->form_data->address_code = '';
		}
	
	/* VALIDATION RULES */
	function _set_rules() {
		$this->form_validation->set_rules('address_code', 'ADDRESS CODE', 'trim|required');
	
		$this->form_validation->set_message('required', '* required');
		$this->form_validation->set_message('isset', '* required');
		$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
	}
	
}
?>