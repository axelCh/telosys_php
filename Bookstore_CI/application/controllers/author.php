<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Author extends CI_Controller
{
	/* NUMBER OF RECORDS PER PAGE */
	private $limit = 10;

	function __construct()
	{
		parent::__construct();
	
		$this->load->library(array('table','form_validation'));
		$this->load->helper('url');
		$this->load->model('Author_model','',TRUE);
	}
		
	function index($offset = 0)
	{
		/* OFFSET */
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		
		/* LOAD DATA */
		$authors = $this->Author_model->get_paged_list($this->limit, $offset)->result();
		
		/* GENERATE PAGINATION */
		$this->load->library('pagination');
		$config['base_url'] = site_url('author/index/');
		$config['total_rows'] = $this->Author_model->count_all();
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		/* GENERATE TABLE DATA */
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('ID', 'Last Name', 'First Name', 'Actions');
		$i = 0 + $offset;
		foreach ($authors as $author)
		{
			$this->table->add_row(++$i, strtoupper($author->last_name), $author->first_name,
					anchor('author/view/'.$author->id,'view',array('class'=>'view')).' '.
					anchor('author/update/'.$author->id,'update',array('class'=>'update')).' '.
					anchor('author/delete/'.$author->id,'delete',array('class'=>'delete','onclick'=>"return confirm('Are you sure want to delete this author ?')"))
			);
		}
		$data['table'] = $this->table->generate();
		
		/* LOAD VIEW */
		$this->load->view('authorList', $data);
	}
	
	function add()
	{
		/* SET EMPTY DEFAULT FROM FIELD VALUES */
		$this->_set_fields();
		
		/* SET VALIDATION PROPERTIES */
		$this->_set_rules();
	
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Add new author';
		$data['message'] = '';
		$data['action'] = site_url('author/addAuthor');
		$data['link_back'] = anchor('author/index/','Back to list of authors',array('class'=>'back'));
	
		/* LOAD VIEW */
		$this->load->view('authorEdit', $data);
	}
	
	function addAuthor()
	{
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Add new author';
		$data['action'] = site_url('author/addAuthor');
		$data['link_back'] = anchor('author/index/','Back to list of authors',array('class'=>'back'));
	
		/* SET EMPTY DEFAULT FROM FIELD VALUES */
		$this->_set_fields();
		
		/* SET VALIDATION PROPERTIES */
		$this->_set_rules();
	
		/* RUN VALIDATION */
		if ($this->form_validation->run() == FALSE)
		{
			$data['message'] = '';
		}
		else
		{
			/* SAVE DATA */
			$author = array('last_name' => $this->input->post('last_name'),
					'first_name' => $this->input->post('first_name'));
			$id = $this->Author_model->save($author);
				
			/* SET USER MESSAGE */
			$data['message'] = '<div class="success">add new author success</div>';
		}
	
		/* LOAD VIEW */
		$this->load->view('authorEdit', $data);
	}
	
	function view($id)
	{
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Author Details';
		$data['link_back'] = anchor('author/index/','Back to list of authors',array('class'=>'back'));
	
		/* GET AUTHOR DETAILS */
		$data['author'] = $this->Author_model->get_by_id($id)->row();
	
		/* LOAD VIEW */
		$this->load->view('authorView', $data);
	}
	
	function update($id)
	{
		/* SET VALIDATION PROPERTIES */
		$this->_set_rules();
	
		/* PREFILL FORM VALUES */
		$author = $this->Author_model->get_by_id($id)->row();
		$this->form_data->id = $id;
		$this->form_data->last_name = strtoupper($author->last_name);
		$this->form_data->first_name = $author->first_name;
	
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Update author';
		$data['message'] = '';
		$data['action'] = site_url('author/updateAuthor');
		$data['link_back'] = anchor('author/index/','Back to list of authors',array('class'=>'back'));
	
		/* LOAD VIEW */
		$this->load->view('authorEdit', $data);
	}
	
	function updateAuthor()
	{
		/* SET COMMON PROPERTIES */
		$data['title'] = 'Update author';
		$data['action'] = site_url('author/updateAuthor');
		$data['link_back'] = anchor('author/index/','Back to list of authors',array('class'=>'back'));
	
		/* SET EMPTY DEFAULT FROM FIELD VALUES */
		$this->_set_fields();
		
		/* SET VALIDATION PROPERTIES */
		$this->_set_rules();
	
		/* RUN VALIDATION */
		if ($this->form_validation->run() == FALSE)
		{
			$data['message'] = '';
		}
		else
		{
			/* SAVE DATA */
			$id = $this->input->post('id');
			$author = array('last_name' => $this->input->post('last_name'),
					'first_name' => $this->input->post('first_name'));
			$this->Author_model->update($id, $author);
				
			/* SET USER MESSAGE */
			$data['message'] = '<div class="success">update author success</div>';
		}
	
		/* LOAD VIEW */
		$this->load->view('authorEdit', $data);
	}
	
	function delete($id)
	{
		/* DELETE AUTHOR */
		$this->Author_model->delete($id);
	
		/* REDIRECT TO AUTHOR LIST PAGE */
		redirect('author/index/','refresh');
	}
	
	/* SET EMPTY DEFAULT FROM FIELD VALUES */
	function _set_fields()
	{
		$this->form_data->id = '';
		$this->form_data->last_name = '';
		$this->form_data->first_name = '';
	}
	
	/* VALIDATION RULES */
	function _set_rules()
	{
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
	
		$this->form_validation->set_message('required', '* required');
		$this->form_validation->set_message('isset', '* required');
		$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
	}
	
}
?>