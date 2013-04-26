<?php
namespace \Telosys\Bookstore\Php\Eo; 

/* PHP class for entity table PUBLISHER_ADDRESS_LIST */

class PublisherAddressList
{
	/* ENTITY PRIMARY KEY */
	private $publisherCode; 
	
	/* ENTITY FIELDS */
	private $addressCode;

	/* CONSTRUCTOR */
	public function __construct()
	{
		settype($publisherCode, 'int');
		settype($addressCode, 'string');
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
		$format = '%c | %s';
		return sprintf($format, $this->publisherCode, $this->addressCode);
	}
}
