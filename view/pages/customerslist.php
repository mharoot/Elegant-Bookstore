<?php   
ini_set('display_errors',1);
 error_reporting(E_ALL); 

 ?>
 <div class="jumbotron">

<h2> Elegant ORM - One to Many Relations</h2>
<p> One customer can have many orders hence to one-to-many.</p>
<p> The Elegant ORM code snippet required for these results: </p> 

<div style="height: 5em;" class="call-to-action-wrapper">
<div style="height: 5em;" class="code-window animate fade-in">
<div class="code-editor CodeFlask customer-list-codesnippet-oneToMany"><div class="CodeFlask__textarea customer-list-codesnippet-oneToMany"></div><pre class="CodeFlask__pre  language-php"><code class="CodeFlask__code  language-php"><span class="token variable">$primary_key</span> <span class="token operator">=</span> <span class="token string">'id'</span><span class="token punctuation">;</span>
<span class="token variable">$foreign_key</span> <span class="token operator">=</span> <span class="token string">'customer_id'</span><span class="token punctuation">;</span>
<span class="token keyword">return</span> <span class="token variable">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">oneToMany</span><span class="token punctuation">(</span><span class="token string">'orders'</span><span class="token punctuation">,</span> <span class="token variable">$primary_key</span><span class="token punctuation">,</span> <span class="token variable">$foreign_key</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">get</span><span class="token punctuation">(</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
</code></pre></div>
</div>
</div>

</br>

<img class="relationsImage" src="assets/images/OneToMany.png"></img>

<table id="booklist" class="table table-hover table-striped">
	<thead>
      <tr>
        <th>Name</th>
        <th>Address</th>
        <th>Amount</th>
      </tr>
    </thead>
	<?php 

		foreach ($customers as $customer) {
			echo "<tr><td>". $customer->name . '</td> <td>'. $customer->address.'</td><td>'.$customer->amount. '</td></tr>';
		}

	?>
</table>
</div>