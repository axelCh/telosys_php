<?php
class Review_model extends CI_Model {

	/* TABLE NAME */
	private $tbl_review = 'review';

	/* CONSTRUCTOR */
	function __construct() {
		parent::__construct();
	}
	
	/* LIST ALL Reviews IN DATABASE */
	function list_all() {
		$this->db->order_by('review','asc');
		return $this->db->get($this->tbl_review);
	}
	
	/* GET THE NUMBER OF Reviews IN DATABASE */
	function count_all() {
		return $this->db->count_all($this->tbl_review);
	}
	
	/* GET Reviews WITH PAGING */
	function get_paged_list($limit = 10, $offset = 0) {
		$this->db->order_by('customer_code','asc');
		return $this->db->get($this->tbl_review, $limit, $offset);
	}

	/* GET Reviews BY customerCode */
	function get_by_customer_code($customerCode) {
		$this->db->where('customer_code', $customerCode);
		return $this->db->get($this->tbl_review);
	}
	
	/* ADD NEW Review */
	function save($review) {
		$this->db->insert($this->tbl_review, $review);
		return $this->db->insert_customer_code();
	}
	
	/* UPDATE Review BY customerCode */
	function update($customerCode, $review) {
		$this->db->where('customer_code', $customerCode);
		$this->db->update($this->tbl_review, $review);
	}
	
	/* DELETE Review BY customerCode */
	function delete($customerCode) {
		$this->db->where('customer_code', $customerCode);
		$this->db->delete($this->tbl_review);	
	}

}
?>