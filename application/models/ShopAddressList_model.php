<?php
class ShopAddressList_model extends CI_Model {

	/* TABLE NAME */
	private $tbl_shop_address_list = 'shop_address_list';

	/* CONSTRUCTOR */
	function __construct() {
		parent::__construct();
	}
	
	/* LIST ALL ShopAddressLists IN DATABASE */
	function list_all() {
		$this->db->order_by('shop_address_list','asc');
		return $this->db->get($this->tbl_shop_address_list);
	}
	
	/* GET THE NUMBER OF ShopAddressLists IN DATABASE */
	function count_all() {
		return $this->db->count_all($this->tbl_shop_address_list);
	}
	
	/* GET ShopAddressLists WITH PAGING */
	function get_paged_list($limit = 10, $offset = 0) {
		$this->db->order_by('shop_code','asc');
		return $this->db->get($this->tbl_shop_address_list, $limit, $offset);
	}

	/* GET ShopAddressLists BY shopCode */
	function get_by_shop_code($shopCode) {
		$this->db->where('shop_code', $shopCode);
		return $this->db->get($this->tbl_shop_address_list);
	}
	
	/* ADD NEW ShopAddressList */
	function save($shop_address_list) {
		$this->db->insert($this->tbl_shop_address_list, $shop_address_list);
		return $this->db->insert_shop_code();
	}
	
	/* UPDATE ShopAddressList BY shopCode */
	function update($shopCode, $shop_address_list) {
		$this->db->where('shop_code', $shopCode);
		$this->db->update($this->tbl_shop_address_list, $shop_address_list);
	}
	
	/* DELETE ShopAddressList BY shopCode */
	function delete($shopCode) {
		$this->db->where('shop_code', $shopCode);
		$this->db->delete($this->tbl_shop_address_list);	
	}

}
?>