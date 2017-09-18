<?php
 ini_set('display_errors',1);
 error_reporting(E_ALL);
class Database {
	private $host       = 'localhost';
	private $user       = 'root';
	private $password   = 'password';
	private $database   = 'mvc';

	private $connection = null;
	private $error = null;
	
	private $stmt = null;

	function __construct() {
		$conn = $this->connectDB();
		$this->connection = $conn;
	}
	

	private function connectDB() {
		if($this->connection!=null)
		{
			return $this->connection;
		}

		 //Set DSN
		 $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->database. ';charset=utf8';
		 // Set options
		$options = array(
		PDO::ATTR_PERSISTENT => false, 
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		);

        // Create a new PDO instanace
        try{
            $this->connection = new PDO($dsn, $this->user, $this->password, $options);
        }
        // Catch any errors
        catch(PDOException $e){
            $this->error = $e->getMessage();
        }

		return $this->connection;
	}

	public function query($query){
		if($this->connection!=null)
    	$this->stmt = $this->connection->prepare($query);
		else
		 return;
	}

	public function bind($param, $value, $type = null)
	{
		if (is_null($type)) {
			switch (true) {
				case is_int($value):
				$type = PDO::PARAM_INT;
				break;
				case is_bool($value):
				$type = PDO::PARAM_BOOL;
				break;
				case is_null($value):
				$type = PDO::PARAM_NULL;
				break;
				default:
				$type = PDO::PARAM_STR;
			}
		}
		$this->stmt->bindValue($param, $value, $type);
	}

    /* if your using CUD operationgs: only creating, updating, or deleting you just call execute */
	public function execute(){
		if($this->stmt!=null)
		return $this->stmt->execute();
		else
		 return;
	}

    /*
    use if returning more than 1 row returned as an associative array
    */
	public function resultset(){
		$this->execute();
		return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
	}

    /*
    use if returning only 1 row returned as an associative array
    */
	public function single(){
		$this->execute();
		return $this->stmt->fetch(PDO::FETCH_ASSOC);
	}

    /*
    can use for 1 or more returned as an array
    */
	public function fetchObj(){
		$this->execute();
		return $this->stmt->fetch(PDO::FETCH_OBJ);
	}
	
	public function rowCount(){
		return $this->stmt->rowCount();
	}

	public function lastInsertId(){
		return $this->connection->lastInsertId();
	}

}
?>