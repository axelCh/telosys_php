<?php
class CustomerAddressList_model extends CI_Model {

	/* TABLE NAME */
	private $tbl_customer_address_list = 'customer_address_list';

	/* CONSTRUCTOR */
	function __construct() {
		parent::__construct();
	}
	
	/* LIST ALL CustomerAddressLists IN DATABASE */
	function list_all() {
		$this->db->order_by('customer_address_list','asc');
		return $this->db->get($this->tbl_customer_address_list);
	}
	
	/* GET THE NUMBER OF CustomerAddressLists IN DATABASE */
	function count_all() {
		return $this->db->count_all($this->tbl_customer_address_list);
	}
	
	/* GET CustomerAddressLists WITH PAGING */
	function get_paged_list($limit = 10, $offset = 0) {
		$this->db->order_by('customer_code','asc');
		return $this->db->get($this->tbl_customer_address_list, $limit, $offset);
	}

	/* GET CustomerAddressLists BY customerCode */
	function get_by_customer_code($customerCode) {
		$this->db->where('customer_code', $customerCode);
		return $this->db->get($this->tbl_customer_address_list);
	}
	
	/* ADD NEW CustomerAddressList */
	function save($customer_address_list) {
		$this->db->insert($this->tbl_customer_address_list, $customer_address_list);
		return $this->db->insert_customer_code();
	}
	
	/* UPDATE CustomerAddressList BY customerCode */
	function update($customerCode, $customer_address_list) {
		$this->db->where('customer_code', $customerCode);
		$this->db->update($this->tbl_customer_address_list, $customer_address_list);
	}
	
	/* DELETE CustomerAddressList BY customerCode */
	function delete($customerCode) {
		$this->db->where('customer_code', $customerCode);
		$this->db->delete($this->tbl_customer_address_list);	
	}

}
?>