<h1> Elegant ORM </h1>
<h2> Relation Functions</h2>
<h3> Chaining oneToOne with manyToMany with a where clause </h3>
<p> The Elegant ORM code snippet required for these results: </p> 
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