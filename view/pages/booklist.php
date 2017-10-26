<?php   
ini_set('display_errors',1);
 error_reporting(E_ALL); 

 ?>
 <div class="jumbotron">

<h2> Elegant ORM - Many to Many Relations</h2>
<p> A book can have many authors, and an author can write many books.</p>
<p> The Elegant ORM code snippet required for these results: </p> 

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

<table id="booklist" class="table table-hover table-striped">
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

			$row .= "</td><td>".$book[0]['description']."</td><td><form method='post' >
			<input type='hidden' name='_method' value='DELETE'>
			<input type='hidden' name='deleteBookByTitle' value='" . $book[0]['title'] . "'>
		   <input class='btn btn-danger' type='submit' value='Delete' name='deleteBookByTitleButton' />
		   </form>
		   </td></tr>";
			echo $row;
			
		}

	?>
</table>
</div>