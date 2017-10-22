<?php
declare(strict_types=1);

include_once("Elegant/Model.php");

class Author extends Model {


	/* 
		Every instance of a model should have properties like table_name, primary key, etc;
		Before the parent::__construct().
	*/
	public function __construct()  
	{  
			$this->table_name = 'authors';
			parent::__construct($this);

	}



	
	public function getBooksByAuthor($author)
	{
		 return $result = $this->manyToMany('books','books_authors','author_id','book_id')->where('author_name','=',$author)->get();
	}
	
	
}

?>