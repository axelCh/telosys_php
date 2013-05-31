<?php
class Shop_model extends CI_Model {

	/* TABLE NAME */
	private $tbl_shop = 'shop';

	/* CONSTRUCTOR */
	function __construct() {
		parent::__construct();
	}
	
	/* LIST ALL Shops IN DATABASE */
	function list_all() {
		$this->db->order_by('shop','asc');
		return $this->db->get($this->tbl_shop);
	}
	
	/* GET THE NUMBER OF Shops IN DATABASE */
	function count_all() {
		return $this->db->count_all($this->tbl_shop);
	}
	
	/* GET Shops WITH PAGING */
	function get_paged_list($limit = 10, $offset = 0) {
		$this->db->order_by('code','asc');
		return $this->db->get($this->tbl_shop, $limit, $offset);
	}

	/* GET Shops BY code */
	function get_by_code($code) {
		$this->db->where('code', $code);
		return $this->db->get($this->tbl_shop);
	}
	
	/* ADD NEW Shop */
	function save($shop) {
		$this->db->insert($this->tbl_shop, $shop);
		return $this->db->insert_code();
	}
	
	/* UPDATE Shop BY code */
	function update($code, $shop) {
		$this->db->where('code', $code);
		$this->db->update($this->tbl_shop, $shop);
	}
	
	/* DELETE Shop BY code */
	function delete($code) {
		$this->db->where('code', $code);
		$this->db->delete($this->tbl_shop);	
	}

}
?>