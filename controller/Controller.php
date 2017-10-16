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
    public $_routes = ['author', 'book', 'uml', 'documentation', 'query-builder', 'update-viewbook'];
    
    public function __construct()  
   {  
       $this->book_model = new Book();
       $this->author_model = new Author();

   }
    
    public function invoke()
    {
        $noRequests = TRUE;

        for ($i = 0; $i < count($this->_routes); $i++)
        {
            
            if ( isset($_GET[$this->_routes[$i]]) )
            {
                $noRequests = FALSE;
            }
        }

        if($noRequests)
        {
            // no special book is requested, we'll show a list of all available books
            $books = $this->book_model->getBookList();
            include 'view/templates/header.php';
            include 'view/pages/booklist.php';
            include 'view/templates/footer.php';
        }

        $this->getRequestHandler();
        $this->postRequestHandler();




        
    }

    private function getRequestHandler()
    {
        if($_SERVER['REQUEST_METHOD'] == 'GET')
        {
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

            if (isset($_GET['documentation']))
            {
                include 'view/templates/header.php';
                include 'view/pages/documentation.php';
                include 'view/templates/footer.php';
            }

            if (isset($_GET['query-builder']))
            {
                include 'view/templates/header.php';
                include 'view/pages/query-builder.php';
                include 'view/templates/footer.php';
            }

        }
    }

    private function postRequestHandler()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if ( isset($_POST['update-viewbook']) )
            { // the form's submit button was pressed

        		if(isset($_POST['book_description']))
        		{
        			$this->book_model->where('title','=',$_GET['book'])->update(['description'=>$_POST['book_description']]);
        		}
                $book = $this->book_model->getBook($_GET['book']);
                include 'view/templates/header.php';
                include 'view/pages/viewbook.php';
                include 'view/templates/footer.php';
            }            
        }

    }
}

?>