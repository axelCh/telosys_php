<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class BookOrder extends CI_Controller {

	/* NUMBER OF RECORDS PER PAGE */
	private $limit = 10;

	function __construct() {
		parent::__construct();
	
		$this->load->library(array('table','form_validation'));
		$this->load->helper('url');
		$this->load->model('BookOrder_model','',TRUE);
	}
		
	function index($offset = 0) {
	
		/* OFFSET */
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		
		/* LOAD DATA */
		$book_orders = $this->BookOrder_model->get_paged_list($this->limit, $offset)->result();
		
		/* GENERATE PAGINATION */
		$this->load->library('pagination');
		$config['base_url'] = site_url('book_order/index/');
		$config['total_rows'] = $this->BookOrder_model->count_all();
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		/* GENERATE TABLE DATA */
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('ID', 'DATE', 'STATE', 'CUSTOMER CODE', 'SHOP CODE', 'EMPLOYEE CODE', 'DISCOUNT', 'TOTAL PRICE', 'Actions');
		$i = 0 + $offset;
		foreach ($book_orders as $book_order) {
			$this->table->add_row(++$i,
			$book_order->date,
$book_order->state,
$book_order->customer_code,
$book_order->shop_code,
$book_order->employee_code,
$book_order->discount,
$book_order->total_price,
				anchor('book_order/view/'.$book_order->id,'view',array('class'=>'view')).' '.
				anchor('book_order/update/'.$book_order->id,'update',array('class'=>'update')).' '.
				anchor('book_order/delete/'.$book_order->id,'delete',array('class'=>'delete','onclick'=>"return confirm('Are you sure want to delete this BookOrder ?')"))
			);
		}
		$data['table'] = $this->table->generate();
		
		/* LOAD VIEW */
		$this->load->view('book_orderList', $data);
	}
	
	function add() {
	
		/* SET EMPTY DEFAULT FROM FIELD VALUES */
		$this->_set_fields();
		
		/* SET VALIDATION PROPERTIES */
		$this->_set_rules();
	
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Add new BookOrder';
		$data['message'] = '';
		$data['action'] = site_url('book_order/addBookOrder');
		$data['link_back'] = anchor('book_order/index/','Back to list of BookOrders',array('class'=>'back'));
	
		/* LOAD VIEW */
		$this->load->view('book_orderEdit', $data);
	}
	
	function addBookOrder() {
	
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Add new BookOrder';
		$data['action'] = site_url('book_order/addBookOrder');
		$data['link_back'] = anchor('book_order/index/','Back to list of BookOrders',array('class'=>'back'));
	
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
			$book_order = array(
			'date' => $this->input->post('date'),
'state' => $this->input->post('state'),
'customer_code' => $this->input->post('customer_code'),
'shop_code' => $this->input->post('shop_code'),
'employee_code' => $this->input->post('employee_code'),
'discount' => $this->input->post('discount'),
'total_price' => $this->input->post('total_price'),
			);
			$id = $this->BookOrder_model->save($book_order);
				
			/* SET USER MESSAGE */
			$data['message'] = '<div class="success">add new BookOrder success</div>';
		}
	
		/* LOAD VIEW */
		$this->load->view('book_orderEdit', $data);
	}
	
	function view($id) {
	
		/* SET COMMON PROPERTIES */
		$data['title'] = 'BookOrder Details';
		$data['link_back'] = anchor('book_order/index/','Back to list of BookOrders',array('class'=>'back'));
	
		/* GET BookOrder DETAILS */
		$data['book_order'] = $this->BookOrder_model->get_by_id($id)->row();
	
		/* LOAD VIEW */
		$this->load->view('book_orderView', $data);
	}
	
	function update($id) {
	
		/* SET VALIDATION PROPERTIES */
		$this->_set_rules();
	
		/* PREFILL FORM VALUES */
		$book_order = $this->BookOrder_model->get_by_id($id)->row();
		$this->form_data->id = $id;
		$this->form_data->date = $book_order->date; 
$this->form_data->state = $book_order->state; 
$this->form_data->customer_code = $book_order->customer_code; 
$this->form_data->shop_code = $book_order->shop_code; 
$this->form_data->employee_code = $book_order->employee_code; 
$this->form_data->discount = $book_order->discount; 
$this->form_data->total_price = $book_order->total_price; 
		
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Update BookOrder';
		$data['message'] = '';
		$data['action'] = site_url('book_order/updateBookOrder');
		$data['link_back'] = anchor('book_order/index/','Back to list of BookOrders',array('class'=>'back'));
	
		/* LOAD VIEW */
		$this->load->view('book_orderEdit', $data);
	}
	
	function updateBookOrder() {
	
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Update BookOrder';
		$data['action'] = site_url('book_order/updateBookOrder');
		$data['link_back'] = anchor('book_order/index/','Back to list of BookOrders',array('class'=>'back'));
	
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
			$id = $this->input->post('id');
			$book_order = array(
				'date' => $this->input->post('date'),
'state' => $this->input->post('state'),
'customer_code' => $this->input->post('customer_code'),
'shop_code' => $this->input->post('shop_code'),
'employee_code' => $this->input->post('employee_code'),
'discount' => $this->input->post('discount'),
'total_price' => $this->input->post('total_price')
			);
			$this->BookOrder_model->update($id, $book_order);
				
			/* SET USER MESSAGE */
			$data['message'] = '<div class="success">update BookOrder success</div>';
		}
	
		/* LOAD VIEW */
		$this->load->view('book_orderEdit', $data);
	}
	
	function delete($id) {
	
		/* DELETE BookOrder */
		$this->BookOrder_model->delete($id);
	
		/* REDIRECT TO BookOrder LIST PAGE */
		redirect('book_order/index/','refresh');
	}
	
	/* SET EMPTY DEFAULT FROM FIELD VALUES */
	function _set_fields() {
		$this->form_data->id = '';
		$this->form_data->date = '';
		$this->form_data->state = '';
		$this->form_data->customer_code = '';
		$this->form_data->shop_code = '';
		$this->form_data->employee_code = '';
		$this->form_data->discount = '';
		$this->form_data->total_price = '';
		}
	
	/* VALIDATION RULES */
	function _set_rules() {
		$this->form_validation->set_rules('date', 'DATE', 'trim|required');
$this->form_validation->set_rules('state', 'STATE', 'trim|required');
$this->form_validation->set_rules('customer_code', 'CUSTOMER CODE', 'trim|required');
$this->form_validation->set_rules('shop_code', 'SHOP CODE', 'trim|required');
$this->form_validation->set_rules('employee_code', 'EMPLOYEE CODE', 'trim|required');
$this->form_validation->set_rules('discount', 'DISCOUNT', 'trim|required');
$this->form_validation->set_rules('total_price', 'TOTAL PRICE', 'trim|required');
	
		$this->form_validation->set_message('required', '* required');
		$this->form_validation->set_message('isset', '* required');
		$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
	}
	
}
?>