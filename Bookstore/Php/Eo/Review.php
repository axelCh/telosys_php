<?php
namespace \Telosys\Bookstore\Php\Eo; 

/* PHP class for entity table REVIEW */

class Review
{
	/* ENTITY PRIMARY KEY */
	private $customerCode; 
	
	/* ENTITY FIELDS */
	private $bookID;
	private $body;
	private $note;
	private $creationDate;
	private $lastUpdate;
	
	/* CONSTRUCTOR */	
	public function __construct()
	{
		settype($customerCode, 'string');
		settype($bookID, 'int');
		settype($body, 'string');
		settype($note, 'int');
		settype($creationDate, 'string');
		settype($lastUpdate, 'string');
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
		$format = '%s | %c | %s | %c | %s | %s';
		return sprintf(
				$format,
				$this->customerCode,
				$this->bookID,
				$this->body,
				$this->note,
				$this->creationDate,
				$this->lastUpdate);
	}
}
