<?php   
ini_set('display_errors',1);
 error_reporting(E_ALL); 

 ?>
<h1> Elegant ORM </h1>
<h2> Relation Functions</h1>
<h3> manyToMany Function</h3>
<p> A book can have many authors, and an author can write many books </p>
<p> The Elegant ORM code snippet required for these results: </p> 
<code> $books = $this->manyToMany('authors','books_authors','book_id','author_id')->get(array('author_name', 'description', 'title')); </code>
<table class="table table-hover">
	<thead>
      <tr>
        <th>Title</th>
        <th>Author</th>
        <th>Description</th>
      </tr>
    </thead>
	<?php 

		foreach ($books as $book)
		{
			$row = '<tr><td><a href="index.php?book='.$book[0]['title'].'">'.$book[0]['title'].'</a></td><td>';
			
			foreach ($book[0]['authors'] as $author) {
				$row .= '<a href="index.php?author='.$author.'">'.$author.'</a></br>';
			}

			$row .= '</td><td>'.$book[0]['description'].'</td></tr>';
			echo $row;
			
		}

	?>
</table>
<?php

//print_r($books);
// print_r($books[0]);
// echo "</br>";
// print_r($books[0]['id']);
// echo "</br>";
// print_r($books[0]['title']);
// echo "</br>";
// echo "</br>";
// print_r($books[1]);


?>