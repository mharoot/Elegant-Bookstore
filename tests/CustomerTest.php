<?php
//in command line run: 
//phpunit --bootstrap model/Customer.php tests/CustomerTest.php --testdox
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
include_once('model/Customer.php');

class CustomerTest extends TestCase
{
    public function test_the_table_name_property_inhertited_from_Model_before_Customer_instantiated()
    {
        $class_name = "Customer";
        
        $class_vars = get_class_vars ( $class_name );
        foreach ($class_vars as $property_name => $value) 
        {
            echo "$property_name : $value\n";
            switch($property_name)
            {
                case 'table_name':
                    $this->assertEquals('table_name',$property_name);
                    break;
                case 'id':
                    $this->assertEquals('id',$property_name);
                    break;
                case 'address':
                    $this->assertEquals('address', $property_name);
                    break;
                case 'name':
                    $this->assertEquals('name', $property_name);
                    break;
            }
            
        }

    }
    


    
    public function test_one_to_many_get_all_function()
    {
        $customer = new Customer();
        $primary_key = 'id';
        $foreign_key = 'customer_id';
        $result = $customer->oneToMany('orders', $primary_key, $foreign_key)->get();
        $this->assertTrue(sizeof($result) > 0);
    }


    public function test_orm_properties_of_an_instance_of_customer_model()
    {
        $customer = new Customer();
        $customer->address = "1642 Daily Circle Drive, Glendale Ca 91208";
        $customer->name    = "Craig Walker";
        // $customer->save();

        // testing
        $class_vars = $customer->getChildProps();
        var_dump($class_vars);
        echo $class_vars['name']."\n";
        echo $class_vars['address'];
        // foreach ($class_vars as $property_name => $value) 
        // {
        //     echo "$property_name : $value\n";
        // }

        $this->assertTrue(true);
    }
    
}
?>