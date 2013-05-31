<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Shop extends CI_Controller {

	/* NUMBER OF RECORDS PER PAGE */
	private $limit = 10;

	function __construct() {
		parent::__construct();
	
		$this->load->library(array('table','form_validation'));
		$this->load->helper('url');
		$this->load->model('Shop_model','',TRUE);
	}
		
	function index($offset = 0) {
	
		/* OFFSET */
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		
		/* LOAD DATA */
		$shops = $this->Shop_model->get_paged_list($this->limit, $offset)->result();
		
		/* GENERATE PAGINATION */
		$this->load->library('pagination');
		$config['base_url'] = site_url('shop/index/');
		$config['total_rows'] = $this->Shop_model->count_all();
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		/* GENERATE TABLE DATA */
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('CODE', 'NAME', 'EMAIL', 'PHONE', 'EXECUTIVE', 'Actions');
		$i = 0 + $offset;
		foreach ($shops as $shop) {
			$this->table->add_row(++$i,
			$shop->name,
$shop->email,
$shop->phone,
$shop->executive,
				anchor('shop/view/'.$shop->code,'view',array('class'=>'view')).' '.
				anchor('shop/update/'.$shop->code,'update',array('class'=>'update')).' '.
				anchor('shop/delete/'.$shop->code,'delete',array('class'=>'delete','onclick'=>"return confirm('Are you sure want to delete this Shop ?')"))
			);
		}
		$data['table'] = $this->table->generate();
		
		/* LOAD VIEW */
		$this->load->view('shopList', $data);
	}
	
	function add() {
	
		/* SET EMPTY DEFAULT FROM FIELD VALUES */
		$this->_set_fields();
		
		/* SET VALIDATION PROPERTIES */
		$this->_set_rules();
	
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Add new Shop';
		$data['message'] = '';
		$data['action'] = site_url('shop/addShop');
		$data['link_back'] = anchor('shop/index/','Back to list of Shops',array('class'=>'back'));
	
		/* LOAD VIEW */
		$this->load->view('shopEdit', $data);
	}
	
	function addShop() {
	
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Add new Shop';
		$data['action'] = site_url('shop/addShop');
		$data['link_back'] = anchor('shop/index/','Back to list of Shops',array('class'=>'back'));
	
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
			$shop = array(
			'name' => $this->input->post('name'),
'email' => $this->input->post('email'),
'phone' => $this->input->post('phone'),
'executive' => $this->input->post('executive'),
			);
			$code = $this->Shop_model->save($shop);
				
			/* SET USER MESSAGE */
			$data['message'] = '<div class="success">add new Shop success</div>';
		}
	
		/* LOAD VIEW */
		$this->load->view('shopEdit', $data);
	}
	
	function view($code) {
	
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Shop Details';
		$data['link_back'] = anchor('shop/index/','Back to list of Shops',array('class'=>'back'));
	
		/* GET Shop DETAILS */
		$data['shop'] = $this->Shop_model->get_by_code($code)->row();
	
		/* LOAD VIEW */
		$this->load->view('shopView', $data);
	}
	
	function update($code) {
	
		/* SET VALIDATION PROPERTIES */
		$this->_set_rules();
	
		/* PREFILL FORM VALUES */
		$shop = $this->Shop_model->get_by_code($code)->row();
		$this->form_data->code = $code;
		$this->form_data->name = $shop->name; 
$this->form_data->email = $shop->email; 
$this->form_data->phone = $shop->phone; 
$this->form_data->executive = $shop->executive; 
		
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Update Shop';
		$data['message'] = '';
		$data['action'] = site_url('shop/updateShop');
		$data['link_back'] = anchor('shop/index/','Back to list of Shops',array('class'=>'back'));
	
		/* LOAD VIEW */
		$this->load->view('shopEdit', $data);
	}
	
	function updateShop() {
	
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Update Shop';
		$data['action'] = site_url('shop/updateShop');
		$data['link_back'] = anchor('shop/index/','Back to list of Shops',array('class'=>'back'));
	
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
			$shop = array(
				'name' => $this->input->post('name'),
'email' => $this->input->post('email'),
'phone' => $this->input->post('phone'),
'executive' => $this->input->post('executive')
			);
			$this->Shop_model->update($code, $shop);
				
			/* SET USER MESSAGE */
			$data['message'] = '<div class="success">update Shop success</div>';
		}
	
		/* LOAD VIEW */
		$this->load->view('shopEdit', $data);
	}
	
	function delete($code) {
	
		/* DELETE Shop */
		$this->Shop_model->delete($code);
	
		/* REDIRECT TO Shop LIST PAGE */
		redirect('shop/index/','refresh');
	}
	
	/* SET EMPTY DEFAULT FROM FIELD VALUES */
	function _set_fields() {
		$this->form_data->code = '';
		$this->form_data->name = '';
		$this->form_data->email = '';
		$this->form_data->phone = '';
		$this->form_data->executive = '';
		}
	
	/* VALIDATION RULES */
	function _set_rules() {
		$this->form_validation->set_rules('name', 'NAME', 'trim|required');
$this->form_validation->set_rules('email', 'EMAIL', 'trim|required');
$this->form_validation->set_rules('phone', 'PHONE', 'trim|required');
$this->form_validation->set_rules('executive', 'EXECUTIVE', 'trim|required');
	
		$this->form_validation->set_message('required', '* required');
		$this->form_validation->set_message('isset', '* required');
		$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
	}
	
}
?>