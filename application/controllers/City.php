<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class City extends CI_Controller {

	/* NUMBER OF RECORDS PER PAGE */
	private $limit = 10;

	function __construct() {
		parent::__construct();
	
		$this->load->library(array('table','form_validation'));
		$this->load->helper('url');
		$this->load->model('City_model','',TRUE);
	}
		
	function index($offset = 0) {
	
		/* OFFSET */
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		
		/* LOAD DATA */
		$citys = $this->City_model->get_paged_list($this->limit, $offset)->result();
		
		/* GENERATE PAGINATION */
		$this->load->library('pagination');
		$config['base_url'] = site_url('city/index/');
		$config['total_rows'] = $this->City_model->count_all();
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		/* GENERATE TABLE DATA */
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('ZIP CODE', 'OPTIONAL PLUS4', 'NAME', 'COUNTRY CODE', 'Actions');
		$i = 0 + $offset;
		foreach ($citys as $city) {
			$this->table->add_row(++$i,
			$city->optional_plus4,
$city->name,
$city->country_code,
				anchor('city/view/'.$city->zipCode,'view',array('class'=>'view')).' '.
				anchor('city/update/'.$city->zipCode,'update',array('class'=>'update')).' '.
				anchor('city/delete/'.$city->zipCode,'delete',array('class'=>'delete','onclick'=>"return confirm('Are you sure want to delete this City ?')"))
			);
		}
		$data['table'] = $this->table->generate();
		
		/* LOAD VIEW */
		$this->load->view('cityList', $data);
	}
	
	function add() {
	
		/* SET EMPTY DEFAULT FROM FIELD VALUES */
		$this->_set_fields();
		
		/* SET VALIDATION PROPERTIES */
		$this->_set_rules();
	
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Add new City';
		$data['message'] = '';
		$data['action'] = site_url('city/addCity');
		$data['link_back'] = anchor('city/index/','Back to list of Citys',array('class'=>'back'));
	
		/* LOAD VIEW */
		$this->load->view('cityEdit', $data);
	}
	
	function addCity() {
	
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Add new City';
		$data['action'] = site_url('city/addCity');
		$data['link_back'] = anchor('city/index/','Back to list of Citys',array('class'=>'back'));
	
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
			$city = array(
			'optional_plus4' => $this->input->post('optional_plus4'),
'name' => $this->input->post('name'),
'country_code' => $this->input->post('country_code'),
			);
			$zipCode = $this->City_model->save($city);
				
			/* SET USER MESSAGE */
			$data['message'] = '<div class="success">add new City success</div>';
		}
	
		/* LOAD VIEW */
		$this->load->view('cityEdit', $data);
	}
	
	function view($zipCode) {
	
		/* SET COMMON PROPERTIES */
		$data['title'] = 'City Details';
		$data['link_back'] = anchor('city/index/','Back to list of Citys',array('class'=>'back'));
	
		/* GET City DETAILS */
		$data['city'] = $this->City_model->get_by_zipCode($zipCode)->row();
	
		/* LOAD VIEW */
		$this->load->view('cityView', $data);
	}
	
	function update($zipCode) {
	
		/* SET VALIDATION PROPERTIES */
		$this->_set_rules();
	
		/* PREFILL FORM VALUES */
		$city = $this->City_model->get_by_zip_code($zipCode)->row();
		$this->form_data->zip_code = $zip_code;
		$this->form_data->optional_plus4 = $city->optional_plus4; 
$this->form_data->name = $city->name; 
$this->form_data->country_code = $city->country_code; 
		
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Update City';
		$data['message'] = '';
		$data['action'] = site_url('city/updateCity');
		$data['link_back'] = anchor('city/index/','Back to list of Citys',array('class'=>'back'));
	
		/* LOAD VIEW */
		$this->load->view('cityEdit', $data);
	}
	
	function updateCity() {
	
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Update City';
		$data['action'] = site_url('city/updateCity');
		$data['link_back'] = anchor('city/index/','Back to list of Citys',array('class'=>'back'));
	
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
			$zipCode = $this->input->post('zip_code');
			$city = array(
				'optional_plus4' => $this->input->post('optional_plus4'),
'name' => $this->input->post('name'),
'country_code' => $this->input->post('country_code')
			);
			$this->City_model->update($zipCode, $city);
				
			/* SET USER MESSAGE */
			$data['message'] = '<div class="success">update City success</div>';
		}
	
		/* LOAD VIEW */
		$this->load->view('cityEdit', $data);
	}
	
	function delete($zipCode) {
	
		/* DELETE City */
		$this->City_model->delete($zipCode);
	
		/* REDIRECT TO City LIST PAGE */
		redirect('city/index/','refresh');
	}
	
	/* SET EMPTY DEFAULT FROM FIELD VALUES */
	function _set_fields() {
		$this->form_data->zip_code = '';
		$this->form_data->optional_plus4 = '';
		$this->form_data->name = '';
		$this->form_data->country_code = '';
		}
	
	/* VALIDATION RULES */
	function _set_rules() {
		$this->form_validation->set_rules('optional_plus4', 'OPTIONAL PLUS4', 'trim|required');
$this->form_validation->set_rules('name', 'NAME', 'trim|required');
$this->form_validation->set_rules('country_code', 'COUNTRY CODE', 'trim|required');
	
		$this->form_validation->set_message('required', '* required');
		$this->form_validation->set_message('isset', '* required');
		$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
	}
	
}
?>