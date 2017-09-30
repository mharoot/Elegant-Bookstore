<?php
declare(strict_types=1);

include_once("Elegant/Model.php");

class Book extends Model {



	public function __construct()  
	{  
			parent::__construct();
			$this->table_name = 'books';
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