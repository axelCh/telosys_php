<?php

class ShoppingCart_model extends CI_Model {
	
	/* TABLE NAME */
	private $tbl_shopping_cart = 'shopping_cart';

	/* CONSTRUCTOR */
	function __construct() {
		parent::__construct();
	}

	/* LIST ALL ShoppingCarts IN DATABASE */
	function list_all() {
		$this->db->order_by( 'shopping_cart','asc' );
		return $this->db->get( $this->tbl_shopping_cart );
	}

	/* GET THE NUMBER OF ShoppingCarts IN DATABASE */
	function count_all() {
		return $this->db->count_all( $this->tbl_shopping_cart );
	}

	/* GET ShoppingCarts WITH PAGING */
	function get_paged_list( $limit = 10, $offset = 0 ) {
$this->db->order_by( 'book_order_id','desc' );
		return $this->db->get( $this->tbl_shopping_cart, $limit, $offset );
	}

	/* GET ShoppingCarts BY bookOrderId  */
	function get_by_book_order_id  ( $bookOrderId  ) {
$this->db->where( 'book_order_id', $bookOrderId );
		return $this->db->get( $this->tbl_shopping_cart );
	}

	/* ADD NEW ShoppingCart */
	function save( $shopping_cart ) {
		$this->db->insert( $this->tbl_shopping_cart, $shopping_cart );
	}

	/* UPDATE ShoppingCart BY bookOrderId  */
	function update( $bookOrderId , $shopping_cart ) {
$this->db->where( 'book_order_id', $bookOrderId );
		$this->db->update( $this->tbl_shopping_cart, $shopping_cart );
	}

	/* DELETE ShoppingCart BY bookOrderId  */
	function delete( $bookOrderId  ) {
$this->db->where( 'book_order_id', $bookOrderId );
		$this->db->delete( $this->tbl_shopping_cart );	
	}

}
?>