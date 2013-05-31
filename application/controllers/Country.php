<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Country extends CI_Controller {

	/* NUMBER OF RECORDS PER PAGE */
	private $limit = 10;

	function __construct() {
		parent::__construct();
	
		$this->load->library(array('table','form_validation'));
		$this->load->helper('url');
		$this->load->model('Country_model','',TRUE);
	}
		
	function index($offset = 0) {
	
		/* OFFSET */
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		
		/* LOAD DATA */
		$countrys = $this->Country_model->get_paged_list($this->limit, $offset)->result();
		
		/* GENERATE PAGINATION */
		$this->load->library('pagination');
		$config['base_url'] = site_url('country/index/');
		$config['total_rows'] = $this->Country_model->count_all();
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		/* GENERATE TABLE DATA */
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('CODE', 'NAME', 'Actions');
		$i = 0 + $offset;
		foreach ($countrys as $country) {
			$this->table->add_row(++$i,
			$country->name,
				anchor('country/view/'.$country->code,'view',array('class'=>'view')).' '.
				anchor('country/update/'.$country->code,'update',array('class'=>'update')).' '.
				anchor('country/delete/'.$country->code,'delete',array('class'=>'delete','onclick'=>"return confirm('Are you sure want to delete this Country ?')"))
			);
		}
		$data['table'] = $this->table->generate();
		
		/* LOAD VIEW */
		$this->load->view('countryList', $data);
	}
	
	function add() {
	
		/* SET EMPTY DEFAULT FROM FIELD VALUES */
		$this->_set_fields();
		
		/* SET VALIDATION PROPERTIES */
		$this->_set_rules();
	
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Add new Country';
		$data['message'] = '';
		$data['action'] = site_url('country/addCountry');
		$data['link_back'] = anchor('country/index/','Back to list of Countrys',array('class'=>'back'));
	
		/* LOAD VIEW */
		$this->load->view('countryEdit', $data);
	}
	
	function addCountry() {
	
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Add new Country';
		$data['action'] = site_url('country/addCountry');
		$data['link_back'] = anchor('country/index/','Back to list of Countrys',array('class'=>'back'));
	
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
			$country = array(
			'name' => $this->input->post('name'),
			);
			$code = $this->Country_model->save($country);
				
			/* SET USER MESSAGE */
			$data['message'] = '<div class="success">add new Country success</div>';
		}
	
		/* LOAD VIEW */
		$this->load->view('countryEdit', $data);
	}
	
	function view($code) {
	
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Country Details';
		$data['link_back'] = anchor('country/index/','Back to list of Countrys',array('class'=>'back'));
	
		/* GET Country DETAILS */
		$data['country'] = $this->Country_model->get_by_code($code)->row();
	
		/* LOAD VIEW */
		$this->load->view('countryView', $data);
	}
	
	function update($code) {
	
		/* SET VALIDATION PROPERTIES */
		$this->_set_rules();
	
		/* PREFILL FORM VALUES */
		$country = $this->Country_model->get_by_code($code)->row();
		$this->form_data->code = $code;
		$this->form_data->name = $country->name; 
		
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Update Country';
		$data['message'] = '';
		$data['action'] = site_url('country/updateCountry');
		$data['link_back'] = anchor('country/index/','Back to list of Countrys',array('class'=>'back'));
	
		/* LOAD VIEW */
		$this->load->view('countryEdit', $data);
	}
	
	function updateCountry() {
	
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Update Country';
		$data['action'] = site_url('country/updateCountry');
		$data['link_back'] = anchor('country/index/','Back to list of Countrys',array('class'=>'back'));
	
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
			$country = array(
				'name' => $this->input->post('name')
			);
			$this->Country_model->update($code, $country);
				
			/* SET USER MESSAGE */
			$data['message'] = '<div class="success">update Country success</div>';
		}
	
		/* LOAD VIEW */
		$this->load->view('countryEdit', $data);
	}
	
	function delete($code) {
	
		/* DELETE Country */
		$this->Country_model->delete($code);
	
		/* REDIRECT TO Country LIST PAGE */
		redirect('country/index/','refresh');
	}
	
	/* SET EMPTY DEFAULT FROM FIELD VALUES */
	function _set_fields() {
		$this->form_data->code = '';
		$this->form_data->name = '';
		}
	
	/* VALIDATION RULES */
	function _set_rules() {
		$this->form_validation->set_rules('name', 'NAME', 'trim|required');
	
		$this->form_validation->set_message('required', '* required');
		$this->form_validation->set_message('isset', '* required');
		$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
	}
	
}
?>