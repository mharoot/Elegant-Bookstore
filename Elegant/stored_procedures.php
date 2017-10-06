<?php


$q = 'SELECT * FROM books  JOIN genres WHERE books.genre = genres.id AND title = "Cracking the Coding Interview: 189 Programming Questions and Solutions"';

//or book.title same results however we will go with the preceding one since
// its how we have it coded in Model->where();

$q = 'SELECT * FROM books  JOIN genres WHERE books.genre = genres.id AND books.title = "Cracking the Coding Interview: 189 Programming Questions and Solutions"';









 
 //oneToOne
//  $this->query = $this->table_name." JOIN ".$table_name." WHERE ".$this->table_name.".".$primary_key."=".$table_name.".".$foreign_key;

// $q = books JOIN genres WHERE books.genre = genres.id 