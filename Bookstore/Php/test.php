<?php
namespace Telosys\Bookstore\Php;
require './Dao/DaoAuthor.php';

$a = new namespace \Dao\DaoAuthor('mysql:host=localhost;port=3306;dbname=telosys_bookstore', 'root', '');
$d = 0;