<?php
class Country_model extends CI_Model {

	/* TABLE NAME */
	private $tbl_country = 'country';

	/* CONSTRUCTOR */
	function __construct() {
		parent::__construct();
	}
	
	/* LIST ALL Countrys IN DATABASE */
	function list_all() {
		$this->db->order_by('country','asc');
		return $this->db->get($this->tbl_country);
	}
	
	/* GET THE NUMBER OF Countrys IN DATABASE */
	function count_all() {
		return $this->db->count_all($this->tbl_country);
	}
	
	/* GET Countrys WITH PAGING */
	function get_paged_list($limit = 10, $offset = 0) {
		$this->db->order_by('code','asc');
		return $this->db->get($this->tbl_country, $limit, $offset);
	}

	/* GET Countrys BY code */
	function get_by_code($code) {
		$this->db->where('code', $code);
		return $this->db->get($this->tbl_country);
	}
	
	/* ADD NEW Country */
	function save($country) {
		$this->db->insert($this->tbl_country, $country);
		return $this->db->insert_code();
	}
	
	/* UPDATE Country BY code */
	function update($code, $country) {
		$this->db->where('code', $code);
		$this->db->update($this->tbl_country, $country);
	}
	
	/* DELETE Country BY code */
	function delete($code) {
		$this->db->where('code', $code);
		$this->db->delete($this->tbl_country);	
	}

}
?>