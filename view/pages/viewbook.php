<div class="jumbotron">
<h2> Elegant ORM - One to One and Many to Many Relation Chaining</h2>
<p> In this particular example there is a chaining of the oneToOne function with the manyToMany function. We also chain it with a call to the where function.  Lastly we call get to retrieve the results. The Elegant ORM code snippet required for these results: </p> 
<div style="height: 5em;" class="call-to-action-wrapper">
<div style="height: 5em;" class="code-window animate fade-in">
    <div style="height: 5em;" class="code-editor CodeFlask"><div class="CodeFlask__textarea"></div><pre class="CodeFlask__pre  language-javascript"><code class="CodeFlask__code  language-javascript">$result <span class="token operator">=</span> $<span class="token keyword">this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">oneToOne</span><span class="token punctuation">(</span><span class="token string">'genres'</span><span class="token punctuation">,</span><span class="token string">'genre_id'</span><span class="token punctuation">,</span><span class="token string">'id'</span><span class="token punctuation">)</span>
                <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">manyToMany</span><span class="token punctuation">(</span><span class="token string">'authors'</span><span class="token punctuation">,</span> <span class="token string">'books_authors'</span><span class="token punctuation">,</span><span class="token string">'book_id'</span><span class="token punctuation">,</span><span class="token string">'author_id'</span><span class="token punctuation">)</span>
                <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">where</span><span class="token punctuation">(</span><span class="token string">'title'</span><span class="token punctuation">,</span> <span class="token string">'='</span><span class="token punctuation">,</span> $title<span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token keyword">get</span><span class="token punctuation">(</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
</code></pre></div>
</div>
</div>
</br>
<img class="relationsImage" src="assets/images/OneToOneChainedManyToMany.png"></img>

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

	echo '<td>' . $book[0]['title'] .'</td>';
	echo '<td> <ul>' . $authors . '<ul> </td>';
	echo '<td>' . $book[0]['description'] . '</td>';
	echo '<td>' . $book[0]['genre_name'] . '</td>';
	
?>
	</tr>
</table>
<br>
</div>