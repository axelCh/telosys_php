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
		$this->db->order_by( 'review','asc' );
		return $this->db->get( $this->tbl_review );
	}

	/* GET THE NUMBER OF Reviews IN DATABASE */
	function count_all() {
		return $this->db->count_all( $this->tbl_review );
	}

	/* GET Reviews WITH PAGING */
	function get_paged_list( $limit = 10, $offset = 0 ) {
$this->db->order_by( 'customer_code','desc' );
$this->db->order_by( 'book_id','desc' );
		return $this->db->get( $this->tbl_review, $limit, $offset );
	}

	/* GET Reviews BY customerCode AND bookId  */
	function get_by_customer_code_and_book_id  ( $customerCode, $bookId  ) {
$this->db->where( 'customer_code', $customerCode );
$this->db->where( 'book_id', $bookId );
		return $this->db->get( $this->tbl_review );
	}

	/* ADD NEW Review */
	function save( $review ) {
		$this->db->insert( $this->tbl_review, $review );
	}

	/* UPDATE Review BY customerCode AND bookId  */
	function update( $customerCode, $bookId , $review ) {
$this->db->where( 'customer_code', $customerCode );
$this->db->where( 'book_id', $bookId );
		$this->db->update( $this->tbl_review, $review );
	}

	/* DELETE Review BY customerCode AND bookId  */
	function delete( $customerCode, $bookId  ) {
$this->db->where( 'customer_code', $customerCode );
$this->db->where( 'book_id', $bookId );
		$this->db->delete( $this->tbl_review );	
	}

}
?>