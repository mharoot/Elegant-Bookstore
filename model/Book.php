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
		$books = $this->manyToMany('authors','books_authors','book_id','author_id')->get(array('author_name', 'description', 'title'));
		
		$result = array();
		
		foreach ($books as $book)
		{
			$key = $book['title'];
			// ["book_id"]=> string(1) "1" ["title"]=> string(27) "The Algorithm Design Manual" ["description"]=> 

			//$book['title']
			//$book['author_name']
			//$book['description']
		
			if (!isset($result[$key]))
			{
				$result[$key] = array();
				array_push( $result[$key], 
					[
						'title'   => $book['title'],
						'authors' => array($book['author_name']),
						'description' => $book['description']
					]
				);

			} 
			else // collison tac on to authors array
			{

				array_push($result[$key][0]['authors'], $book['author_name']);

			}
			
		}
		
		
		
		return $result;

		
	}
	
	public function getBook($title)
	{
		return $result = $this->oneToOne('genres','genre_id','id')->manyToMany('authors', 'books_authors','book_id','author_id')->where('title', '=', $title)->get();   
	}
	
	
}

?>