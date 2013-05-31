<?php
class Customer_model extends CI_Model {

	/* TABLE NAME */
	private $tbl_customer = 'customer';

	/* CONSTRUCTOR */
	function __construct() {
		parent::__construct();
	}
	
	/* LIST ALL Customers IN DATABASE */
	function list_all() {
		$this->db->order_by('customer','asc');
		return $this->db->get($this->tbl_customer);
	}
	
	/* GET THE NUMBER OF Customers IN DATABASE */
	function count_all() {
		return $this->db->count_all($this->tbl_customer);
	}
	
	/* GET Customers WITH PAGING */
	function get_paged_list($limit = 10, $offset = 0) {
		$this->db->order_by('code','asc');
		return $this->db->get($this->tbl_customer, $limit, $offset);
	}

	/* GET Customers BY code */
	function get_by_code($code) {
		$this->db->where('code', $code);
		return $this->db->get($this->tbl_customer);
	}
	
	/* ADD NEW Customer */
	function save($customer) {
		$this->db->insert($this->tbl_customer, $customer);
		return $this->db->insert_code();
	}
	
	/* UPDATE Customer BY code */
	function update($code, $customer) {
		$this->db->where('code', $code);
		$this->db->update($this->tbl_customer, $customer);
	}
	
	/* DELETE Customer BY code */
	function delete($code) {
		$this->db->where('code', $code);
		$this->db->delete($this->tbl_customer);	
	}

}
?>