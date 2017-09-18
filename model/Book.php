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
		return $this->all();
	}
	
	public function getBook($title)
	{
		// $q = "SELECT * FROM books WHERE title = '".$title."'";
		// $this->query($q);
		// $result = $this->resultset();
		// return $result[0];

        //book has a one to one relationship with genres
		//where books.genre = genre.id

		/*
		--working relations--
		1. 
		return $this->oneToOne('genres','genre','id')->get(array('title', 'description', 'author', 'genre_name'));

		2.
		return $this->oneToOne('genres','genre','id')->get();
		
		--working where and orWhere--
		3.
		return $this->where('title', '=', $title )->orWhere('id','=',2)->get();

		4. 
		return $this->where('title', '=', $title )->orWhere('id','=',2)->get(array('title', 'description', 'author', 'genre'));
		*/
        
	}
	
	
}

?>