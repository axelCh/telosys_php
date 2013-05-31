<?php
class PublisherAddressList_model extends CI_Model {

	/* TABLE NAME */
	private $tbl_publisher_address_list = 'publisher_address_list';

	/* CONSTRUCTOR */
	function __construct() {
		parent::__construct();
	}
	
	/* LIST ALL PublisherAddressLists IN DATABASE */
	function list_all() {
		$this->db->order_by('publisher_address_list','asc');
		return $this->db->get($this->tbl_publisher_address_list);
	}
	
	/* GET THE NUMBER OF PublisherAddressLists IN DATABASE */
	function count_all() {
		return $this->db->count_all($this->tbl_publisher_address_list);
	}
	
	/* GET PublisherAddressLists WITH PAGING */
	function get_paged_list($limit = 10, $offset = 0) {
		$this->db->order_by('publisher_code','asc');
		return $this->db->get($this->tbl_publisher_address_list, $limit, $offset);
	}

	/* GET PublisherAddressLists BY publisherCode */
	function get_by_publisher_code($publisherCode) {
		$this->db->where('publisher_code', $publisherCode);
		return $this->db->get($this->tbl_publisher_address_list);
	}
	
	/* ADD NEW PublisherAddressList */
	function save($publisher_address_list) {
		$this->db->insert($this->tbl_publisher_address_list, $publisher_address_list);
		return $this->db->insert_publisher_code();
	}
	
	/* UPDATE PublisherAddressList BY publisherCode */
	function update($publisherCode, $publisher_address_list) {
		$this->db->where('publisher_code', $publisherCode);
		$this->db->update($this->tbl_publisher_address_list, $publisher_address_list);
	}
	
	/* DELETE PublisherAddressList BY publisherCode */
	function delete($publisherCode) {
		$this->db->where('publisher_code', $publisherCode);
		$this->db->delete($this->tbl_publisher_address_list);	
	}

}
?>