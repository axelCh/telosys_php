<?php
namespace \Telosys\Bookstore\Php\Eo; 

/* PHP class for entity table AUTHOR */

class Author
{
	/* ENTITY PRIMARY KEY */
	private $id; 
	
	/* ENTITY FIELDS */
	private $lastName;
	private $firstName;

	/* CONSTRUCTOR */	
	public function __construct()
	{
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
	
	public function __toString()
	{
		$format = '%c | %s | %s';
		return sprintf($format, $this->id, $this->lastName, $this->firstName);
	}
}
