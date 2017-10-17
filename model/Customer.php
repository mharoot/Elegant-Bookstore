<?php
declare(strict_types=1);

include_once("Elegant/Model.php");

class Customer extends Model {


	/* 
		Every instance of a model should have properties like table_name, primary key, etc;
		Before the parent::__construct().
	*/
	public function __construct()  
	{  
			// by convention Elegant assumes the model representing the table in the database is all lower case and plural
			parent::__construct();

	}

	
}

?>