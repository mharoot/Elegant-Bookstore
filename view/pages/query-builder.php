<article>

<h1>Database: Query Builder</h1>
<ul>
    <li><a href="#introduction">Introduction</a></li>
    <li><a href="#retrieving-results">Retrieving Results</a></li>
    <li><a href="#selects">Selects</a></li>
    <li><a href="#relations">Relations</a></li>
    <li><a href="#where-clauses">Where Clauses</a></li>
    <li><a href="#inserts">Inserts</a></li>
    <li><a href="#updates">Updates</a></li>
    <li><a href="#deletes">Deletes</a></li>
</ul>


<!-- Introduction -->
<p><a name="introduction"></a></p>
<h2><a href="#introduction">Introduction</a></h2>
<p>Elegant's database query builder provides a convenient, fluent interface to creating and running database queries within models. It can be used to perform most database operations in your application and works on all supported database systems.</p>
<p>The Elegant query builder uses PDO parameter binding to protect your application against SQL injection attacks. There is no need to clean strings being passed as bindings.</p>
<p><a name="retrieving-results"></a></p>
<h2><a href="#retrieving-results">Retrieving Results</a></h2>
<h4>Retrieving All Rows From A Table</h4>
<p>You may use the <code class="language-php">all</code> method in order to request all rows and all columns within a <code class="language-php">Model</code>'s database table. The <code class="language-php">all</code> method in <code class="language-php">QueryBuilder</code> returns a proper query string for the <code class="language-php">Model</code> to execute the query.

<div style="height:10em" class="code-editor CodeFlask"><div style="height:10em" class="CodeFlask__textarea"></div><pre class="CodeFlask__pre  language-php">
</pre></div></div>

<h4>Retrieving A Single Row / Column From A Table</h4>
<p>If you just need to retrieve a single row from the database table, you may use the <code class=" language-php">first</code> method. This method will return a single <code class=" language-php">StdClass</code> object:</p>
<div style="height:10em" class="code-editor CodeFlask"><div style="height:10em" class="CodeFlask__textarea"></div><pre class="CodeFlask__pre  language-php"><code class="CodeFlask__code  language-php"><span class="token variable">$user</span> <span class="token operator">=</span> <span class="token scope">DB<span class="token punctuation">::</span></span><span class="token function">table<span class="token punctuation">(</span></span><span class="token string">'users'</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">where<span class="token punctuation">(</span></span><span class="token string">'name'</span><span class="token punctuation">,</span> <span class="token string">'John'</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">first<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span>

<span class="token keyword">echo</span> <span class="token variable">$user</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">name</span><span class="token punctuation">;</span></code></pre></div></div>
<p>If you don't even need an entire row, you may extract a single value from a record using the <code class=" language-php">value</code> method. This method will return the value of the column directly:</p>
<div style="height:10em" class="code-editor CodeFlask"><div style="height:10em" class="CodeFlask__textarea"></div><pre class="CodeFlask__pre  language-php"><code class="CodeFlask__code  language-php"><span class="token variable">$email</span> <span class="token operator">=</span> <span class="token scope">DB<span class="token punctuation">::</span></span><span class="token function">table<span class="token punctuation">(</span></span><span class="token string">'users'</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">where<span class="token punctuation">(</span></span><span class="token string">'name'</span><span class="token punctuation">,</span> <span class="token string">'John'</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">value<span class="token punctuation">(</span></span><span class="token string">'email'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre></div></div>
<h4>Retrieving A List Of Column Values</h4>
<p>If you would like to retrieve a Collection containing the values of a single column, you may use the <code class=" language-php">pluck</code> method. In this example, we'll retrieve a Collection of role titles:</p>
<div style="height:10em" class="code-editor CodeFlask"><div style="height:10em" class="CodeFlask__textarea"></div><pre class="CodeFlask__pre  language-php"><code class="CodeFlask__code  language-php"><span class="token variable">$titles</span> <span class="token operator">=</span> <span class="token scope">DB<span class="token punctuation">::</span></span><span class="token function">table<span class="token punctuation">(</span></span><span class="token string">'roles'</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">pluck<span class="token punctuation">(</span></span><span class="token string">'title'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

<span class="token keyword">foreach</span> <span class="token punctuation">(</span><span class="token variable">$titles</span> <span class="token keyword">as</span> <span class="token variable">$title</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
    <span class="token keyword">echo</span> <span class="token variable">$title</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span></code></pre></div></div>
<p>You may also specify a custom key column for the returned Collection:</p>
<div style="height:10em" class="code-editor CodeFlask"><div style="height:10em" class="CodeFlask__textarea"></div><pre class="CodeFlask__pre  language-php"><code class="CodeFlask__code  language-php"><span class="token variable">$roles</span> <span class="token operator">=</span> <span class="token scope">DB<span class="token punctuation">::</span></span><span class="token function">table<span class="token punctuation">(</span></span><span class="token string">'roles'</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">pluck<span class="token punctuation">(</span></span><span class="token string">'title'</span><span class="token punctuation">,</span> <span class="token string">'name'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

<span class="token keyword">foreach</span> <span class="token punctuation">(</span><span class="token variable">$roles</span> <span class="token keyword">as</span> <span class="token variable">$name</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token variable">$title</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
    <span class="token keyword">echo</span> <span class="token variable">$title</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span></code></pre></div></div>
<p><a name="chunking-results"></a></p>
<h3>Chunking Results</h3>
<p>If you need to work with thousands of database records, consider using the <code class=" language-php">chunk</code> method. This method retrieves a small chunk of the results at a time and feeds each chunk into a <code class=" language-php">Closure</code> for processing. This method is very useful for writing <a href="/docs/5.5/artisan">Artisan commands</a> that process thousands of records. For example, let's work with the entire <code class=" language-php">users</code> table in chunks of 100 records at a time:</p>
<div style="height:10em" class="code-editor CodeFlask"><div style="height:10em" class="CodeFlask__textarea"></div><pre class="CodeFlask__pre  language-php"><code class="CodeFlask__code  language-php"><span class="token scope">DB<span class="token punctuation">::</span></span><span class="token function">table<span class="token punctuation">(</span></span><span class="token string">'users'</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">orderBy<span class="token punctuation">(</span></span><span class="token string">'id'</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">chunk<span class="token punctuation">(</span></span><span class="token number">100</span><span class="token punctuation">,</span> <span class="token keyword">function</span> <span class="token punctuation">(</span><span class="token variable">$users</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
    <span class="token keyword">foreach</span> <span class="token punctuation">(</span><span class="token variable">$users</span> <span class="token keyword">as</span> <span class="token variable">$user</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
       <span class="token comment" spellcheck="true"> //
</span>    <span class="token punctuation">}</span>
<span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre></div></div>
<p>You may stop further chunks from being processed by returning <code class=" language-php"><span class="token boolean">false</span></code> from the <code class=" language-php">Closure</code>:</p>
<div style="height:10em" class="code-editor CodeFlask"><div style="height:10em" class="CodeFlask__textarea"></div><pre class="CodeFlask__pre  language-php"><code class="CodeFlask__code  language-php"><span class="token scope">DB<span class="token punctuation">::</span></span><span class="token function">table<span class="token punctuation">(</span></span><span class="token string">'users'</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">orderBy<span class="token punctuation">(</span></span><span class="token string">'id'</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">chunk<span class="token punctuation">(</span></span><span class="token number">100</span><span class="token punctuation">,</span> <span class="token keyword">function</span> <span class="token punctuation">(</span><span class="token variable">$users</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
   <span class="token comment" spellcheck="true"> // Process the records...
</span>
    <span class="token keyword">return</span> <span class="token boolean">false</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre></div></div>
<p><a name="aggregates"></a></p>
<h3>Aggregates</h3>
<p>The query builder also provides a variety of aggregate methods such as <code class=" language-php">count</code>, <code class=" language-php">max</code>, <code class=" language-php">min</code>, <code class=" language-php">avg</code>, and <code class=" language-php">sum</code>. You may call any of these methods after constructing your query:</p>
<div style="height:10em" class="code-editor CodeFlask"><div style="height:10em" class="CodeFlask__textarea"></div><pre class="CodeFlask__pre  language-php"><code class="CodeFlask__code  language-php"><span class="token variable">$users</span> <span class="token operator">=</span> <span class="token scope">DB<span class="token punctuation">::</span></span><span class="token function">table<span class="token punctuation">(</span></span><span class="token string">'users'</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">count<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span>

<span class="token variable">$price</span> <span class="token operator">=</span> <span class="token scope">DB<span class="token punctuation">::</span></span><span class="token function">table<span class="token punctuation">(</span></span><span class="token string">'orders'</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">max<span class="token punctuation">(</span></span><span class="token string">'price'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre></div></div>
<p>Of course, you may combine these methods with other clauses:</p>
<div style="height:10em" class="code-editor CodeFlask"><div style="height:10em" class="CodeFlask__textarea"></div><pre class="CodeFlask__pre  language-php"><code class="CodeFlask__code  language-php"><span class="token variable">$price</span> <span class="token operator">=</span> <span class="token scope">DB<span class="token punctuation">::</span></span><span class="token function">table<span class="token punctuation">(</span></span><span class="token string">'orders'</span><span class="token punctuation">)</span>
                <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">where<span class="token punctuation">(</span></span><span class="token string">'finalized'</span><span class="token punctuation">,</span> <span class="token number">1</span><span class="token punctuation">)</span>
                <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">avg<span class="token punctuation">(</span></span><span class="token string">'price'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre></div></div>
<p><a name="selects"></a></p>
<!-- END OF Introduction -->

<!-- SELECTS -->
<h2><a href="#selects">Selects</a></h2>
<h4>Specifying A Select Clause within <code>Get Parameter</code></h4>
<p>Of course, you may not always want to select all columns from a database table. Using an <code class=" language-php">array('aColumn','someOtherCol')</code> method, you can specify a custom <code class=" language-php">select</code> clause for the query:</p>
<div style="height:10em" class="code-editor CodeFlask"><div style="height:10em" class="CodeFlask__textarea"></div>
<pre class="CodeFlask__pre  language-php">
</pre></div></div>

<div style="height:10em" class="code-editor CodeFlask"><div style="height:10em" class="CodeFlask__textarea"></div>
<p><a name="relations"></a></p>
<h2><a href="#relations">Relations</a></h2>
<h4>Many To Many</h4>

<div style="height:10em" class="code-editor CodeFlask">
    <div style="height:10em" class="CodeFlask__textarea"></div>
    <pre class="CodeFlask__pre  language-php">
    </pre>
</div>
</div>

<!-- END OF RELATIONS -->


<!-- WHERE CLAUSES -->
<p><a name="where-clauses"></a></p>
<h2><a href="#where-clauses">Where Clauses</a></h2>
<h4>Simple Where Clauses</h4>
<p>You may use the <code class=" language-php">where</code> method on a query builder instance to add <code class=" language-php">where</code> clauses to the query. The most basic call to <code class=" language-php">where</code> requires three arguments. The first argument is the name of the column. The second argument is an operator, which can be any of the database's supported operators. Finally, the third argument is the value to evaluate against the column.</p>
<p>For example, here is a query that verifies the value of the "votes" column is equal to 100:</p>
<div style="height:10em" class="code-editor CodeFlask"><div style="height:10em" class="CodeFlask__textarea"></div><pre class="CodeFlask__pre  language-php"><code class="CodeFlask__code  language-php"><span class="token variable">$users</span> <span class="token operator">=</span> <span class="token scope">DB<span class="token punctuation">::</span></span><span class="token function">table<span class="token punctuation">(</span></span><span class="token string">'users'</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">where<span class="token punctuation">(</span></span><span class="token string">'votes'</span><span class="token punctuation">,</span> <span class="token string">'='</span><span class="token punctuation">,</span> <span class="token number">100</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">get<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre></div></div>
<p>For convenience, if you simply want to verify that a column is equal to a given value, you may pass the value directly as the second argument to the <code class=" language-php">where</code> method:</p>
<div style="height:10em" class="code-editor CodeFlask"><div style="height:10em" class="CodeFlask__textarea"></div><pre class="CodeFlask__pre  language-php"><code class="CodeFlask__code  language-php"><span class="token variable">$users</span> <span class="token operator">=</span> <span class="token scope">DB<span class="token punctuation">::</span></span><span class="token function">table<span class="token punctuation">(</span></span><span class="token string">'users'</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">where<span class="token punctuation">(</span></span><span class="token string">'votes'</span><span class="token punctuation">,</span> <span class="token number">100</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">get<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre></div></div>
<p>Of course, you may use a variety of other operators when writing a <code class=" language-php">where</code> clause:</p>


<h4>Or Statements</h4>
<p>You may chain where constraints together as well as add <code class=" language-php"><span class="token keyword">or</span></code> clauses to the query. The <code class=" language-php">orWhere</code> method accepts the same arguments as the <code class=" language-php">where</code> method:</p>
<div style="height:10em" class="code-editor CodeFlask"><div style="height:10em" class="CodeFlask__textarea"></div><pre class="CodeFlask__pre  language-php"><code class="CodeFlask__code  language-php"><span class="token variable">$users</span> <span class="token operator">=</span> <span class="token scope">DB<span class="token punctuation">::</span></span><span class="token function">table<span class="token punctuation">(</span></span><span class="token string">'users'</span><span class="token punctuation">)</span>
                    <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">where<span class="token punctuation">(</span></span><span class="token string">'votes'</span><span class="token punctuation">,</span> <span class="token string">'&gt;'</span><span class="token punctuation">,</span> <span class="token number">100</span><span class="token punctuation">)</span>
                    <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">orWhere<span class="token punctuation">(</span></span><span class="token string">'name'</span><span class="token punctuation">,</span> <span class="token string">'John'</span><span class="token punctuation">)</span>
                    <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">get<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre></div></div>




<!-- UPDATES -->
<p><a name="updates"></a></p>
<h2><a href="#updates">Updates</a></h2>
<p>Of course, in addition to inserting records into the database, the query builder can also update existing records using the <code class=" language-php">update</code> method. The <code class=" language-php">update</code> method, like the <code class=" language-php">insert</code> method, accepts an array of column and value pairs containing the columns to be updated. You may constrain the <code class=" language-php">update</code> query using <code class=" language-php">where</code> clauses:</p>
<div style="height:10em" class="code-editor CodeFlask"><div style="height:10em" class="CodeFlask__textarea"></div><pre class="CodeFlask__pre  language-php"><code class="CodeFlask__code  language-php"><span class="token scope">DB<span class="token punctuation">::</span></span><span class="token function">table<span class="token punctuation">(</span></span><span class="token string">'users'</span><span class="token punctuation">)</span>
            <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">where<span class="token punctuation">(</span></span><span class="token string">'id'</span><span class="token punctuation">,</span> <span class="token number">1</span><span class="token punctuation">)</span>
            <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">update<span class="token punctuation">(</span></span><span class="token punctuation">[</span><span class="token string">'votes'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token number">1</span><span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre></div></div>
<p><a name="updating-json-columns"></a></p>
<h3>Updating JSON Columns</h3>
<p>When updating a JSON column, you should use <code class=" language-php"><span class="token operator">-</span><span class="token operator">&gt;</span></code> syntax to access the appropriate key in the JSON object. This operation is only supported on databases that support JSON columns:</p>
<div style="height:10em" class="code-editor CodeFlask"><div style="height:10em" class="CodeFlask__textarea"></div><pre class="CodeFlask__pre  language-php"><code class="CodeFlask__code  language-php"><span class="token scope">DB<span class="token punctuation">::</span></span><span class="token function">table<span class="token punctuation">(</span></span><span class="token string">'users'</span><span class="token punctuation">)</span>
            <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">where<span class="token punctuation">(</span></span><span class="token string">'id'</span><span class="token punctuation">,</span> <span class="token number">1</span><span class="token punctuation">)</span>
            <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">update<span class="token punctuation">(</span></span><span class="token punctuation">[</span><span class="token string">'options-&gt;enabled'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token boolean">true</span><span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre></div></div>




<!-- DELETES -->
<p><a name="deletes"></a></p>
<h2><a href="#deletes">Deletes</a></h2>
<p>The query builder may also be used to delete records from the table via the <code class=" language-php">delete</code> method. You may constrain <code class=" language-php">delete</code> statements by adding <code class=" language-php">where</code> clauses before calling the <code class=" language-php">delete</code> method:</p>
