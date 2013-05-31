<?php
class BookOrder_model extends CI_Model {

	/* TABLE NAME */
	private $tbl_book_order = 'book_order';

	/* CONSTRUCTOR */
	function __construct() {
		parent::__construct();
	}
	
	/* LIST ALL BookOrders IN DATABASE */
	function list_all() {
		$this->db->order_by('book_order','asc');
		return $this->db->get($this->tbl_book_order);
	}
	
	/* GET THE NUMBER OF BookOrders IN DATABASE */
	function count_all() {
		return $this->db->count_all($this->tbl_book_order);
	}
	
	/* GET BookOrders WITH PAGING */
	function get_paged_list($limit = 10, $offset = 0) {
		$this->db->order_by('id','asc');
		return $this->db->get($this->tbl_book_order, $limit, $offset);
	}

	/* GET BookOrders BY id */
	function get_by_id($id) {
		$this->db->where('id', $id);
		return $this->db->get($this->tbl_book_order);
	}
	
	/* ADD NEW BookOrder */
	function save($book_order) {
		$this->db->insert($this->tbl_book_order, $book_order);
		return $this->db->insert_id();
	}
	
	/* UPDATE BookOrder BY id */
	function update($id, $book_order) {
		$this->db->where('id', $id);
		$this->db->update($this->tbl_book_order, $book_order);
	}
	
	/* DELETE BookOrder BY id */
	function delete($id) {
		$this->db->where('id', $id);
		$this->db->delete($this->tbl_book_order);	
	}

}
?>