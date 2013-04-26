<?php
class Author_model extends CI_Model {
	
	/* TABLE NAME */
	private $tbl_author = 'author';

	/* CONSTRUCTOR */
	function __construct(){
		parent::__construct();
	}
 
	/* LIST ALL AUTHORS IN DATABASE */
	function list_all(){
		$this->db->order_by('id','asc');
		return $this->db->get($this->tbl_author);
	}
	
	/* GET THE NUMBER OF AUTHORS IN DATABASE */	
	function count_all(){
		return $this->db->count_all($this->tbl_author);
	}
	
	/* GET AUTHORS WITH PAGING */	
	function get_paged_list($limit = 10, $offset = 0){
		$this->db->order_by('id','asc');
		return $this->db->get($this->tbl_author, $limit, $offset);
	}
	
	/* GET AUTHORS BY ID */	
	function get_by_id($id){
		$this->db->where('id', $id);
		return $this->db->get($this->tbl_author);
	}
	
	/* ADD NEW AUTHOR */	
	function save($author){
		$this->db->insert($this->tbl_author, $author);
		return $this->db->insert_id();
	}
	
	/* UPDATE AUTHOR BY ID */	
	function update($id, $author){
		$this->db->where('id', $id);
		$this->db->update($this->tbl_author, $author);
	}
	
	/* DELETE AUTHOR BY ID */	
	function delete($id){
		$this->db->where('id', $id);
		$this->db->delete($this->tbl_author);	
	}
	
}
?>