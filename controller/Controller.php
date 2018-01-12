<?php
/*

SUPER CONTROLLER WE ARE NO LONGER USING SEPERATE CONTROLLER FILES.

ALL GET, PUT, DELETE, POST calls go through here for the website
*/

include_once("model/Book.php");
include_once("model/Author.php");
include_once("model/Customer.php");
include_once("model/Order.php");
class Controller {
    public $book_model;
    public $author_model;
    public $customer_model;
    public $order_model;
    public $_routes = ['author', 'book', 'uml', 'documentation', 'query-builder', 'update-viewbook', '_method', 'deleteBookByTitle', 'deleteBookByTitleButton', 'resetBooks', 'customerslist', 'insert-customer', 'home-page', 'sign-up'];
    
    public function __construct()  
   {  
    if( $this->book_model !=null)
    {
        return;
    }
       $this->book_model = new Book();
       $this->author_model = new Author();
       $this->customer_model = new Customer();
       $this->order_model = new Order();

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

            if (isset($_GET['customerslist']))
            {
                $foreign_table  = 'orders';
                $pk             = 'id'; //customers table id
                $fk             = 'customer_id';
                $customers = $this->customer_model->oneToMany($foreign_table, $pk , $fk)->get();

                include 'view/templates/header.php';
                include 'view/pages/customerslist.php';
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

            if (isset($_GET['home-page']))
            {
                $books = $this->book_model->getBookList();
                include 'view/pages/homepage.php';
                
            }

            if (isset($_GET['sign-up']))
            {
                
                include 'view/pages/signup.php';
                
            }
        }
    }

    private function postRequestHandler()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {

            if (isset($_POST['resetBooks']))
            {
                include_once('Elegant/Database.php');
                $db_handler = new Database();
                $q = file_get_contents('sql/resetBooks.sql');
                $db_handler->query($q);
                $db_handler->execute();
                $this->redirect();

            }

            if(isset($_POST['insert-customer']))
           {
            
               $name = $_POST['customerName'];
               $address = $_POST['customerAddress'];
               $amount = $_POST['orderAmount'];

               $result = $this->customer_model->where('address','=',$address)->where('name','=',$name)->get();

               if($result == NULL)
               {

                    $this->customer_model->name = $name;
                    $this->customer_model->address = $address;
                    $this->customer_model->save();
                    $this->order_model->amount = $amount;
                    $this->order_model->customer_id = $this->customer_model->lastInsertId();
                    $this->order_model->save();
               }else{
                
                    $this->order_model->amount = $amount;
                    $this->order_model->customer_id = $result[0]->id;
                    $this->order_model->save();
               }
               $this->redirect();

           }

           if( isset($_POST['user']) && isset($_POST['pass']) && isset($_POST['pass2']))
           {
               $name = $_POST['user'];
               $password = $_POST['pass'];
               $password2 = $_POST['pass2'];

                if  ($password == $password2)
                {
                   $this->customer_model->name = $name;
                   $this->customer_model->pass = $password;
                   $this->customer_model->save();
                   //$this->redirect();
                   echo "<script> location.href='./?sign-up&status=correct'; </script>";
                   //exit;
                   
               }
               else
               {
                   //$this->redirect("view/booklist.php");
                   echo "<script> location.href='./?sign-up&status=incorrect'; </script>";
               }
               
           }

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
            <input name="_method" type="hidden" value="DELETE">
        3. be sure to include a delete button
            <input type="submit" value="Delete" name="deleteBookByTitleButton"/>
            <input name="deleteBookByTitle" value="<?php echo ; ?>"/>
        ***********************************************************************/
        else if( $request_method === 'DELETE')
        {
            if ( isset($_POST['deleteBookByTitleButton']) ) //  was pressed in booklist.php
            { 

                $bookToRemoveTitle = $_POST['deleteBookByTitle'];
                $this->book_model->deleteByTitle($bookToRemoveTitle);
                //$_SERVER['SERVER_PORT']
                $this->redirect();
               
            }

        }// @end DELETE






    } // @end putAndDeleteRequestHandler()

    private function redirect() 
    {
        ob_start();
        header('Location: '. $this->base_url());
        ob_end_flush();
        die();
    }

    private function base_url()
    {
        return 'http://'.$_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI'];
    }
}

?>