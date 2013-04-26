<?php
namespace \Telosys\Bookstore\Php\Eo; 

/* PHP class for entity table ADDRESS */

class Address
{
	/* ENTITY PRIMARY KEY */
	private $code; 
	
	/* ENTITY FIELDS */
	private $addressLigne1;
	private $addressLigne2;
	private $cityZipCode;
	private $countryCode;

	/* CONSTRUCTOR */	
	public function __construct()
	{
		settype($code, 'string');
		settype($addressLigne1, 'string');
		settype($addressLigne2, 'string');
		settype($cityZipCode, 'int');
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
		$format = '%s | %s | %s | %c | %s';
		return sprintf(
				$format, 
				$this->code,
				$this->addressLigne1,
				$this->addressLigne2,
				$this->cityZipCode,
				$this->countryCode);
	}
}
