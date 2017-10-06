
<div class="jumbotron">
<h2> Elegant ORM - Chaining Relation Functions</h2>
<p> Another exmample of the manyToMany Function chaining with a where clause.  One author can write many books  the specific books he or she writes is determined by chaining with a where clause</p> 

<p> The Elegant ORM code snippet required for these results: </p> 
<code>
	$result = $this->manyToMany('books','books_authors','author_id','book_id')->where('author_name','=',$author)->get()
</code>

<?php 
	echo '<h4> Author '. $books_by_author[0]['author_name']. '</h4>';
?>
	<ul>
<?php	
	foreach ($books_by_author as $book_by_author ) 
	{ 
?>
		<li> <?php echo $book_by_author['title']; ?> </li>
<?php 
	}
?>
	</ul>
</div>