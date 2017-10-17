<?php

include_once("Database.php");
include_once("QueryBuilder.php");
class Model extends Database 
{
    private $queryBuilder = NULL;
    public $table_name = NULL;




    function __construct() 
    {
        if ($this->table_name === NULL )
        {
            $child_class_that_called_model = get_called_class();
            $snake_case = $child_class_that_called_model.'s';
            $this->table_name = strtolower($snake_case);
        }
        $this->queryBuilder = new QueryBuilder($this->table_name);

        parent::__construct();
        $this->checkTableExist($this->table_name);

    }
    




    public function all() 
    {
        // check if this table exists
        
        $q = $this->queryBuilder->all();
        $this->query($q);
        return $this->resultset();
    }



    public function update($col_val_pairs)
    {
        
        $q = $this->queryBuilder->update($col_val_pairs);
        if ($q == '')
        {
             //redirect('error404.php');
            return false;
        }
        $this->query($q);
        return $this->execute();
    }

    public function insert($col_val_pairs)
    {
        $this->checkTableExist();
        $q = $this->queryBuilder->insert($col_val_pairs);
        if ($q == '')
        {
             //redirect('error404.php');
            return false;
        }
        $this->query($q);
        return $this->execute();
    }


    public function where ($col_name, $arg2, $arg3 )
    {
        $this->queryBuilder->where($col_name, $arg2, $arg3);
        return $this;
    }





    public function orWhere ($col_name, $arg2, $arg3 ) 
    {
        $this->queryBuilder->orWhere($col_name, $arg2, $arg3);
        return $this;
    }





	public function manyToMany($table_name,$junction_table,$this_primary_key,$primary_key) 
    {
        $this->checkTableExist($table_name);
        $this->checkTableExist($junction_table);
        $this->queryBuilder->manyToMany($table_name,$junction_table,$this_primary_key,$primary_key);
        return $this;
    }
	


    public function oneToOne($table_name, $primary_key, $foreign_key) 
    { 
        $this->checkTableExist($table_name);
        $this->queryBuilder->oneToOne($table_name, $primary_key, $foreign_key);
        return $this;
    }


    public function oneToMany($table_name, $primary_key, $foreign_key) 
    { 
        $this->checkTableExist($table_name);
        $this->queryBuilder->oneToMany($table_name, $primary_key, $foreign_key);
        return $this;
    }


    public function get($cols = NULL)
    {
        
        $q = $this->queryBuilder->get($cols);
        $this->query($q);
        return $this->resultset();
    }








    /*************************************************************************
     *                         UTILITY FUNCTIONS
     *************************************************************************/

    private function checkTableExist ($table_name = NULL) 
    { 
        // check if developer remembered to give table name
        if ($this->table_name === NULL)
        {
            redirect('error404.php');
        }

        // check if (this table) or (the table we are trying to join) name is correct or 
        $tableExists = $this->checkTableExistHelper($table_name);
        if (!$tableExists)
        {
            redirect('error404.php');
        }
    }






    private function checkTableExistHelper ($table_name) 
    {

        if ($table_name == NULL) 
        {
            // then we are checking for the existence of this models table
            $this->query("SHOW TABLES LIKE '".$this->table_name."'");
        } 
        else 
        {
            // we are checking for the table we are trying to join
            $this->query("SHOW TABLES LIKE '".$table_name."'");
        }

        $result = $this->execute();

        return $this->rowCount($result) > 0;
    }





    private function redirect ($url) 
    {
        ob_start();
        header('Location: '.$url);
        ob_end_flush();
        die();
    }
}

?>