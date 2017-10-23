<article>

<h1>Elegant Models: Built in Database Query Builder</h1>
<ul>
    <li><a href="#introduction">Introduction</a></li>
    <li>
        <a href="#retrieving-results">Retrieving Results</a>
        <ul>
            <li><a href="#retrieving-all-rows-from-a-table">Retrieving All Rows From A Table</a></li>
        </ul>
    </li>
    <li><a href="#selects">Selects</a></li>
    <li>
        <a href="#relations">Relations</a>
        <ul>
            <li><a href="#many-to-many">Many to Many</a></li>
            <li><a href="#one-to-many">One to Many</a></li>
            <li><a href="#one-to-one">One to One</a></li>
        </ul>
    </li>
    <li>
        <a href="#where-clauses">Where Clauses</a>
        <ul>
            <li><a href="#simple-where-clauses">Simple Where Clauses</a></li>
            <li><a href="#or-statements">Or Statements</a></li>
        </ul>
    </li>
    <li><a href="#inserts">Inserts</a></li>
    <li><a href="#updates">Updates</a></li>
    <li><a href="#deletes">Deletes</a></li>
</ul>


<!-- Introduction -->
<p><a name="introduction"></a></p>
<h2><a href="#introduction">Introduction</a></h2>
<p>Elegant models have a built in database query builder that provides a convenient, fluent interface to creating and running database queries within models. It can be used to perform most database operations in your application and works on all supported database systems.</p>
<p>The Elegant query builder uses PDO parameter binding to protect your application against SQL injection attacks. There is no need to clean strings being passed as bindings.</p>
<!-- END OF Introduction -->





<!-- Retrieving Results -->
<p><a name="retrieving-results"></a></p>
<h2><a href="#retrieving-results">Retrieving Results</a></h2>

<p><a name="retrieving-all-rows-from-a-table"></a></p>
<h4>Retrieving All Rows From A Table</h4>
<p>You may use the <code class="language-php">all</code> method in order to request all rows and all columns within a <code class="language-php">Model</code>'s database table. The <code class="language-php">all</code> method in <code class="language-php">QueryBuilder</code> returns a proper query string for the <code class="language-php">Model</code> to execute the query.

<!-- END OF Retrieving Results -->





<!-- SELECTS -->
<p><a name="selects"></a></p>
<h2><a href="#selects">Selects</a></h2>
<h4>Specifying A Select Clause within <code>Get Parameter</code></h4>
<p>Of course, you may not always want to select all columns from a database table. You can specify what columns you want in the <code>get()</code> method as done in the following code snippet below:</p>
<div class="call-to-action-wrapper codesnippet-selects">
<div class="code-window animate fade-in codesnippet-selects">
<div class="code-editor CodeFlask">
<pre class="CodeFlask__pre  language-php"><code class="CodeFlask__code  language-php"><span class="token variable">$books</span> <span class="token operator">=</span> <span class="token variable">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">get</span><span class="token punctuation">(</span><span class="token keyword">array</span><span class="token punctuation">(</span><span class="token string">'author_name'</span><span class="token punctuation">,</span> <span class="token string">'description'</span><span class="token punctuation">,</span> <span class="token string">'title'</span><span class="token punctuation">)</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
</code></pre>    
</div>
</div>
</div>

<!-- END OF SELECTS -->




<!-- RELATIONS -->
<p><a name="relations"></a></p>
<h2><a href="#relations">Relations</a></h2>

<p><a name="many-to-many"></a></p>
<h4>Many To Many</h4>

<p><a name="one-to-many"></a></p>
<h4>One To Many</h4>

<p><a name="one-to-one"></a></p>
<h4>One To One</h4>

<!-- END OF RELATIONS -->




<!-- WHERE CLAUSES -->
<p><a name="where-clauses"></a></p>
<h2><a href="#where-clauses">Where Clauses</a></h2>

<p><a name="simple-where-clauses"></a></p>
<h4>Simple Where Clauses</h4>


<p><a name="or-statements"></a></p>
<h4>Or Statements</h4>
<p>You may chain where constraints together as well as add <code class=" language-php"><span class="token keyword">or</span></code> clauses to the query. The <code class=" language-php">orWhere</code> method accepts the same arguments as the <code class=" language-php">where</code> method:</p>

<!-- END OF WHERE CLAUSES -->




<!-- INSERTS -->

<!-- END OF INSERTS -->





<!-- UPDATES -->
<p><a name="updates"></a></p>
<h2><a href="#updates">Updates</a></h2>
<p>Of course, in addition to inserting records into the database, the query builder can also update existing records using the <code class=" language-php">update</code> method. The <code class=" language-php">update</code> method, like the <code class=" language-php">insert</code> method, accepts an array of column and value pairs containing the columns to be updated. You may constrain the <code class=" language-php">update</code> query using <code class=" language-php">where</code> clauses:</p>

<!-- END OF UPDATES -->





<!-- DELETES -->
<p><a name="deletes"></a></p>
<h2><a href="#deletes">Deletes</a></h2>
<p>The query builder may also be used to delete records from the table via the <code class=" language-php">delete</code> method. You may constrain <code class=" language-php">delete</code> statements by adding <code class=" language-php">where</code> clauses before calling the <code class=" language-php">delete</code> method:</p>

<!-- END OF DELETES -->