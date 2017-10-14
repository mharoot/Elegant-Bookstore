<div>
<article>
<h1>Elegant: Getting Started</h1>
<ul>
    <li><a href="#introduction">Introduction</a></li>
    <li><a href="#database-configuration">Database Configuration</a></li>
    <li><a href="#defining-models">Defining Models</a>
        <ul>
            <li><a href="#Elegant-model-conventions">Elegant Model Conventions</a></li>
        </ul>
    </li>
    <li><a href="#retrieving-models">Retrieving Models</a>
        <ul>
            <li><a href="#array-of-associative-arrays">Array of Associative Arrays</a></li>
        </ul>
    </li>
</ul>



<!-- introduction -->
<p><a name="introduction"></a></p>
<h2><a href="#introduction">Introduction</a></h2>
<p>The Elegant ORM is adatable with any custom mvc project and is flexible enough to be use in other php 
frameworks such as, Laravel, Codeigniter, etc.  Elegant ORM provides an elegant, simple ActiveRecord implementation for working with your database. Each database table has a corresponding "Model" which is used to interact with that table. Models allow you to query for data in your tables, as well as insert new records into the table.</p>
<p>Before getting started, be sure to configure a database connection in <code class=" language-php">Elegant<span class="token operator">/</span>dbconfig<span class="token punctuation">.</span>php</code>. For more information on configuring your database, check out <a href="#database-configuration">the documentation</a>.</p>



<!-- database-configuration -->
<p><a name="database-configuration"></a></p>
<h2><a href="#database-configuration">Database Configuration</a></h2>
<p>Inside the Elegant folder, you can find the dbconfig.php file.  Set the proper configurations to use with your database.
<div style="height:10em" class="call-to-action-wrapper">
<div style="height:10em" class="code-window animate fade-in">
    <div style="height:10em" class="code-editor CodeFlask"><div style="height:10em" class="CodeFlask__textarea"></div><pre class="CodeFlask__pre  language-javascript"><code class="CodeFlask__code  language-javascript"><span class="token operator">&lt;</span><span class="token operator">?</span>php
    <span class="token comment" spellcheck="true">/*
        Elegant/dbconfig.php
    */</span>
    <span class="token function">define</span><span class="token punctuation">(</span><span class="token string">"DB_HOST"</span><span class="token punctuation">,</span><span class="token string">"localhost"</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
    <span class="token function">define</span><span class="token punctuation">(</span><span class="token string">"DB_USER"</span><span class="token punctuation">,</span><span class="token string">"root"</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
    <span class="token function">define</span><span class="token punctuation">(</span><span class="token string">"DB_PASS"</span><span class="token punctuation">,</span><span class="token string">"your-password"</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
    <span class="token function">define</span><span class="token punctuation">(</span><span class="token string">"DB_NAME"</span><span class="token punctuation">,</span><span class="token string">"your-database-name"</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token operator">?</span><span class="token operator">&gt;</span>
</code></pre></div>
</div>
</div>

</p>



<!-- defining-models -->
<p><a name="defining-models"></a></p>
<h2><a href="#defining-models">Defining Models</a></h2>
<p>To get started, let's create an Elegant model. All Elegant models extend <code class=" language-php">Elegant<span class="token punctuation">\</span>Model</span></code> class.</p>




<!-- Elegant-model-convetions -->
<p><a name="Elegant-model-conventions"></a></p>
<h3>Elegant Model Conventions</h3>
<p>Now, let's look at an example <code class=" language-php">Book</code> model, which we will use to retrieve and store information from our <code class=" language-php">books</code> database table:</p>
<div style="height:10em" class="call-to-action-wrapper">
<div style="height:10em" class="code-window animate fade-in">
    <div style="height:10em" class="code-editor CodeFlask"><div style="height:10em" class="CodeFlask__textarea"></div><pre class="CodeFlask__pre  language-javascript"><code class="CodeFlask__code  language-javascript"><span class="token operator">&lt;</span><span class="token operator">?</span>php
        <span class="token function">include_once</span><span class="token punctuation">(</span><span class="token string">"Elegant/Model.php"</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

        <span class="token keyword">class</span> <span class="token class-name">Book</span> <span class="token keyword">extends</span> <span class="token class-name">Model</span>
        <span class="token punctuation">{</span>
            <span class="token comment" spellcheck="true">//</span>
        <span class="token punctuation">}</span>
<span class="token operator">?</span><span class="token operator">&gt;</span>
</code></pre></div>
</div>
</div>

<!-- Table Names -->
<h4>Table Names</h4>
<p>Note that we did not tell Elegant which table to use for our <code class=" language-php">Book</code> model. By convention, you should use the "snake case", plural name of the class will be used as the table name unless another name is explicitly specified. So, in this case, Elegant for our <code class=" language-php">Book</code> model stores records in the <code class=" language-php">books</code> table. You may specify a custom table by defining a <code class=" language-php">table</code> property on your model.  You may <b>not</b> leave it empty.  It is mandatory to give a table name as done below in the following code snippet:</p>

<div style="height:17em" class="call-to-action-wrapper">
<div style="height:17em" class="code-window animate fade-in">
    <div style="height:17em" class="code-editor CodeFlask"><div style="height:17em" class="CodeFlask__textarea"></div><pre class="CodeFlask__pre  language-javascript"><code class="CodeFlask__code  language-javascript">    <span class="token operator">&lt;</span><span class="token operator">?</span>php
        <span class="token function">include_once</span><span class="token punctuation">(</span><span class="token string">"Elegant/Model.php"</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
        <span class="token keyword">class</span> <span class="token class-name">Book</span> <span class="token keyword">extends</span> <span class="token class-name">Model</span>
        <span class="token punctuation">{</span>
            <span class="token keyword">public</span> <span class="token function">__construct</span><span class="token punctuation">(</span><span class="token punctuation">)</span> 
            <span class="token punctuation">{</span>
                <span class="token comment" spellcheck="true">/**
                * The table name associated with the model.
                *
                * @var string
                */</span>
                $<span class="token keyword">this</span><span class="token operator">-</span><span class="token operator">&gt;</span>table_name <span class="token operator">=</span> <span class="token string">'books'</span><span class="token punctuation">;</span>
            <span class="token punctuation">}</span>
        <span class="token punctuation">}</span>
    <span class="token operator">?</span><span class="token operator">&gt;</span>
</code></pre></div>
</div>
</div>

<!-- retrieving models -->
<p><a name="retrieving-models"></a></p>
<h2><a href="#retrieving-models">Retrieving Models</a></h2>


<!-- Adding Additional Constraints-->
<p><a name="adding-additional-constraints"></a></p>
<h4>Adding Additional Constraints</h4>
<p>The Elegant <code class=" language-php">all</code> method will return all of the results in the model's table. Since each Elegant model serves as a <a href="./?query-builder">query builder</a>, you may also add constraints to queries, and then use the <code class=" language-php">get</code> method to retrieve the results:</p>

<div style="height:14em" class="call-to-action-wrapper">
<div style="height:14em" class="code-window animate fade-in">
    <div style="height:14em" class="code-editor CodeFlask"><div style="height:14em"class="CodeFlask__textarea"></div><pre class="CodeFlask__pre  language-javascript"><code class="CodeFlask__code  language-javascript">    <span class="token operator">&lt;</span><span class="token operator">?</span>php
        $book_model  <span class="token operator">=</span> <span class="token keyword">new</span> <span class="token class-name">Book</span><span class="token punctuation">(</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
        $cols  <span class="token operator">=</span> <span class="token function">array</span><span class="token punctuation">(</span><span class="token string">'title'</span><span class="token punctuation">,</span> <span class="token string">'author'</span><span class="token punctuation">,</span> <span class="token string">'description'</span><span class="token punctuation">,</span> <span class="token string">'genre'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
        $books <span class="token operator">=</span> $book_model<span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">where</span><span class="token punctuation">(</span><span class="token string">'active'</span><span class="token punctuation">,</span> <span class="token string">'='</span><span class="token punctuation">,</span> <span class="token string">'1'</span><span class="token punctuation">)</span>
                            <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">orWhere</span><span class="token punctuation">(</span><span class="token string">'title'</span><span class="token punctuation">,</span> <span class="token string">'='</span><span class="token punctuation">,</span> <span class="token string">'Harry Potter'</span><span class="token punctuation">)</span>
                            <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">orderBy</span><span class="token punctuation">(</span><span class="token string">'name'</span><span class="token punctuation">,</span> <span class="token string">'desc'</span><span class="token punctuation">)</span>
                            <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">take</span><span class="token punctuation">(</span><span class="token number">10</span><span class="token punctuation">)</span>
                            <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token keyword">get</span><span class="token punctuation">(</span>$cols<span class="token punctuation">)</span><span class="token punctuation">;</span>
    <span class="token operator">?</span><span class="token operator">&gt;</span>
</code></pre></div>
</div>
</div>

Since Elegant models are query builders, you should review all of the methods available on the <a href="./?query-builder">query builder</a>. You may use any of these methods in your Elegant queries.</p>

<!-- Adding Additional Constraints-->
<p><a name="array-of-associative-arrays"></a></p>
<h3>Array of Associate Arrays</h3>
<p>For Elegant methods like <code class=" language-php">all</code> and <code class=" language-php">get</code> which retrieve multiple results are stored in <code class=" language-php">Array</code> where each row can be reached by an integer index.  Within each row an <code class=" language-php">Associative Array</code> holds the key as the column name where it holds each columns value that will be returned. The following code snippet is an example for working with your Elegant results:</p>

<div style="height:14em" class="call-to-action-wrapper">
<div style="height:14em" class="code-window animate fade-in">
    <div class="code-editor CodeFlask"><textarea class="CodeFlask__textarea"></textarea><pre class="CodeFlask__pre  language-javascript"><code class="CodeFlask__code  language-javascript">    <span class="token operator">&lt;</span><span class="token operator">?</span>php
        <span class="token comment" spellcheck="true">/*    in controller    */</span>
        $<span class="token keyword">this</span><span class="token operator">-</span><span class="token operator">&gt;</span>book_model <span class="token operator">=</span> <span class="token keyword">new</span> <span class="token class-name">Book</span><span class="token punctuation">(</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
        $books <span class="token operator">=</span> $<span class="token keyword">this</span><span class="token operator">-</span><span class="token operator">&gt;</span>book_model<span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">getBookList</span><span class="token punctuation">(</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
        include <span class="token string">'view/templates/header.php'</span><span class="token punctuation">;</span>
        include <span class="token string">'view/pages/booklist.php'</span><span class="token punctuation">;</span>
        include <span class="token string">'view/templates/footer.php'</span><span class="token punctuation">;</span>

        <span class="token comment" spellcheck="true">/*    in view    */</span>
        <span class="token keyword">for</span> <span class="token punctuation">(</span>$row <span class="token operator">=</span> <span class="token number">0</span><span class="token punctuation">;</span> $row <span class="token operator">&lt;</span> <span class="token function">count</span><span class="token punctuation">(</span>books<span class="token punctuation">)</span><span class="token punctuation">;</span> $row<span class="token operator">++</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
            echo $book<span class="token punctuation">[</span>$row<span class="token punctuation">]</span><span class="token punctuation">[</span><span class="token string">'title'</span><span class="token punctuation">]</span><span class="token punctuation">;</span>
        <span class="token punctuation">}</span>
    <span class="token operator">?</span><span class="token operator">&gt;</span>
</code></pre></div>
</div>
</div>


<p>Of course, you may also simply loop over the Array of Associate Arrays as in the following code snippet:</p>

<div style="height:10em" class="call-to-action-wrapper">
<div style="height:10em" class="code-window animate fade-in">
    <div class="code-editor CodeFlask"><div class="CodeFlask__textarea"></div><pre class="CodeFlask__pre  language-javascript"><code class="CodeFlask__code  language-javascript">    <span class="token operator">&lt;</span><span class="token operator">?</span>php
        <span class="token comment" spellcheck="true">/*    in view    */</span>
        <span class="token function">foreach</span><span class="token punctuation">(</span>$books <span class="token keyword">as</span> $book<span class="token punctuation">)</span> <span class="token punctuation">{</span>
            echo $book<span class="token punctuation">[</span><span class="token string">'title'</span><span class="token punctuation">]</span><span class="token punctuation">;</span>
        <span class="token punctuation">}</span>
    <span class="token operator">?</span><span class="token operator">&gt;</span>
</code></pre></div>
</div>
</div>



</article>
</div>