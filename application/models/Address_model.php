<?php
class Address_model extends CI_Model {

	/* TABLE NAME */
	private $tbl_address = 'address';

	/* CONSTRUCTOR */
	function __construct() {
		parent::__construct();
	}
	
	/* LIST ALL Addresss IN DATABASE */
	function list_all() {
		$this->db->order_by('address','asc');
		return $this->db->get($this->tbl_address);
	}
	
	/* GET THE NUMBER OF Addresss IN DATABASE */
	function count_all() {
		return $this->db->count_all($this->tbl_address);
	}
	
	/* GET Addresss WITH PAGING */
	function get_paged_list($limit = 10, $offset = 0) {
		$this->db->order_by('code','asc');
		return $this->db->get($this->tbl_address, $limit, $offset);
	}

	/* GET Addresss BY code */
	function get_by_code($code) {
		$this->db->where('code', $code);
		return $this->db->get($this->tbl_address);
	}
	
	/* ADD NEW Address */
	function save($address) {
		$this->db->insert($this->tbl_address, $address);
		return $this->db->insert_code();
	}
	
	/* UPDATE Address BY code */
	function update($code, $address) {
		$this->db->where('code', $code);
		$this->db->update($this->tbl_address, $address);
	}
	
	/* DELETE Address BY code */
	function delete($code) {
		$this->db->where('code', $code);
		$this->db->delete($this->tbl_address);	
	}

}
?>