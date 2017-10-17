<?php
//in command line run: 
//phpunit --bootstrap model/Book.php tests/BookTest.php --testdox
//declare(strict_types=1);

use PHPUnit\Framework\TestCase;
include_once('model/Book.php');

class BookTest extends TestCase
{
    public function test_testing_is_ready(){$this->assertTrue(TRUE);}

    public function test_book_all_function()
    {
        $book = new Book();
        $this->assertTrue(sizeof($book->all()) > 0);
    }


    public function test_one_to_one_get_all_function()
    {
        $book = new Book();
        $result = $book->oneToOne('genres', 'genre_id', 'id')->get();
        $this->assertTrue(sizeof($result) > 0);
    }

    public function test_one_to_one_get_cols_function()
    {
        $cols = array('title', 'description', 'genre_name');
        $book = new Book();
        $result = $book->oneToOne('genres','genre_id','id')->get($cols);
        $this->assertTrue(sizeof($result) > 0);
    }

    public function test_one_to_one_get_cols_where_function()
    {
        $cols = array('title', 'description', 'genre_name');
        $book = new Book();
        $result = $book->oneToOne('genres','genre_id','id')->where('genre_id', '=', '1')->get($cols);
        $this->assertTrue(sizeof($result) > 0);
    }

    public function test_one_to_one_get_cols_where_chain_function()
    {
        $cols = array('title', 'description', 'genre_name');
        $book = new Book();
        $result = $book->oneToOne('genres','genre_id','id')->where('genre_id', '=', '1')->where('title', '=','The Algorithm Design Manual')->get($cols);
        $this->assertTrue(sizeof($result) > 0);
    }

    public function test_one_to_one_get_cols_where_or_where_chain_function()
    {
        $cols = array('title', 'description', 'genre_name');
        $book = new Book();
        $result = $book->oneToOne('genres','genre_id','id')->where('genre_id', '=', '1')->orWhere('title', '=','The Algorithm Design Manual')->get($cols);
        $this->assertTrue(sizeof($result) > 0);
    }

    public function test_one_to_one_get_cols_or_where_or_where_chain_function()
    {
        $cols = array('title', 'description', 'genre_name');
        $book = new Book();
        $result = $book->oneToOne('genres','genre_id','id')->orWhere('genre_id', '=', '1')->orWhere('title', '=','The Algorithm Design Manual')->get($cols);
        $this->assertTrue(sizeof($result) > 0);
    }


    public function test_many_to_many_get_function()
    {
        $book = new Book();
        $result = $book->getBookList();
        $this->assertTrue(sizeof($result) > 0);
    }

    public function test_many_to_many_get_cols_function()
    {
        $cols = array('title', 'description', 'author_name'); // genres is not included in this many to many join
        $book = new Book();
        $result = $book->manyToMany('authors','books_authors','book_id','author_id')->get($cols);
        $this->assertTrue(sizeof($result) > 0);
    }

    public function test_one_to_one_with_many_to_many_get_cols_function()
    {
        $cols = array('title', 'description', 'author_name', 'genre_name');
        $book = new Book();
        $result = $book->oneToOne('genres','genre_id','id')->manyToMany('authors','books_authors','book_id','author_id')->get($cols);
        $this->assertTrue(sizeof($result) > 0);
    }

    public function test_where_update()
    {
        $primary_key = 'book_id';
        $book = new Book();
        $col_val_pairs = ['title' => 'The Algorithm Design Manual', 'description' => "Cool book dude!"];
        $result = $book->where($primary_key,'=','1')->update($col_val_pairs);
        $this->assertTrue($result);
    }
    
    public function test_update_only_shoud_return_false()
    {
        $book = new Book();
        $col_val_pairs = ['title' => 'The Algorithm Design Manual', 'description' => "Cool book and dude!"];
        $result = $book->update($col_val_pairs);
        $this->assertTrue($result==FALSE);
    }


    
    public function test_grandparent_inheritance_of_database()
    {
        $book = new Book();
        $book->query(
            "INSERT INTO books (book_id, title, description, genre_id) VALUES".
            "(1, 'The Algorithm Design Manual', 'This newly expanded and updated second edition of the best-selling classic continues to take the ".'\"mystery\"'." out of designing algorithms, and analyzing their efficacy and efficiency. Expanding on the first edition, the book now serves as the primary textbook of choice for algorithm design courses while maintaining its status as the premier practical reference guide to algorithms for programmers, researchers, and students.', 1)");
        $this->assertTrue($book->execute());
        
    }
}
?>