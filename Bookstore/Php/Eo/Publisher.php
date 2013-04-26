<?php
namespace \Telosys\Bookstore\Php\Eo; 

/* PHP class for entity table PUBLISHER */

class Publisher
{
	/* ENTITY PRIMARY KEY */
	private $code; 
	
	/* ENTITY FIELDS */
	private $name;
	private $email;
	private $phone;
	private $contact;

	/* CONSTRUCTOR */	
	public function __construct()
	{
		settype($code, 'int');
		settype($name, 'string');
		settype($email, 'string');
		settype($phone, 'string');
		settype($contact, 'string');
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
		$format = '%c | %s | %s | %s | %s';
		return sprintf(
				$format,
				$this->code,
				$this->name,
				$this->email,
				$this->phone,
				$this->contact);
	}
}
