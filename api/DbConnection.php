<?php 
/**
 * 
 */
class DbConnection 
{
	private $hotDb = "localhost";
	private $userDb = "root";
	private $passDb = "";
	private $nameDb = "employees_time_management";
	public $pdo;
	function __construct()
	{
		if(!isset($this->pdo)){

			try {
			  $link = new PDO("mysql:host=".$this->hotDb.";dbname=".$this->nameDb, $this->userDb, $this->passDb);
			  // set the PDO error mode to exception
			  $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			  $link->exec("SET CHARACTER SET utf8");
			  $this->pdo = $link;
			  
			} catch(PDOException $e) {
			  echo "Connection failed: " . $e->getMessage();
			}

		}
		
	}
}


?>