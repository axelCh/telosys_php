<?php
class City_model extends CI_Model {

	/* TABLE NAME */
	private $tbl_city = 'city';

	/* CONSTRUCTOR */
	function __construct() {
		parent::__construct();
	}
	
	/* LIST ALL Citys IN DATABASE */
	function list_all() {
		$this->db->order_by('city','asc');
		return $this->db->get($this->tbl_city);
	}
	
	/* GET THE NUMBER OF Citys IN DATABASE */
	function count_all() {
		return $this->db->count_all($this->tbl_city);
	}
	
	/* GET Citys WITH PAGING */
	function get_paged_list($limit = 10, $offset = 0) {
		$this->db->order_by('zip_code','asc');
		return $this->db->get($this->tbl_city, $limit, $offset);
	}

	/* GET Citys BY zipCode */
	function get_by_zip_code($zipCode) {
		$this->db->where('zip_code', $zipCode);
		return $this->db->get($this->tbl_city);
	}
	
	/* ADD NEW City */
	function save($city) {
		$this->db->insert($this->tbl_city, $city);
		return $this->db->insert_zip_code();
	}
	
	/* UPDATE City BY zipCode */
	function update($zipCode, $city) {
		$this->db->where('zip_code', $zipCode);
		$this->db->update($this->tbl_city, $city);
	}
	
	/* DELETE City BY zipCode */
	function delete($zipCode) {
		$this->db->where('zip_code', $zipCode);
		$this->db->delete($this->tbl_city);	
	}

}
?>