<?php
//in command line run: 
//phpunit --bootstrap model/Book.php tests/BookTest.php --testdox
declare(strict_types=1);

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

    	/*
		--working relations--

		
		--working where and orWhere--
		3.
		return $this->where('title', '=', $title )->orWhere('id','=',2)->get();

		4. 
		return $this->where('title', '=', $title )->orWhere('id','=',2)->get(array('title', 'description', 'author', 'genre'));
		*/
    
}
?>