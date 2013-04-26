<?php
namespace \Telosys\Bookstore\Php\Eo; 

/* PHP class for entity table CUSTOMER_ADDRESS_LIST */

class CustomerAddressList
{
	/* ENTITY PRIMARY KEY */
	private $customerCode; 
	
	/* ENTITY FIELDS */
	private $addressCode;

	/* CONSTRUCTOR */	
	public function __construct()
	{
		settype($customerCode, 'string');
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
		$format = '%s | %s';
		return sprintf($format, $this->customerCode, $this->addressCode);
	}
}
