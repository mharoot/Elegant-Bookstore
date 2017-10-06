<div class="jumbotron">
<h2> Elegant ORM - One to One and Many to Many Relation Chaining</h2>
<p> In this particular example there is a chaining of the oneToOne function with the manyToMany function. We also chain it with a call to the where function.  Lastly we call get to retrieve the results. The Elegant ORM code snippet required for these results: </p> 
<code>
	$result = $this->oneToOne('genres','genre_id','id')->manyToMany('authors', 'books_authors','book_id','author_id')->where('title', '=', $title)->get(); 
</code>
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
		$authors .= '<li>'.$b['author_name'].' </li>';
	}

	echo '<td>' . $book[0]['title'] .'</td>';
	echo '<td> <ul>' . $authors . '<ul> </td>';
	echo '<td>' . $book[0]['description'] . '</td>';
	echo '<td>' . $book[0]['genre_name'] . '</td>';
	
?>
	</tr>
</table>
</div>