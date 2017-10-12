<?php
/*

SUPER CONTROLLER WE ARE NO LONGER USING SEPERATE CONTROLLER FILES.

ALL GET, PUT, DELETE, POST calls go through here for the website
*/

include_once("model/Book.php");
include_once("model/Author.php");

class Controller {
	public $book_model;
	public $author_model;
	public $getRequests = ['author', 'book', 'uml'];
	
	public function __construct()  
    {  
        $this->book_model = new Book();
        $this->author_model = new Author();

    } 
	
	public function invoke()
	{
		$noGetRequests = TRUE;

		for ($i = 0; $i < count($this->getRequests); $i++)
		{
			
			if ( isset($_GET[$this->getRequests[$i]]) )
			{
				$noGetRequests = FALSE;
			}
		}

		if($noGetRequests)
		{
			// no special book is requested, we'll show a list of all available books
			$books = $this->book_model->getBookList();
			include 'view/templates/header.php';
			include 'view/pages/booklist.php';
			include 'view/templates/footer.php';
		}

		if(isset($_GET['book']))
		{
			// show the requested book
			$book = $this->book_model->getBook($_GET['book']);
			include 'view/templates/header.php';
			include 'view/pages/viewbook.php';
			include 'view/templates/footer.php';
		}

		if (isset($_GET['author']))
		{
			// no special book is requested, we'll show a list of all available books
			$books_by_author = $this->author_model->getBooksByAuthor($_GET['author']);
			include 'view/templates/header.php';
			include 'view/pages/authorsbooks.php';
			include 'view/templates/footer.php';
		}

		if (isset($_GET['uml']))
		{
			include 'view/templates/header.php';
			include 'UML.html';
			include 'view/templates/footer.php';
		}

		
	}
}

?>