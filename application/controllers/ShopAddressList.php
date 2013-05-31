<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ShopAddressList extends CI_Controller {

	/* NUMBER OF RECORDS PER PAGE */
	private $limit = 10;

	function __construct() {
		parent::__construct();
	
		$this->load->library(array('table','form_validation'));
		$this->load->helper('url');
		$this->load->model('ShopAddressList_model','',TRUE);
	}
		
	function index($offset = 0) {
	
		/* OFFSET */
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		
		/* LOAD DATA */
		$shop_address_lists = $this->ShopAddressList_model->get_paged_list($this->limit, $offset)->result();
		
		/* GENERATE PAGINATION */
		$this->load->library('pagination');
		$config['base_url'] = site_url('shop_address_list/index/');
		$config['total_rows'] = $this->ShopAddressList_model->count_all();
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		/* GENERATE TABLE DATA */
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('SHOP CODE', 'ADDRESS CODE', 'Actions');
		$i = 0 + $offset;
		foreach ($shop_address_lists as $shop_address_list) {
			$this->table->add_row(++$i,
			$shop_address_list->address_code,
				anchor('shop_address_list/view/'.$shop_address_list->shopCode,'view',array('class'=>'view')).' '.
				anchor('shop_address_list/update/'.$shop_address_list->shopCode,'update',array('class'=>'update')).' '.
				anchor('shop_address_list/delete/'.$shop_address_list->shopCode,'delete',array('class'=>'delete','onclick'=>"return confirm('Are you sure want to delete this ShopAddressList ?')"))
			);
		}
		$data['table'] = $this->table->generate();
		
		/* LOAD VIEW */
		$this->load->view('shop_address_listList', $data);
	}
	
	function add() {
	
		/* SET EMPTY DEFAULT FROM FIELD VALUES */
		$this->_set_fields();
		
		/* SET VALIDATION PROPERTIES */
		$this->_set_rules();
	
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Add new ShopAddressList';
		$data['message'] = '';
		$data['action'] = site_url('shop_address_list/addShopAddressList');
		$data['link_back'] = anchor('shop_address_list/index/','Back to list of ShopAddressLists',array('class'=>'back'));
	
		/* LOAD VIEW */
		$this->load->view('shop_address_listEdit', $data);
	}
	
	function addShopAddressList() {
	
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Add new ShopAddressList';
		$data['action'] = site_url('shop_address_list/addShopAddressList');
		$data['link_back'] = anchor('shop_address_list/index/','Back to list of ShopAddressLists',array('class'=>'back'));
	
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
			$shop_address_list = array(
			'address_code' => $this->input->post('address_code'),
			);
			$shopCode = $this->ShopAddressList_model->save($shop_address_list);
				
			/* SET USER MESSAGE */
			$data['message'] = '<div class="success">add new ShopAddressList success</div>';
		}
	
		/* LOAD VIEW */
		$this->load->view('shop_address_listEdit', $data);
	}
	
	function view($shopCode) {
	
		/* SET COMMON PROPERTIES */
		$data['title'] = 'ShopAddressList Details';
		$data['link_back'] = anchor('shop_address_list/index/','Back to list of ShopAddressLists',array('class'=>'back'));
	
		/* GET ShopAddressList DETAILS */
		$data['shop_address_list'] = $this->ShopAddressList_model->get_by_shopCode($shopCode)->row();
	
		/* LOAD VIEW */
		$this->load->view('shop_address_listView', $data);
	}
	
	function update($shopCode) {
	
		/* SET VALIDATION PROPERTIES */
		$this->_set_rules();
	
		/* PREFILL FORM VALUES */
		$shop_address_list = $this->ShopAddressList_model->get_by_shop_code($shopCode)->row();
		$this->form_data->shop_code = $shop_code;
		$this->form_data->address_code = $shop_address_list->address_code; 
		
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Update ShopAddressList';
		$data['message'] = '';
		$data['action'] = site_url('shop_address_list/updateShopAddressList');
		$data['link_back'] = anchor('shop_address_list/index/','Back to list of ShopAddressLists',array('class'=>'back'));
	
		/* LOAD VIEW */
		$this->load->view('shop_address_listEdit', $data);
	}
	
	function updateShopAddressList() {
	
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Update ShopAddressList';
		$data['action'] = site_url('shop_address_list/updateShopAddressList');
		$data['link_back'] = anchor('shop_address_list/index/','Back to list of ShopAddressLists',array('class'=>'back'));
	
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
			$shopCode = $this->input->post('shop_code');
			$shop_address_list = array(
				'address_code' => $this->input->post('address_code')
			);
			$this->ShopAddressList_model->update($shopCode, $shop_address_list);
				
			/* SET USER MESSAGE */
			$data['message'] = '<div class="success">update ShopAddressList success</div>';
		}
	
		/* LOAD VIEW */
		$this->load->view('shop_address_listEdit', $data);
	}
	
	function delete($shopCode) {
	
		/* DELETE ShopAddressList */
		$this->ShopAddressList_model->delete($shopCode);
	
		/* REDIRECT TO ShopAddressList LIST PAGE */
		redirect('shop_address_list/index/','refresh');
	}
	
	/* SET EMPTY DEFAULT FROM FIELD VALUES */
	function _set_fields() {
		$this->form_data->shop_code = '';
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