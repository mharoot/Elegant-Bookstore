<?php
declare(strict_types=1);

include_once("Elegant/Model.php");

class Book extends Model {


	/* 
		Every instance of a model should have properties like table_name, primary key, etc;
		Before the parent::__construct().
	*/
	public function __construct()  
	{  
			$this->table_name = 'books';
			parent::__construct();

	}



	public function getBookList()
	{
		return $this->manyToMany('authors','books_authors','book_id','author_id')->get();
	}
	
	public function getBook($title)
	{
		return $this->oneToOne('genres','genre_id','id')->where('title', '=', $title)->get();   
	}
	
	
}

?>