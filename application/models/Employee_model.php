<?php
class Employee_model extends CI_Model {

	/* TABLE NAME */
	private $tbl_employee = 'employee';

	/* CONSTRUCTOR */
	function __construct() {
		parent::__construct();
	}
	
	/* LIST ALL Employees IN DATABASE */
	function list_all() {
		$this->db->order_by('employee','asc');
		return $this->db->get($this->tbl_employee);
	}
	
	/* GET THE NUMBER OF Employees IN DATABASE */
	function count_all() {
		return $this->db->count_all($this->tbl_employee);
	}
	
	/* GET Employees WITH PAGING */
	function get_paged_list($limit = 10, $offset = 0) {
		$this->db->order_by('code','asc');
		return $this->db->get($this->tbl_employee, $limit, $offset);
	}

	/* GET Employees BY code */
	function get_by_code($code) {
		$this->db->where('code', $code);
		return $this->db->get($this->tbl_employee);
	}
	
	/* ADD NEW Employee */
	function save($employee) {
		$this->db->insert($this->tbl_employee, $employee);
		return $this->db->insert_code();
	}
	
	/* UPDATE Employee BY code */
	function update($code, $employee) {
		$this->db->where('code', $code);
		$this->db->update($this->tbl_employee, $employee);
	}
	
	/* DELETE Employee BY code */
	function delete($code) {
		$this->db->where('code', $code);
		$this->db->delete($this->tbl_employee);	
	}

}
?>