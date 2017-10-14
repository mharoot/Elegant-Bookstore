<?php
//in command line run: 
// phpunit --bootstrap model/Book.php tests/BookTest.php --testdox
// phpunit --bootstrap model/*.php tests/*.php --testdox
// phpunit --bootstrap model/*.php tests/QueryBuilderTest.php --testdox
// phpunit --bootstrap Elegant/QueryBuilder.php tests/QueryBuilderTest.php --testdox

declare(strict_types=1);
use PHPUnit\Framework\TestCase;
include_once('Elegant/QueryBuilder.php');

class QueryBuilderTest extends TestCase
{
    public function test_all()
    {
        $table_name = 'books';
        $queryBuilder = new QueryBuilder($table_name);
        $this->assertEquals($queryBuilder->all(), 'SELECT * FROM '.$table_name);
    }

    public function test_where_get()
    {
        $table_name = 'books';
        $queryBuilder = new QueryBuilder($table_name);
        $qbQuery = $queryBuilder->where('id','=','1')->get();
        $query   = "SELECT * FROM ".$table_name." WHERE id='1'";
        $this->assertEquals( $qbQuery, $query);
    }

    public function test_where_chain_get()
    {
        $table_name = 'books';
        $queryBuilder = new QueryBuilder($table_name);
        $qbQuery = $queryBuilder->where('id','=','1')->where('genre_id', '=', '1')->get();
        $query   = "SELECT * FROM ".$table_name." WHERE id='1' AND genre_id='1'";
        $this->assertEquals( $qbQuery, $query);

    }

    // public function test_one_to_many_get(){}

    public function test_many_to_many_get()
    {
        $foreign_table_name        = 'authors';
        $foreign_table_primary_key = 'author_id';
        $junction_table_name       = 'books_authors';
        
        $primary_table_name        = 'books';
        $primary_table_primary_key = 'book_id';
        $queryBuilder = new QueryBuilder($primary_table_name);
        
        $qbQuery = $queryBuilder->manyToMany( $foreign_table_name, $junction_table_name, $foreign_table_primary_key, $foreign_table_primary_key)->get();

        $q = 'SELECT * FROM books JOIN books_authors ON (books.author_id=books_authors.author_id) JOIN authors ON (books_authors.author_id=authors.author_id)';

        $this->assertEquals($qbQuery, $q);
        
    }


    public function test_one_to_one_get()
    {
        $primary_table_name = 'books';
        $foreign_table_name = 'genres';
        $primary_key = 'genre_id';
        $foreign_key = 'id';
        $queryBuilder = new QueryBuilder($primary_table_name);
        $qbQuery = $queryBuilder->oneToOne($foreign_table_name, $primary_key , $foreign_key)->get();
        $query   = 'SELECT * FROM books JOIN genres ON books.genre_id=genres.id';
        $this->assertEquals( $qbQuery, $query);
    }

    

    public function test_update()
    {
        $primary_table_name = 'books';
        $primary_key = 'book_id';
        $queryBuilder = new QueryBuilder($primary_table_name);
        $col_val_pairs = ['title' => 'The Algorithm Design Manual', 'description' => "Cool book dude!"];
        $qbQuery = $queryBuilder->where($primary_key,'=','1')->update($col_val_pairs);
        $query = "UPDATE books SET title='The Algorithm Design Manual' , description='Cool book dude!'  WHERE book_id='1'";
        $this->assertEquals( $qbQuery, $query);
    }



    
}
?>