<?php
namespace \Telosys\Bookstore\Php\Eo; 

/* PHP class for entity table COUNTRY*/

class Country
{
	/* ENTITY PRIMARY KEY */
	private $code; 
	
	/* ENTITY FIELDS */
	private $name;

	/* CONSTRUCTOR */	
	public function __construct()
	{
		settype($code, 'string');
		settype($name, 'string');
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
		$format = '%s | %s';
		return sprintf($format, $this->code, $this->name);
	}
}
