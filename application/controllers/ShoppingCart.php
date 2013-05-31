<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ShoppingCart extends CI_Controller {

	/* NUMBER OF RECORDS PER PAGE */
	private $limit = 10;

	function __construct() {
		parent::__construct();
	
		$this->load->library(array('table','form_validation'));
		$this->load->helper('url');
		$this->load->model('ShoppingCart_model','',TRUE);
	}
		
	function index($offset = 0) {
	
		/* OFFSET */
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		
		/* LOAD DATA */
		$shopping_carts = $this->ShoppingCart_model->get_paged_list($this->limit, $offset)->result();
		
		/* GENERATE PAGINATION */
		$this->load->library('pagination');
		$config['base_url'] = site_url('shopping_cart/index/');
		$config['total_rows'] = $this->ShoppingCart_model->count_all();
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		/* GENERATE TABLE DATA */
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('BOOK ORDER ID', 'BOOK ID', 'QUANTITY', 'PRICE', 'Actions');
		$i = 0 + $offset;
		foreach ($shopping_carts as $shopping_cart) {
			$this->table->add_row(++$i,
			$shopping_cart->book_id,
$shopping_cart->quantity,
$shopping_cart->price,
				anchor('shopping_cart/view/'.$shopping_cart->bookOrderId,'view',array('class'=>'view')).' '.
				anchor('shopping_cart/update/'.$shopping_cart->bookOrderId,'update',array('class'=>'update')).' '.
				anchor('shopping_cart/delete/'.$shopping_cart->bookOrderId,'delete',array('class'=>'delete','onclick'=>"return confirm('Are you sure want to delete this ShoppingCart ?')"))
			);
		}
		$data['table'] = $this->table->generate();
		
		/* LOAD VIEW */
		$this->load->view('shopping_cartList', $data);
	}
	
	function add() {
	
		/* SET EMPTY DEFAULT FROM FIELD VALUES */
		$this->_set_fields();
		
		/* SET VALIDATION PROPERTIES */
		$this->_set_rules();
	
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Add new ShoppingCart';
		$data['message'] = '';
		$data['action'] = site_url('shopping_cart/addShoppingCart');
		$data['link_back'] = anchor('shopping_cart/index/','Back to list of ShoppingCarts',array('class'=>'back'));
	
		/* LOAD VIEW */
		$this->load->view('shopping_cartEdit', $data);
	}
	
	function addShoppingCart() {
	
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Add new ShoppingCart';
		$data['action'] = site_url('shopping_cart/addShoppingCart');
		$data['link_back'] = anchor('shopping_cart/index/','Back to list of ShoppingCarts',array('class'=>'back'));
	
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
			$shopping_cart = array(
			'book_id' => $this->input->post('book_id'),
'quantity' => $this->input->post('quantity'),
'price' => $this->input->post('price'),
			);
			$bookOrderId = $this->ShoppingCart_model->save($shopping_cart);
				
			/* SET USER MESSAGE */
			$data['message'] = '<div class="success">add new ShoppingCart success</div>';
		}
	
		/* LOAD VIEW */
		$this->load->view('shopping_cartEdit', $data);
	}
	
	function view($bookOrderId) {
	
		/* SET COMMON PROPERTIES */
		$data['title'] = 'ShoppingCart Details';
		$data['link_back'] = anchor('shopping_cart/index/','Back to list of ShoppingCarts',array('class'=>'back'));
	
		/* GET ShoppingCart DETAILS */
		$data['shopping_cart'] = $this->ShoppingCart_model->get_by_bookOrderId($bookOrderId)->row();
	
		/* LOAD VIEW */
		$this->load->view('shopping_cartView', $data);
	}
	
	function update($bookOrderId) {
	
		/* SET VALIDATION PROPERTIES */
		$this->_set_rules();
	
		/* PREFILL FORM VALUES */
		$shopping_cart = $this->ShoppingCart_model->get_by_book_order_id($bookOrderId)->row();
		$this->form_data->book_order_id = $book_order_id;
		$this->form_data->book_id = $shopping_cart->book_id; 
$this->form_data->quantity = $shopping_cart->quantity; 
$this->form_data->price = $shopping_cart->price; 
		
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Update ShoppingCart';
		$data['message'] = '';
		$data['action'] = site_url('shopping_cart/updateShoppingCart');
		$data['link_back'] = anchor('shopping_cart/index/','Back to list of ShoppingCarts',array('class'=>'back'));
	
		/* LOAD VIEW */
		$this->load->view('shopping_cartEdit', $data);
	}
	
	function updateShoppingCart() {
	
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Update ShoppingCart';
		$data['action'] = site_url('shopping_cart/updateShoppingCart');
		$data['link_back'] = anchor('shopping_cart/index/','Back to list of ShoppingCarts',array('class'=>'back'));
	
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
			$bookOrderId = $this->input->post('book_order_id');
			$shopping_cart = array(
				'book_id' => $this->input->post('book_id'),
'quantity' => $this->input->post('quantity'),
'price' => $this->input->post('price')
			);
			$this->ShoppingCart_model->update($bookOrderId, $shopping_cart);
				
			/* SET USER MESSAGE */
			$data['message'] = '<div class="success">update ShoppingCart success</div>';
		}
	
		/* LOAD VIEW */
		$this->load->view('shopping_cartEdit', $data);
	}
	
	function delete($bookOrderId) {
	
		/* DELETE ShoppingCart */
		$this->ShoppingCart_model->delete($bookOrderId);
	
		/* REDIRECT TO ShoppingCart LIST PAGE */
		redirect('shopping_cart/index/','refresh');
	}
	
	/* SET EMPTY DEFAULT FROM FIELD VALUES */
	function _set_fields() {
		$this->form_data->book_order_id = '';
		$this->form_data->book_id = '';
		$this->form_data->quantity = '';
		$this->form_data->price = '';
		}
	
	/* VALIDATION RULES */
	function _set_rules() {
		$this->form_validation->set_rules('book_id', 'BOOK ID', 'trim|required');
$this->form_validation->set_rules('quantity', 'QUANTITY', 'trim|required');
$this->form_validation->set_rules('price', 'PRICE', 'trim|required');
	
		$this->form_validation->set_message('required', '* required');
		$this->form_validation->set_message('isset', '* required');
		$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
	}
	
}
?>