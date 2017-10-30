<div class="jumbotron">
<h2> Elegant ORM - One to One and Many to Many Relation Chaining</h2>
<p> In this particular example there is a chaining of the oneToOne function with the manyToMany function. We also chain it with a call to the where function.  Lastly we call get to retrieve the results. The Elegant ORM code snippet required for these results: </p> 
<pre class="CodeFlask__pre  language-php"><p><code class="CodeFlask__code  language-php"><span class="token variable">$title</span>  <span class="token operator">=</span> <span class="token string">'Harry Potter'</span><span class="token punctuation">;</span>
<span class="token variable">$result</span> <span class="token operator">=</span> <span class="token variable">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">oneToOne</span><span class="token punctuation">(</span><span class="token string">'genres'</span><span class="token punctuation">,</span><span class="token string">'genre_id'</span><span class="token punctuation">,</span><span class="token string">'id'</span><span class="token punctuation">)</span>
	       <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">manyToMany</span><span class="token punctuation">(</span><span class="token string">'authors'</span><span class="token punctuation">,</span> <span class="token string">'books_authors'</span><span class="token punctuation">,</span><span class="token string">'book_id'</span><span class="token punctuation">,</span><span class="token string">'author_id'</span><span class="token punctuation">)</span>
	       <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">where</span><span class="token punctuation">(</span><span class="token string">'title'</span><span class="token punctuation">,</span> <span class="token string">'='</span><span class="token punctuation">,</span> <span class="token variable">$title</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">get</span><span class="token punctuation">(</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
	</code></p></pre>
</br></br>
<img class="relationsImage" src="assets/images/OneToOneChainedManyToMany.png"></img>
</br></br>
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
		$authors .= '<li><a href="index.php?author='.$b->author_name.'">'.$b->author_name.'</a> </li>';
	}
?>
	<td>
		<p>      <?php 
					//sugesstion put logic for when a single result has been found, database has row count for queries which returns the possible count
					//that way i can decide to call wheter to call fetch or fetchALL
					foreach ($book as $b ) 
					{	
						echo $b->title;
					}
				?> 
		</p>
	</td>
	<td> <ul> <?php echo $authors; ?>    <ul> </td>
	<td> 
		</br>
		<textarea id="book_description" name="book_description"><?php echo $book[0]->description; ?></textarea>
	</td>
	<td> <p><?php echo $book[0]->genre_name; ?> </p></td>

	</tr>
</table>
	<input name="_method" type="hidden" value="PUT">
	<input class="btn btn-success" type="submit" value="Update" name="update-viewbook"/>
</form>
<br>
</div>