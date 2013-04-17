<?php

class Author_model extends CI_Model
{
	/* ENTITY PRIMARY KEY */
	private $id;

	/* ENTITY FIELDS */
	private $lastName;
	private $firstName;

	/* CONSTRUCTOR */
	public function __construct()
	{
		parent::__construct();
		settype($id, 'int');
		settype($lastName, 'string');
		settype($firstName, 'string');
	}

	/* GETTER & SETTER FOR FIELDS AND THE KEY FIELD */
	public function __set($name, $value)
	{
		$this->$name = $value;
	}
	public function __get($name)
	{
		return $this->$name;
	}
	public function insert()
	{
		$data = array(
				'last_name' => $this->lastName,
				'first_name' => $this->firstName
		);
		
		$this->db->insert('author', $data);
	}
	public function update()
	{
		$data = array(
               'last_name' => $this->lastName,
               'first_name' => $this->firstName
            );

		$this->db->where('id', $this->$id);
		$this->db->update('author', $data);
	}
	public function __toString()
	{
		$format = '%c | %s | %s';
		return sprintf($format, $this->id, $this->lastName, $this->firstName);
	}
}
?>