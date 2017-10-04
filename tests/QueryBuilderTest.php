<?php
//in command line run: 
//phpunit --bootstrap model/*.php tests/*.php --testdox
//phpunit --bootstrap model/*.php tests/QueryBuilderTest.php --testdox

declare(strict_types=1);
use PHPUnit\Framework\TestCase;
include_once('Elegant/QueryBuilder.php');

class QueryBuilderTest extends TestCase
{
    public function test_query_builder_all_function()
    {
        $table_name = 'books';
        $queryBuilder = new QueryBuilder($table_name);
        $this->assertEquals($queryBuilder->all(), 'SELECT * FROM '.$table_name);
    }

    
}
?>