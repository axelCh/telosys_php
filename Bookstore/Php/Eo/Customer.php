<?php
namespace \Telosys\Bookstore\Php\Eo; 

/* PHP class for entity table CUSTOMER */

class Customer
{
	/* ENTITY PRIMARY KEY */
	private $code; 
	
	/* ENTITY FIELDS */
	private $lastName;
	private $firstName;
	private $age;
	private $email;
	private $phone;
	private $login;
	private $password;

	/* CONSTRUCTOR */	
	public function __construct()
	{
		settype($code, 'string');
		settype($lastName, 'string');
		settype($firstName, 'string');
		settype($age, 'int');
		settype($email, 'string');
		settype($phone, 'string');
		settype($login, 'string');
		settype($password, 'string');
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
		$format = '%s | %s | %s | %c | %s | %s | %s | %s';
		return sprintf(
				$format,
				$this->code,
				$this->lastName,
				$this->firstName,
				$this->age,
				$this->email,
				$this->phone,
				$this->login,
				$this->password);
	}
}
