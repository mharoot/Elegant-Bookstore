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
    public $_routes = ['author', 'book', 'uml', 'documentation', 'query-builder', 'update-viewbook', '_method', 'deleteBookByTitle', 'deleteBookByTitleButton'];
    
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
            
            if ( isset($_GET[$this->_routes[$i]]) || isset($_POST[$this->_routes[$i]]) )
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

            $this->putAndDeleteRequestHandler();         
        }

    }

    private function putAndDeleteRequestHandler()
    {
        if ( !isset($_POST['_method']) )
        {
            return 0;
        }
        



        $request_method = $_POST['_method'];




        /**********************************************************************
                                     PUT REQUESTS
// in viewbook.php
<form method="POST">
<table class="table table-hover">
	<thead>
      <tr>
        <th>Title</th>
        <th>Author(s)</th>
        <th>Description</th>
        <th>Genre</th>
      </tr>
    </thead>
    <tr>

<?php 

	$authors = '';
	foreach ($book as $b ) 
	{	
		//building the list of author(s)
		//<a href="index.php?author=Steven S. Skiena">Steven S. Skiena</a>
		$authors .= '<li><a href="index.php?author='.$b['author_name'].'">'.$b['author_name'].'</a> </li>';
	}
?>
	<td>      <?php echo $book[0]['title'];?> </td>
	<td> <ul> <?php echo $authors; ?>    <ul> </td>
	<td> 
		<textarea name="book_description"> 
			<?php echo $book[0]['description']; ?> 
		</textarea> 
	</td>
	<td> <?php echo $book[0]['genre_name']; ?> </td>

	</tr>
</table>
<input name="_method" type="hidden" value="PUT">
<input type="submit" value="Update" name="update-viewbook"/>
</form>
        ***********************************************************************/
        if ( $request_method === 'PUT')
        {
            if ( isset($_POST['update-viewbook']) )
            { // the form's submit button was pressed

                if(isset($_POST['book_description']))
                {
                    //$this->book_model->where('title','=',$_GET['book'])->update(['description'=>$_POST['book_description']]);//no longer works update is private
                    $this->book_model->description = $_POST['book_description'];
                    $this->book_model->where('title','=',$_GET['book'])->save();
                }
                $book = $this->book_model->getBook($_GET['book']);
                include 'view/templates/header.php';
                include 'view/pages/viewbook.php';
                include 'view/templates/footer.php';
            }
        } // @end PUT



        /**********************************************************************
                                     DELETE REQUESTS

        // in booklist.php
        1. be sure form is using POST, no action required by the forms. 
        2. be sure to include the hidden field
            <input name="_method" type="hidden" value="PUT">
        3. be sure to include a delete button
            <input type="submit" value="Delete" name="deleteBookByTitleButton"/>
        ***********************************************************************/
        else if( $request_method === 'DELETE')
        {
            if ( isset($_POST['deleteBookByTitleButton']) ) //  was pressed in booklist.php
            { 

                $bookToRemoveTitle = $_POST['deleteBookByTitle'];
                
            }

        }// @end DELETE






    } // @end putAndDeleteRequestHandler()
}

?>