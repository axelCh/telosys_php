<?php
namespace \Telosys\Bookstore\Php\Eo; 

/* PHP class for entity table BOOK_ORDER	 */

class BookOrder
{
	/* ENTITY PRIMARY KEY */
	private $id; 
	
	/* ENTITY FIELDS */
	private $date;
	private $state;
	private $customerCode;
	private $shopCode;
	private $employeeCode;
	private $discount;
	private $totalPrice;
	
	/* CONSTRUCTOR */	
	public function __construct()
	{
		settype($id, 'int');
		settype($date, 'int');
		settype($state, 'string');
		settype($customerCode, 'string');
		settype($shopCode, 'string');
		settype($employeeCode, 'string');
		settype($discount, 'int');
		settype($totalPrice, 'float');
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
		$format = '%c | %c | %s | %s | %s | %s | %c | %f';
		return sprintf(
				$format,
				$this->id,
				$this->date,
				$this->state,
				$this->customerCode,
				$this->shopCode,
				$this->employeeCode,
				$this->discount,
				$this->totalPrice);
	}
}
