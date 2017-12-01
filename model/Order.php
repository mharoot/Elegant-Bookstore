<?php
declare(strict_types=1);
//include_once("Elegant/Model.php");
include_once("C:/xampp/htdocs/Elegant-Bookstore3/Elegant/Model.php");

class Order extends Model {
    //public $id; id is being autoincremented no need to set.  we need auto incremeting detection ideas
    // public $name;
    // public $address;
    /* 
        Every instance of a model should have properties like table_name, primary key, etc;
        Before the parent::__construct().
    */
    public function __construct()  
    {  
            // by convention Elegant assumes the model representing the table in the database is all lower case and plural
            parent::__construct($this);
    }
    public function create ($amount, $customer_id)
    { 
        $this->amount = $amount;
        $this->customer_id = $customer_id;
        return $this->save();
    }
}
?>