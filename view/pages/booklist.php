<?php   
ini_set('display_errors',1);
 error_reporting(E_ALL); 

 ?>

<div class="jumbotron">
<h2> Elegant ORM - Many to Many Relations</h2>
<p> A book can have many authors, and an author can write many books.  The Elegant ORM code snippet required for these results: </p> 


<div style="height: 5em;" class="call-to-action-wrapper">
<div style="height: 5em;" class="code-window animate fade-in">
    <div class="code-editor CodeFlask"><div class="CodeFlask__textarea"></div><pre class="CodeFlask__pre  language-php"><code class="CodeFlask__code  language-php"><span class="token variable">        $cols</span>  <span class="token operator">=</span> <span class="token keyword">array</span><span class="token punctuation">(</span><span class="token string">'author_name'</span><span class="token punctuation">,</span> <span class="token string">'description'</span><span class="token punctuation">,</span> <span class="token string">'title'</span><span class="token punctuation">)</span>
	<span class="token variable">$books</span> <span class="token operator">=</span> <span class="token variable">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">manyToMany</span><span class="token punctuation">(</span><span class="token string">'authors'</span><span class="token punctuation">,</span><span class="token string">'books_authors'</span><span class="token punctuation">,</span><span class="token string">'book_id'</span><span class="token punctuation">,</span><span class="token string">'author_id'</span><span class="token punctuation">)</span>
	              <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">get</span><span class="token punctuation">(</span><span class="token variable">$cols</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
	</code></pre></div>
</div>
</div>
</br>
<img class="relationsImage" src="assets/images/ManyToMany.png"></img>
</div>
<table class="table table-hover table-striped">
	<thead class="thead-inverse">
		<tr>
			<th class="text-center">Title</th>
			<th class="text-center">Author</th>
			<th class="text-center">Description</th>
        </tr>
    </thead>
<?php 

foreach ($books as $book)
{
	$title = $book[0]['title'];
?>
		<tr>
			<td>
				<a href="./?book=<?php echo $title; ?>"><?php echo $title; ?></a>
			</td>
			<td>
				<ul>
<?php
	// building the list of authors in the authors column
	$authors_col = '';
	foreach ($book[0]['authors'] as $author) {
		$authors_col .= '<li><a href="index.php?author='.$author.'">'.$author.'</a></li>';
	}
	echo $authors_col;
?>
				</ul>
			</td>
			<td>
				<?php echo $book[0]['description'];?>
				</br>
				<form method="POST">
					<input type="hidden" name="_method" value="DELETE">
					<input type="hidden" name="deleteBookByTitle" value="<?php echo $title;?>">
					<input class="btn btn-danger" type="submit" value="Delete" name="deleteBookByTitleButton" />
				</form>
			</td>
		</tr>
<?php		
} //end of for each books as book
?>
	
</table>
