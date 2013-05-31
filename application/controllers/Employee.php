<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employee extends CI_Controller {

	/* NUMBER OF RECORDS PER PAGE */
	private $limit = 10;

	function __construct() {
		parent::__construct();
	
		$this->load->library(array('table','form_validation'));
		$this->load->helper('url');
		$this->load->model('Employee_model','',TRUE);
	}
		
	function index($offset = 0) {
	
		/* OFFSET */
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		
		/* LOAD DATA */
		$employees = $this->Employee_model->get_paged_list($this->limit, $offset)->result();
		
		/* GENERATE PAGINATION */
		$this->load->library('pagination');
		$config['base_url'] = site_url('employee/index/');
		$config['total_rows'] = $this->Employee_model->count_all();
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		/* GENERATE TABLE DATA */
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('CODE', 'LAST NAME', 'FIRST NAME', 'MANAGER', 'SHOP CODE', 'Actions');
		$i = 0 + $offset;
		foreach ($employees as $employee) {
			$this->table->add_row(++$i,
			$employee->last_name,
$employee->first_name,
$employee->manager,
$employee->shop_code,
				anchor('employee/view/'.$employee->code,'view',array('class'=>'view')).' '.
				anchor('employee/update/'.$employee->code,'update',array('class'=>'update')).' '.
				anchor('employee/delete/'.$employee->code,'delete',array('class'=>'delete','onclick'=>"return confirm('Are you sure want to delete this Employee ?')"))
			);
		}
		$data['table'] = $this->table->generate();
		
		/* LOAD VIEW */
		$this->load->view('employeeList', $data);
	}
	
	function add() {
	
		/* SET EMPTY DEFAULT FROM FIELD VALUES */
		$this->_set_fields();
		
		/* SET VALIDATION PROPERTIES */
		$this->_set_rules();
	
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Add new Employee';
		$data['message'] = '';
		$data['action'] = site_url('employee/addEmployee');
		$data['link_back'] = anchor('employee/index/','Back to list of Employees',array('class'=>'back'));
	
		/* LOAD VIEW */
		$this->load->view('employeeEdit', $data);
	}
	
	function addEmployee() {
	
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Add new Employee';
		$data['action'] = site_url('employee/addEmployee');
		$data['link_back'] = anchor('employee/index/','Back to list of Employees',array('class'=>'back'));
	
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
			$employee = array(
			'last_name' => $this->input->post('last_name'),
'first_name' => $this->input->post('first_name'),
'manager' => $this->input->post('manager'),
'shop_code' => $this->input->post('shop_code'),
			);
			$code = $this->Employee_model->save($employee);
				
			/* SET USER MESSAGE */
			$data['message'] = '<div class="success">add new Employee success</div>';
		}
	
		/* LOAD VIEW */
		$this->load->view('employeeEdit', $data);
	}
	
	function view($code) {
	
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Employee Details';
		$data['link_back'] = anchor('employee/index/','Back to list of Employees',array('class'=>'back'));
	
		/* GET Employee DETAILS */
		$data['employee'] = $this->Employee_model->get_by_code($code)->row();
	
		/* LOAD VIEW */
		$this->load->view('employeeView', $data);
	}
	
	function update($code) {
	
		/* SET VALIDATION PROPERTIES */
		$this->_set_rules();
	
		/* PREFILL FORM VALUES */
		$employee = $this->Employee_model->get_by_code($code)->row();
		$this->form_data->code = $code;
		$this->form_data->last_name = $employee->last_name; 
$this->form_data->first_name = $employee->first_name; 
$this->form_data->manager = $employee->manager; 
$this->form_data->shop_code = $employee->shop_code; 
		
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Update Employee';
		$data['message'] = '';
		$data['action'] = site_url('employee/updateEmployee');
		$data['link_back'] = anchor('employee/index/','Back to list of Employees',array('class'=>'back'));
	
		/* LOAD VIEW */
		$this->load->view('employeeEdit', $data);
	}
	
	function updateEmployee() {
	
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Update Employee';
		$data['action'] = site_url('employee/updateEmployee');
		$data['link_back'] = anchor('employee/index/','Back to list of Employees',array('class'=>'back'));
	
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
			$employee = array(
				'last_name' => $this->input->post('last_name'),
'first_name' => $this->input->post('first_name'),
'manager' => $this->input->post('manager'),
'shop_code' => $this->input->post('shop_code')
			);
			$this->Employee_model->update($code, $employee);
				
			/* SET USER MESSAGE */
			$data['message'] = '<div class="success">update Employee success</div>';
		}
	
		/* LOAD VIEW */
		$this->load->view('employeeEdit', $data);
	}
	
	function delete($code) {
	
		/* DELETE Employee */
		$this->Employee_model->delete($code);
	
		/* REDIRECT TO Employee LIST PAGE */
		redirect('employee/index/','refresh');
	}
	
	/* SET EMPTY DEFAULT FROM FIELD VALUES */
	function _set_fields() {
		$this->form_data->code = '';
		$this->form_data->last_name = '';
		$this->form_data->first_name = '';
		$this->form_data->manager = '';
		$this->form_data->shop_code = '';
		}
	
	/* VALIDATION RULES */
	function _set_rules() {
		$this->form_validation->set_rules('last_name', 'LAST NAME', 'trim|required');
$this->form_validation->set_rules('first_name', 'FIRST NAME', 'trim|required');
$this->form_validation->set_rules('manager', 'MANAGER', 'trim|required');
$this->form_validation->set_rules('shop_code', 'SHOP CODE', 'trim|required');
	
		$this->form_validation->set_message('required', '* required');
		$this->form_validation->set_message('isset', '* required');
		$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
	}
	
}
?>