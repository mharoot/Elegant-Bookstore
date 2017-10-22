<?php

include_once("Database.php");
include_once("QueryBuilder.php");
class Model extends Database 
{
    private $queryBuilder = NULL;
    private $child_class  = NULL;
    public $table_name = NULL;



    function __construct($child_class = NULL) 
    {
        $child_class_that_called_model = '';

        if ($this->table_name === NULL )
        {
            $child_class_that_called_model = get_class($child_class);
            $snake_case = $child_class_that_called_model.'s';
            $this->table_name = strtolower($snake_case);
        }

        $this->queryBuilder = new QueryBuilder($this->table_name);
        $this->child_class = $child_class;
        parent::__construct();
        $this->checkTableExist($this->table_name);
        
        $table_cols = $this->describe($this->table_name);

        //dynamically creating child class properties in construct
        foreach ($table_cols as $col)
        {
            $this->child_class->{$col} = NULL;
        }

    }

    public function save() // returns boolean
    {
        $result = FALSE;
        if (!$this->queryBuilder->hasWhereClause) {
            $result = $this->insert($this->getChildProps());
        } else {
            file_put_contents("testing-save.txt", "update is being executed");
            $result = $this->update($this->getChildProps());
        }
        return $result;
    }

    public function getChildProps()
    {
        $class_name = get_class($this->child_class);
        $class_vars = get_class_vars($class_name);
        $object_vars  = get_object_vars($this->child_class);
        $child_props = [];
        $n = sizeof($class_vars) - 3; // minus 3 from the properties in this model
        $i = 0;
        foreach ($class_vars as $property_name => $value) 
        {
            echo "$property_name : $value\n";
            
            if( $object_vars[$property_name] !== NULL )
                $child_props[$property_name] = $object_vars[$property_name];
            $i++;
            if($i == 2)
                break;
        }
        
        return $child_props;
    }

    public function all() 
    {
        // check if this table exists
        
        $q = $this->queryBuilder->all();
        $this->query($q);
        $class_name = get_class($this->child_class);
        $results = $this->resultsetObject($class_name);

        return $results;
    }


    public function delete()
    {
        $q = $this->queryBuilder->delete();
        if ($q == '')
        {
             //redirect('error404.php');
            return false;
        }
        $this->query($q);
        return $this->execute();
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