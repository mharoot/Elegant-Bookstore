
<h1> Elegant ORM </h1>
<h2> Relation Functions</h2>
<h3> Another exmample of the manyToMany Function chaining with a where clause</h3>
<p> One author can write many books  the specific books he or she writes is determined by chaining with a where clause</p> 

<p> The Elegant ORM code snippet required for these results: </p> 
<code>
	$result = $this->manyToMany('books','books_authors','author_id','book_id')->where('author_name','=',$author)->get()
</code>
<?php 
	echo '<h4> Author '. $books_by_author[0]['author_name']. '</h4>';
	foreach ($books_by_author as $book_by_author ) 
	{ 
?>
		<p> <?php echo $book_by_author['title']; ?> <p>
<?php 
	}
?>