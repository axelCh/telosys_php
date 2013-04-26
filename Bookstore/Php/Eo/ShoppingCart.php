<?php
namespace \Telosys\Bookstore\Php\Eo; 

/* PHP class for entity table SHOPPING_CART */

class ShoppingCart
{
	/* ENTITY PRIMARY KEY */
	private $bookOrderID; 
	
	/* ENTITY FIELDS */
	private $bookID;
	private $quantity;
	private $price;

	/* CONSTRUCTOR */	
	public function __construct()
	{
		settype($bookOrderID, 'int');
		settype($bookID, 'int');
		settype($quantity, 'int');
		settype($price, 'float');
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
		$format = '%c | %c | %c | %f';
		return sprintf(
				$format,
				$this->bookOrderID,
				$this->bookID,
				$this->quantity,
				$this->price);
	}
}
