<?php
namespace \Telosys\Bookstore\Php\Eo; 

/* PHP class for entity table CITY */

class City
{
	/* ENTITY PRIMARY KEY */
	private $zipCode; 
	
	/* ENTITY FIELDS */
	private $optionalPlus4;
	private $name;
	private $countryCode;

	/* CONSTRUCTOR */	
	public function __construct()
	{
		settype($zipCode, 'int');
		settype($optionalPlus4, 'int');
		settype($name, 'string');
		settype($countryCode, 'string');
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
		$format = '%c | %c | %s | %s';
		return sprintf(
				$format,
				$this->zipCode,
				$this->optionalPlus4,
				$this->name,
				$this->countryCode);
	}
}
