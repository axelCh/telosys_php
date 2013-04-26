<?php
namespace \Telosys\Bookstore\Php\Eo; 

/* PHP class for entity table SHOP */

class Shop
{
	/* ENTITY PRIMARY KEY */
	private $code; 
	
	/* ENTITY FIELDS */
	private $name;
	private $email;
	private $phone;
	private $executive;

	/* CONSTRUCTOR */	
	public function __construct()
	{
		settype($code, 'string');
		settype($name, 'string');
		settype($email, 'string');
		settype($phone, 'string');
		settype($executive, 'string');
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
		$format = '%s | %s | %s | %s | %s';
		return sprintf(
				$format,
				$this->code,
				$this->name,
				$this->email,
				$this->phone,
				$this->executive);
	}
}
