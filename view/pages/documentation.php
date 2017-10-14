<div id ="jumbotron">
<article>
<h1>Elegant: Getting Started</h1>
<ul>
    <li><a href="#introduction">Introduction</a></li>
    <li><a href="#database-configuration">Database Configuration</a></li>
    <li><a href="#defining-models">Defining Models</a>
        <ul>
            <li><a href="#Elegant-model-conventions">Elegant Model Conventions</a></li>
        </ul>
    </li>
    <li><a href="#retrieving-models">Retrieving Models</a>
        <ul>
            <li><a href="#array-of-associative-arrays">Array of Associative Arrays</a></li>
        </ul>
    </li>
</ul>



<!-- introduction -->
<p><a name="introduction"></a></p>
<h2><a href="#introduction">Introduction</a></h2>
<p>The Elegant ORM is adatable with any custom mvc project and is flexible enough to be use in other php 
frameworks such as, Laravel, Codeigniter, etc.  Elegant ORM provides an elegant, simple ActiveRecord implementation for working with your database. Each database table has a corresponding "Model" which is used to interact with that table. Models allow you to query for data in your tables, as well as insert new records into the table.</p>
<p>Before getting started, be sure to configure a database connection in <code class=" language-php">Elegant<span class="token operator">/</span>dbconfig<span class="token punctuation">.</span>php</code>. For more information on configuring your database, check out <a href="#database-configuration">the documentation</a>.</p>



<!-- database-configuration -->
<p><a name="database-configuration"></a></p>
<h2><a href="#database-configuration">Database Configuration</a></h2>
<p>Inside the Elegant folder, you can find the dbconfig.php file.  Set the proper configurations to use with your database. <pre>
<code class=" language-php">
<span class="token delimiter">&lt;?php</span>
    /*
        Elegant/dbconfig.php
    */
    define("DB_HOST","localhost");
    define("DB_USER","root");
    define("DB_PASS","your-password");
    define("DB_NAME","your-database-name");
</code>
</pre>
</p>



<!-- defining-models -->
<p><a name="defining-models"></a></p>
<h2><a href="#defining-models">Defining Models</a></h2>
<p>To get started, let's create an Elegant model. All Elegant models extend <code class=" language-php">Elegant<span class="token punctuation">\</span>Model</span></code> class.</p>




<!-- Elegant-model-convetions -->
<p><a name="Elegant-model-conventions"></a></p>
<h3>Elegant Model Conventions</h3>
<p>Now, let's look at an example <code class=" language-php">Book</code> model, which we will use to retrieve and store information from our <code class=" language-php">books</code> database table:</p>
<pre class=" language-php">
    <code class=" language-php"><span class="token delimiter">&lt;?php</span>
    include_once("Elegant/Model.php");

    class Book extends Model
    {
        //
    }
    ?>
    </code>
</pre>

<!-- Table Names -->
<h4>Table Names</h4>
<p>Note that we did not tell Elegant which table to use for our <code class=" language-php">Book</code> model. By convention, you should use the "snake case", plural name of the class will be used as the table name unless another name is explicitly specified. So, in this case, Elegant for our <code class=" language-php">Book</code> model stores records in the <code class=" language-php">books</code> table. You may specify a custom table by defining a <code class=" language-php">table</code> property on your model.  You may <b>not</b> leave it empty.  It is mandatory to give a table name as done below in the following code snippet:</p>
<pre class=" language-php">
    <code class="language-php"><span class="token delimiter">&lt;?php</span>
    include_once("Elegant/Model.php");

    class Book extends Model
    {
        public __construct() 
        {
            /**
            * The table name associated with the model.
            *
            * @var string
            */
            $this->table_name = 'books';
        }
    }
    ?>
    </code>
</pre>
<!-- retrieving models -->
<p><a name="retrieving-models"></a></p>
<h2><a href="#retrieving-models">Retrieving Models</a></h2>


<!-- Adding Additional Constraints-->
<p><a name="adding-additional-constraints"></a></p>
<h4>Adding Additional Constraints</h4>
<p>The Elegant <code class=" language-php">all</code> method will return all of the results in the model's table. Since each Elegant model serves as a <a href="./?query-builder">query builder</a>, you may also add constraints to queries, and then use the <code class=" language-php">get</code> method to retrieve the results:</p>
<pre class=" language-php">
    <code class=" language-php">
    $book_model  = new Book();

    $books       = $book_model->where('active', '=', '1')
                   ->orWhere('title', '=', 'Harry Potter')
                   ->orderBy('name', 'desc')
                   ->take(10)
                   ->get();
    </code>
</pre>
Since Elegant models are query builders, you should review all of the methods available on the <a href="./?query-builder">query builder</a>. You may use any of these methods in your Elegant queries.</p>

<!-- Adding Additional Constraints-->
<p><a name="array-of-associative-arrays"></a></p>
<h3>Array of Associate Arrays</h3>
<p>For Elegant methods like <code class=" language-php">all</code> and <code class=" language-php">get</code> which retrieve multiple results are stored in <code class=" language-php">Array</code> where each row can be reached by an integer index.  Within each row an <code class=" language-php">Associative Array</code> holds the key as the column name where it holds each columns value that will be returned. The following code snippet is an example for working with your Elegant results:</p>

<pre class=" language-php">
    <code class=" language-php">
    /*    in controller    */
    $this->book_model = new Book();
    $books = $this->book_model->getBookList();
    include 'view/templates/header.php';
    include 'view/pages/booklist.php';
    include 'view/templates/footer.php';

    /*    in view    */
    for ($row = 0; $row < count(books); $row++) {
        echo $book[$row]['title'];
    }

    </code>
</pre>
<p>Of course, you may also simply loop over the Array of Associate Arrays as in the following code snippet:</p>
<pre class=" language-php">
    <code class=" language-php">
    /*    in view    */
    foreach($books as $book) {
        echo $book['title'];
    }
    </code>
</pre>



</article>
</div>