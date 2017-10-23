
<div class="jumbotron">
<h2> Elegant ORM - Chaining Relation Functions</h2>
<p> Another exmample of the manyToMany Function chaining with a where clause.  One author can write many books  the specific books he or she writes is determined by chaining with a where clause</p> 

<p> The Elegant ORM code snippet required for these results: </p> 
<div style="height: 5em; margin-bottom:10px;" class="code-window animate fade-in">
<div style="height: 5em;" class="code-editor CodeFlask"><div style="height: 5em;" class="CodeFlask__textarea"></div>
<pre class="CodeFlask__pre  language-php"><code class="CodeFlask__code  language-php"><span class="token variable">$result</span> <span class="token operator">=</span> <span class="token variable">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">manyToMany</span><span class="token punctuation">(</span><span class="token string">'books'</span><span class="token punctuation">,</span><span class="token string">'books_authors'</span><span class="token punctuation">,</span><span class="token string">'author_id'</span><span class="token punctuation">,</span><span class="token string">'book_id'</span><span class="token punctuation">)</span>
	       <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">where</span><span class="token punctuation">(</span><span class="token string">'author_name'</span><span class="token punctuation">,</span><span class="token string">'='</span><span class="token punctuation">,</span><span class="token variable">$author</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">get</span><span class="token punctuation">(</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
</code></pre>
</div>
</div>
</br>
<img class="relationsImage" src="assets/images/ManyToMany.png"></img>


<?php 
	echo '<h4> Author '. $books_by_author[0]->author_name. '</h4>';
?>
	<ul>
<?php	
	foreach ($books_by_author as $book_by_author ) 
	{ 
?>
		<li> <?php echo '<a href="index.php?book='.$book_by_author->title.'">'.$book_by_author->title.'</a>'; ?> </li>
<?php 
	}
?>
	</ul>
	<br>

</div>