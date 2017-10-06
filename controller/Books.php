<?php
/*
include_once("model/Book.php");
class Books {
	public $model;
	
	public function __construct()  
    {  
        $this->model = new Book();

    } 
	
	public function invoke()
	{
		if (!isset($_GET['book']) && !isset($_GET['author']))
		{
			// no special book is requested, we'll show a list of all available books
			$books = $this->model->getBookList();
			include 'view/templates/header.php';
			include 'view/pages/booklist.php';
			include 'view/templates/footer.php';
		}
		if(isset($_GET['book']))
		{
			// show the requested book
			$book = $this->model->getBook($_GET['book']);
			include 'view/templates/header.php';
			include 'view/pages/viewbook.php';
			include 'view/templates/footer.php';
		}


		
	}
}
*/
?>