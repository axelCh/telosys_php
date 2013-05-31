<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer extends CI_Controller {

	/* NUMBER OF RECORDS PER PAGE */
	private $limit = 10;

	function __construct() {
		parent::__construct();
	
		$this->load->library(array('table','form_validation'));
		$this->load->helper('url');
		$this->load->model('Customer_model','',TRUE);
	}
		
	function index($offset = 0) {
	
		/* OFFSET */
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		
		/* LOAD DATA */
		$customers = $this->Customer_model->get_paged_list($this->limit, $offset)->result();
		
		/* GENERATE PAGINATION */
		$this->load->library('pagination');
		$config['base_url'] = site_url('customer/index/');
		$config['total_rows'] = $this->Customer_model->count_all();
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		/* GENERATE TABLE DATA */
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('CODE', 'LAST NAME', 'FIRST NAME', 'AGE', 'EMAIL', 'PHONE', 'LOGIN', 'PASSWORD', 'Actions');
		$i = 0 + $offset;
		foreach ($customers as $customer) {
			$this->table->add_row(++$i,
			$customer->last_name,
$customer->first_name,
$customer->age,
$customer->email,
$customer->phone,
$customer->login,
$customer->password,
				anchor('customer/view/'.$customer->code,'view',array('class'=>'view')).' '.
				anchor('customer/update/'.$customer->code,'update',array('class'=>'update')).' '.
				anchor('customer/delete/'.$customer->code,'delete',array('class'=>'delete','onclick'=>"return confirm('Are you sure want to delete this Customer ?')"))
			);
		}
		$data['table'] = $this->table->generate();
		
		/* LOAD VIEW */
		$this->load->view('customerList', $data);
	}
	
	function add() {
	
		/* SET EMPTY DEFAULT FROM FIELD VALUES */
		$this->_set_fields();
		
		/* SET VALIDATION PROPERTIES */
		$this->_set_rules();
	
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Add new Customer';
		$data['message'] = '';
		$data['action'] = site_url('customer/addCustomer');
		$data['link_back'] = anchor('customer/index/','Back to list of Customers',array('class'=>'back'));
	
		/* LOAD VIEW */
		$this->load->view('customerEdit', $data);
	}
	
	function addCustomer() {
	
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Add new Customer';
		$data['action'] = site_url('customer/addCustomer');
		$data['link_back'] = anchor('customer/index/','Back to list of Customers',array('class'=>'back'));
	
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
			$customer = array(
			'last_name' => $this->input->post('last_name'),
'first_name' => $this->input->post('first_name'),
'age' => $this->input->post('age'),
'email' => $this->input->post('email'),
'phone' => $this->input->post('phone'),
'login' => $this->input->post('login'),
'password' => $this->input->post('password'),
			);
			$code = $this->Customer_model->save($customer);
				
			/* SET USER MESSAGE */
			$data['message'] = '<div class="success">add new Customer success</div>';
		}
	
		/* LOAD VIEW */
		$this->load->view('customerEdit', $data);
	}
	
	function view($code) {
	
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Customer Details';
		$data['link_back'] = anchor('customer/index/','Back to list of Customers',array('class'=>'back'));
	
		/* GET Customer DETAILS */
		$data['customer'] = $this->Customer_model->get_by_code($code)->row();
	
		/* LOAD VIEW */
		$this->load->view('customerView', $data);
	}
	
	function update($code) {
	
		/* SET VALIDATION PROPERTIES */
		$this->_set_rules();
	
		/* PREFILL FORM VALUES */
		$customer = $this->Customer_model->get_by_code($code)->row();
		$this->form_data->code = $code;
		$this->form_data->last_name = $customer->last_name; 
$this->form_data->first_name = $customer->first_name; 
$this->form_data->age = $customer->age; 
$this->form_data->email = $customer->email; 
$this->form_data->phone = $customer->phone; 
$this->form_data->login = $customer->login; 
$this->form_data->password = $customer->password; 
		
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Update Customer';
		$data['message'] = '';
		$data['action'] = site_url('customer/updateCustomer');
		$data['link_back'] = anchor('customer/index/','Back to list of Customers',array('class'=>'back'));
	
		/* LOAD VIEW */
		$this->load->view('customerEdit', $data);
	}
	
	function updateCustomer() {
	
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Update Customer';
		$data['action'] = site_url('customer/updateCustomer');
		$data['link_back'] = anchor('customer/index/','Back to list of Customers',array('class'=>'back'));
	
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
			$customer = array(
				'last_name' => $this->input->post('last_name'),
'first_name' => $this->input->post('first_name'),
'age' => $this->input->post('age'),
'email' => $this->input->post('email'),
'phone' => $this->input->post('phone'),
'login' => $this->input->post('login'),
'password' => $this->input->post('password')
			);
			$this->Customer_model->update($code, $customer);
				
			/* SET USER MESSAGE */
			$data['message'] = '<div class="success">update Customer success</div>';
		}
	
		/* LOAD VIEW */
		$this->load->view('customerEdit', $data);
	}
	
	function delete($code) {
	
		/* DELETE Customer */
		$this->Customer_model->delete($code);
	
		/* REDIRECT TO Customer LIST PAGE */
		redirect('customer/index/','refresh');
	}
	
	/* SET EMPTY DEFAULT FROM FIELD VALUES */
	function _set_fields() {
		$this->form_data->code = '';
		$this->form_data->last_name = '';
		$this->form_data->first_name = '';
		$this->form_data->age = '';
		$this->form_data->email = '';
		$this->form_data->phone = '';
		$this->form_data->login = '';
		$this->form_data->password = '';
		}
	
	/* VALIDATION RULES */
	function _set_rules() {
		$this->form_validation->set_rules('last_name', 'LAST NAME', 'trim|required');
$this->form_validation->set_rules('first_name', 'FIRST NAME', 'trim|required');
$this->form_validation->set_rules('age', 'AGE', 'trim|required');
$this->form_validation->set_rules('email', 'EMAIL', 'trim|required');
$this->form_validation->set_rules('phone', 'PHONE', 'trim|required');
$this->form_validation->set_rules('login', 'LOGIN', 'trim|required');
$this->form_validation->set_rules('password', 'PASSWORD', 'trim|required');
	
		$this->form_validation->set_message('required', '* required');
		$this->form_validation->set_message('isset', '* required');
		$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
	}
	
}
?>