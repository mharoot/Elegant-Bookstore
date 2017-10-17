<?php
//in command line run: 
//phpunit --bootstrap model/Customer.php tests/CustomerTest.php --testdox
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
include_once('model/Customer.php');

class CustomerTest extends TestCase
{
    public function test_testing_is_ready(){$this->assertTrue(TRUE);}

    
    public function test_one_to_many_get_all_function()
    {
        $customer = new Customer();
        $primary_key = 'id';
        $foreign_key = 'customer_id';
        $result = $customer->oneToMany('orders', $primary_key, $foreign_key)->get();
        $this->assertTrue(sizeof($result) > 0);
    }

    
}
?>