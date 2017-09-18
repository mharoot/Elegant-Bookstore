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
}
?>