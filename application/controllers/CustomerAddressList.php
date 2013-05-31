<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CustomerAddressList extends CI_Controller {

	/* NUMBER OF RECORDS PER PAGE */
	private $limit = 10;

	function __construct() {
		parent::__construct();
	
		$this->load->library(array('table','form_validation'));
		$this->load->helper('url');
		$this->load->model('CustomerAddressList_model','',TRUE);
	}
		
	function index($offset = 0) {
	
		/* OFFSET */
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		
		/* LOAD DATA */
		$customer_address_lists = $this->CustomerAddressList_model->get_paged_list($this->limit, $offset)->result();
		
		/* GENERATE PAGINATION */
		$this->load->library('pagination');
		$config['base_url'] = site_url('customer_address_list/index/');
		$config['total_rows'] = $this->CustomerAddressList_model->count_all();
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		/* GENERATE TABLE DATA */
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('CUSTOMER CODE', 'ADDRESS CODE', 'Actions');
		$i = 0 + $offset;
		foreach ($customer_address_lists as $customer_address_list) {
			$this->table->add_row(++$i,
			$customer_address_list->address_code,
				anchor('customer_address_list/view/'.$customer_address_list->customerCode,'view',array('class'=>'view')).' '.
				anchor('customer_address_list/update/'.$customer_address_list->customerCode,'update',array('class'=>'update')).' '.
				anchor('customer_address_list/delete/'.$customer_address_list->customerCode,'delete',array('class'=>'delete','onclick'=>"return confirm('Are you sure want to delete this CustomerAddressList ?')"))
			);
		}
		$data['table'] = $this->table->generate();
		
		/* LOAD VIEW */
		$this->load->view('customer_address_listList', $data);
	}
	
	function add() {
	
		/* SET EMPTY DEFAULT FROM FIELD VALUES */
		$this->_set_fields();
		
		/* SET VALIDATION PROPERTIES */
		$this->_set_rules();
	
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Add new CustomerAddressList';
		$data['message'] = '';
		$data['action'] = site_url('customer_address_list/addCustomerAddressList');
		$data['link_back'] = anchor('customer_address_list/index/','Back to list of CustomerAddressLists',array('class'=>'back'));
	
		/* LOAD VIEW */
		$this->load->view('customer_address_listEdit', $data);
	}
	
	function addCustomerAddressList() {
	
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Add new CustomerAddressList';
		$data['action'] = site_url('customer_address_list/addCustomerAddressList');
		$data['link_back'] = anchor('customer_address_list/index/','Back to list of CustomerAddressLists',array('class'=>'back'));
	
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
			$customer_address_list = array(
			'address_code' => $this->input->post('address_code'),
			);
			$customerCode = $this->CustomerAddressList_model->save($customer_address_list);
				
			/* SET USER MESSAGE */
			$data['message'] = '<div class="success">add new CustomerAddressList success</div>';
		}
	
		/* LOAD VIEW */
		$this->load->view('customer_address_listEdit', $data);
	}
	
	function view($customerCode) {
	
		/* SET COMMON PROPERTIES */
		$data['title'] = 'CustomerAddressList Details';
		$data['link_back'] = anchor('customer_address_list/index/','Back to list of CustomerAddressLists',array('class'=>'back'));
	
		/* GET CustomerAddressList DETAILS */
		$data['customer_address_list'] = $this->CustomerAddressList_model->get_by_customerCode($customerCode)->row();
	
		/* LOAD VIEW */
		$this->load->view('customer_address_listView', $data);
	}
	
	function update($customerCode) {
	
		/* SET VALIDATION PROPERTIES */
		$this->_set_rules();
	
		/* PREFILL FORM VALUES */
		$customer_address_list = $this->CustomerAddressList_model->get_by_customer_code($customerCode)->row();
		$this->form_data->customer_code = $customer_code;
		$this->form_data->address_code = $customer_address_list->address_code; 
		
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Update CustomerAddressList';
		$data['message'] = '';
		$data['action'] = site_url('customer_address_list/updateCustomerAddressList');
		$data['link_back'] = anchor('customer_address_list/index/','Back to list of CustomerAddressLists',array('class'=>'back'));
	
		/* LOAD VIEW */
		$this->load->view('customer_address_listEdit', $data);
	}
	
	function updateCustomerAddressList() {
	
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Update CustomerAddressList';
		$data['action'] = site_url('customer_address_list/updateCustomerAddressList');
		$data['link_back'] = anchor('customer_address_list/index/','Back to list of CustomerAddressLists',array('class'=>'back'));
	
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
			$customer_address_list = array(
				'address_code' => $this->input->post('address_code')
			);
			$this->CustomerAddressList_model->update($customerCode, $customer_address_list);
				
			/* SET USER MESSAGE */
			$data['message'] = '<div class="success">update CustomerAddressList success</div>';
		}
	
		/* LOAD VIEW */
		$this->load->view('customer_address_listEdit', $data);
	}
	
	function delete($customerCode) {
	
		/* DELETE CustomerAddressList */
		$this->CustomerAddressList_model->delete($customerCode);
	
		/* REDIRECT TO CustomerAddressList LIST PAGE */
		redirect('customer_address_list/index/','refresh');
	}
	
	/* SET EMPTY DEFAULT FROM FIELD VALUES */
	function _set_fields() {
		$this->form_data->customer_code = '';
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