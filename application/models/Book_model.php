<?php
class Book_model extends CI_Model {

	/* TABLE NAME */
	private $tbl_book = 'book';

	/* CONSTRUCTOR */
	function __construct() {
		parent::__construct();
	}
	
	/* LIST ALL Books IN DATABASE */
	function list_all() {
		$this->db->order_by('book','asc');
		return $this->db->get($this->tbl_book);
	}
	
	/* GET THE NUMBER OF Books IN DATABASE */
	function count_all() {
		return $this->db->count_all($this->tbl_book);
	}
	
	/* GET Books WITH PAGING */
	function get_paged_list($limit = 10, $offset = 0) {
		$this->db->order_by('id','asc');
		return $this->db->get($this->tbl_book, $limit, $offset);
	}

	/* GET Books BY id */
	function get_by_id($id) {
		$this->db->where('id', $id);
		return $this->db->get($this->tbl_book);
	}
	
	/* ADD NEW Book */
	function save($book) {
		$this->db->insert($this->tbl_book, $book);
		return $this->db->insert_id();
	}
	
	/* UPDATE Book BY id */
	function update($id, $book) {
		$this->db->where('id', $id);
		$this->db->update($this->tbl_book, $book);
	}
	
	/* DELETE Book BY id */
	function delete($id) {
		$this->db->where('id', $id);
		$this->db->delete($this->tbl_book);	
	}

}
?>