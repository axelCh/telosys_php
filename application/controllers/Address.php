<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Address extends CI_Controller {

	/* NUMBER OF RECORDS PER PAGE */
	private $limit = 10;

	function __construct() {
		parent::__construct();
	
		$this->load->library(array('table','form_validation'));
		$this->load->helper('url');
		$this->load->model('Address_model','',TRUE);
	}
		
	function index($offset = 0) {
	
		/* OFFSET */
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		
		/* LOAD DATA */
		$addresss = $this->Address_model->get_paged_list($this->limit, $offset)->result();
		
		/* GENERATE PAGINATION */
		$this->load->library('pagination');
		$config['base_url'] = site_url('address/index/');
		$config['total_rows'] = $this->Address_model->count_all();
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		/* GENERATE TABLE DATA */
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('CODE', 'ADDRESS LIGNE1', 'ADDRESS LIGNE2', 'CITY ZIP CODE', 'COUNTRY CODE', 'Actions');
		$i = 0 + $offset;
		foreach ($addresss as $address) {
			$this->table->add_row(++$i,
			$address->address_ligne1,
$address->address_ligne2,
$address->city_zip_code,
$address->country_code,
				anchor('address/view/'.$address->code,'view',array('class'=>'view')).' '.
				anchor('address/update/'.$address->code,'update',array('class'=>'update')).' '.
				anchor('address/delete/'.$address->code,'delete',array('class'=>'delete','onclick'=>"return confirm('Are you sure want to delete this Address ?')"))
			);
		}
		$data['table'] = $this->table->generate();
		
		/* LOAD VIEW */
		$this->load->view('addressList', $data);
	}
	
	function add() {
	
		/* SET EMPTY DEFAULT FROM FIELD VALUES */
		$this->_set_fields();
		
		/* SET VALIDATION PROPERTIES */
		$this->_set_rules();
	
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Add new Address';
		$data['message'] = '';
		$data['action'] = site_url('address/addAddress');
		$data['link_back'] = anchor('address/index/','Back to list of Addresss',array('class'=>'back'));
	
		/* LOAD VIEW */
		$this->load->view('addressEdit', $data);
	}
	
	function addAddress() {
	
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Add new Address';
		$data['action'] = site_url('address/addAddress');
		$data['link_back'] = anchor('address/index/','Back to list of Addresss',array('class'=>'back'));
	
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
			$address = array(
			'address_ligne1' => $this->input->post('address_ligne1'),
'address_ligne2' => $this->input->post('address_ligne2'),
'city_zip_code' => $this->input->post('city_zip_code'),
'country_code' => $this->input->post('country_code'),
			);
			$code = $this->Address_model->save($address);
				
			/* SET USER MESSAGE */
			$data['message'] = '<div class="success">add new Address success</div>';
		}
	
		/* LOAD VIEW */
		$this->load->view('addressEdit', $data);
	}
	
	function view($code) {
	
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Address Details';
		$data['link_back'] = anchor('address/index/','Back to list of Addresss',array('class'=>'back'));
	
		/* GET Address DETAILS */
		$data['address'] = $this->Address_model->get_by_code($code)->row();
	
		/* LOAD VIEW */
		$this->load->view('addressView', $data);
	}
	
	function update($code) {
	
		/* SET VALIDATION PROPERTIES */
		$this->_set_rules();
	
		/* PREFILL FORM VALUES */
		$address = $this->Address_model->get_by_code($code)->row();
		$this->form_data->code = $code;
		$this->form_data->address_ligne1 = $address->address_ligne1; 
$this->form_data->address_ligne2 = $address->address_ligne2; 
$this->form_data->city_zip_code = $address->city_zip_code; 
$this->form_data->country_code = $address->country_code; 
		
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Update Address';
		$data['message'] = '';
		$data['action'] = site_url('address/updateAddress');
		$data['link_back'] = anchor('address/index/','Back to list of Addresss',array('class'=>'back'));
	
		/* LOAD VIEW */
		$this->load->view('addressEdit', $data);
	}
	
	function updateAddress() {
	
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Update Address';
		$data['action'] = site_url('address/updateAddress');
		$data['link_back'] = anchor('address/index/','Back to list of Addresss',array('class'=>'back'));
	
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
			$address = array(
				'address_ligne1' => $this->input->post('address_ligne1'),
'address_ligne2' => $this->input->post('address_ligne2'),
'city_zip_code' => $this->input->post('city_zip_code'),
'country_code' => $this->input->post('country_code')
			);
			$this->Address_model->update($code, $address);
				
			/* SET USER MESSAGE */
			$data['message'] = '<div class="success">update Address success</div>';
		}
	
		/* LOAD VIEW */
		$this->load->view('addressEdit', $data);
	}
	
	function delete($code) {
	
		/* DELETE Address */
		$this->Address_model->delete($code);
	
		/* REDIRECT TO Address LIST PAGE */
		redirect('address/index/','refresh');
	}
	
	/* SET EMPTY DEFAULT FROM FIELD VALUES */
	function _set_fields() {
		$this->form_data->code = '';
		$this->form_data->address_ligne1 = '';
		$this->form_data->address_ligne2 = '';
		$this->form_data->city_zip_code = '';
		$this->form_data->country_code = '';
		}
	
	/* VALIDATION RULES */
	function _set_rules() {
		$this->form_validation->set_rules('address_ligne1', 'ADDRESS LIGNE1', 'trim|required');
$this->form_validation->set_rules('address_ligne2', 'ADDRESS LIGNE2', 'trim|required');
$this->form_validation->set_rules('city_zip_code', 'CITY ZIP CODE', 'trim|required');
$this->form_validation->set_rules('country_code', 'COUNTRY CODE', 'trim|required');
	
		$this->form_validation->set_message('required', '* required');
		$this->form_validation->set_message('isset', '* required');
		$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
	}
	
}
?>