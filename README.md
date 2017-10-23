# Elegant-Bookstore
Elegant-Bookstore - Elegant is an open source ORM where the functionalities are demonstrated by the Bookstore.

# In this version
- The ORMall functionality is giving expected results as a typical ORM would but it is unnecessarily slow.
- The save functionality knows to update or insert based on what the value of $hasWhereClause is in QueryBuilder, $hasWhereClause is no longer private.
- The Database in elegant has been modified, with a new function, resultsetObject that achieves what we want.

#TO DO:
- viewbook.php
<pre><code class="language-php">
        //sugesstion put logic for when a single result has been found, database has row count for queries which returns the possible count
        //that way i can decide to call wheter to call fetch or fetchALL
        foreach ($book as $b ) 
        {	
            echo $b->title;
        }
</code></pre>