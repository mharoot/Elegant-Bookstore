<?php   
ini_set('display_errors',1);
 error_reporting(E_ALL); 

 ?>
 <div class="jumbotron">

<h2> Elegant ORM - One to Many Relations</h2>
<p> One customer can have many orders hence to one-to-many.</p>
<p> The Elegant ORM code snippet required for these results: </p> 

<pre class="language-php"><p><code class="CodeFlask__code  language-php"><span class="token variable">$customers_pk</span> <span class="token operator">=</span> <span class="token string">'id'</span><span class="token punctuation">;</span>
<span class="token variable">$fk1</span> <span class="token operator">=</span> <span class="token string">'customer_id'</span><span class="token punctuation">;</span>
<span class="token keyword">return</span> <span class="token variable">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">oneToMany</span><span class="token punctuation">(</span><span class="token string">'orders'</span><span class="token punctuation">,</span> <span class="token variable">$customers_pk</span><span class="token punctuation">,</span> <span class="token variable">$fk1</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">get</span><span class="token punctuation">(</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
</code></p></pre>

</br>

<img class="relationsImage" src="assets/images/OneToMany.png"></img>
</br>
<h3> Customers Orders </h3>

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
			echo "<tr><td><p>". $customer->name . '</p></td> <td><p>'. $customer->address.'</p></td> <td><p>'.$customer->amount. '</p></td></tr>';
		}

	?>
</table>
</div>