<?php
class Author extends CI_Controller
{
	
	function index()
	{
		$this->load->database();
		$this->load->library('table');
		
		$query = $this->db->query("SELECT * FROM author");
		$result = $this->table->generate($query);
		
		$this->load->view('authorview', $result);
	}
}
?>