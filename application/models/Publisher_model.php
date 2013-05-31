<?php
class Publisher_model extends CI_Model {

	/* TABLE NAME */
	private $tbl_publisher = 'publisher';

	/* CONSTRUCTOR */
	function __construct() {
		parent::__construct();
	}
	
	/* LIST ALL Publishers IN DATABASE */
	function list_all() {
		$this->db->order_by('publisher','asc');
		return $this->db->get($this->tbl_publisher);
	}
	
	/* GET THE NUMBER OF Publishers IN DATABASE */
	function count_all() {
		return $this->db->count_all($this->tbl_publisher);
	}
	
	/* GET Publishers WITH PAGING */
	function get_paged_list($limit = 10, $offset = 0) {
		$this->db->order_by('code','asc');
		return $this->db->get($this->tbl_publisher, $limit, $offset);
	}

	/* GET Publishers BY code */
	function get_by_code($code) {
		$this->db->where('code', $code);
		return $this->db->get($this->tbl_publisher);
	}
	
	/* ADD NEW Publisher */
	function save($publisher) {
		$this->db->insert($this->tbl_publisher, $publisher);
		return $this->db->insert_code();
	}
	
	/* UPDATE Publisher BY code */
	function update($code, $publisher) {
		$this->db->where('code', $code);
		$this->db->update($this->tbl_publisher, $publisher);
	}
	
	/* DELETE Publisher BY code */
	function delete($code) {
		$this->db->where('code', $code);
		$this->db->delete($this->tbl_publisher);	
	}

}
?>