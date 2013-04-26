<?php
namespace \Telosys\Bookstore\Php\Eo; 

/* PHP class for entity table EMPLOYEE */

class Employee
{
	/* ENTITY PRIMARY KEY */
	private $code; 
	
	/* ENTITY FIELDS */
	private $lastName;
	private $firstName;
	private $manager;
	private $shopCode;

	/* CONSTRUCTOR */	
	public function __construct()
	{
		settype($code, 'string');
		settype($lastName, 'string');
		settype($firstName, 'string');
		settype($manager, 'int');
		settype($shopCode, 'string');
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
				$this->lastName,
				$this->firstName,
				$this->manager,
				$this->shopCode);
	}
}
