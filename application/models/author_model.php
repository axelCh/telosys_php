<?php

class Author_model extends CI_Model {
	
	/* TABLE NAME */
	private $tbl_author = 'author';

	/* CONSTRUCTOR */
	function __construct() {
		parent::__construct();
	}

	/* LIST ALL Authors IN DATABASE */
	function list_all() {
		$this->db->order_by( 'author','asc' );
		return $this->db->get( $this->tbl_author );
	}

	/* GET THE NUMBER OF Authors IN DATABASE */
	function count_all() {
		return $this->db->count_all( $this->tbl_author );
	}

	/* GET Authors WITH PAGING */
	function get_paged_list( $limit = 10, $offset = 0 ) {
$this->db->order_by( 'id','desc' );
		return $this->db->get( $this->tbl_author, $limit, $offset );
	}

	/* GET Authors BY id  */
	function get_by_id  ( $id  ) {
$this->db->where( 'id', $id );
		return $this->db->get( $this->tbl_author );
	}

	/* ADD NEW Author */
	function save( $author ) {
		$this->db->insert( $this->tbl_author, $author );
	}

	/* UPDATE Author BY id  */
	function update( $id , $author ) {
$this->db->where( 'id', $id );
		$this->db->update( $this->tbl_author, $author );
	}

	/* DELETE Author BY id  */
	function delete( $id  ) {
$this->db->where( 'id', $id );
		$this->db->delete( $this->tbl_author );	
	}

}
?>