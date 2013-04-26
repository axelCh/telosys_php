<?php
namespace Telosys\Bookstore\Php\Dao;

/* PHP Data Access Object for entity tabble Author */

class DaoAuthor
{
	private $dbaccess; # PHP Data Object(PDO)
	
	/* CONSTRUCTOR */
	public function __construct($databaseSource, $userName, $passWord)
	{
		$this->dbaccess = new PDO(
							$databaseSource, 
							$userName, 
							$passWord, 
							array(PDO::ATTR_PERSISTENT => true)); # Persistent connection
	}
	
	/* DATA ACCESS */
	public function delete($AuthorID) # Delete a author by its id
	{
		$delAuthor = $dbaccess->prepare('DELETE FROM author WHERE id = :id');
		$delAuthor->bindParam(':id', $AuthorID, PDO::PARAM_INT);
		$delAuthor->execute();
	}
	
	public function insert($AuthorLastName, $AuthorFirstName) # insert a author (id will auto increment)
	{
		$inAuthor = $dbaccess->prepare('INSERT INTO author (last_name, first_name) VALUES (:lastname, :firstname)');
		$inAuthor->bindParam(':lastname', $AuthorLastName, PDO::PARAM_STR);
		$inAuthor->bindParam(':firstname', $AuthorFirstName, PDO::PARAM_STR);
		$inAuthor->execute();
	}
	
	public function load($AuthorID)
	{
		$loadAuthor = $dbaccess->prepare('SELECT FROM author WHERE id = :id');
		$loadAuthor->bindParam(':id', $AuthorID, PDO::PARAM_INT);
		$loadAuthor->execute();
		
		return $author;
	}
	
	public function save($Author)
	{
		$savAuthor = $dbaccess->prepare('INSERT INTO author (last_name, first_name) VALUES (:lastname, :firstname)');
		$savAuthor->bindParam(':lastname', $Author->lastName, PDO::PARAM_STR);
		$savAuthor->bindParam(':firstname', $Author->firstName, PDO::PARAM_STR);
		$savAuthor->execute();
		
		$savAuthor = $dbaccess->prepare('INSERT INTO author (last_name, first_name) VALUES (:lastname, :firstname)');
		$savAuthor->bindParam(':id', $Author->id, PDO::PARAM_INT);
		$savAuthor->bindParam(':lastname', $Author->lastName, PDO::PARAM_STR);
		$savAuthor->bindParam(':firstname', $Author->firstName, PDO::PARAM_STR);
		$savAuthor->execute();	
	}
}
