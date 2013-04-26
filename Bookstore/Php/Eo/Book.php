<?php
namespace \Telosys\Bookstore\Php\Eo; 

/* PHP class for entity table BOOK	 */

class Book
{
	/* ENTITY PRIMARY KEY */
	private $id; 
	
	/* ENTITY FIELDS */
	private $isbn;
	private $title;
	private $synopsis;
	private $authorID;
	private $publisherCode;
	private $cover;
	private $bestSeller;
	private $availability;
	private $price;
	private $specialOffer;
	
	/* CONSTRUCTOR */	
	public function __construct()
	{
		settype($id, 'int');
		settype($isbn, 'string');
		settype($title, 'string');
		settype($authorID, 'int');
		settype($publisherCode, 'int');
		settype($cover, 'null');
		settype($bestSeller, 'bool');
		settype($availability, 'int');
		settype($price, 'float');
		settype($specialOffer, 'float');
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
		$format = '%c | %s | %s | %c | %c | %c | %f | %f';
		return sprintf(
				$format,
				$this->id,
				$this->isbn,
				$this->title,
				$this->authorID,
				$this->publisherCode,
				$this->availability,
				$this->price,
				$this->specialOffer);
	}
}
