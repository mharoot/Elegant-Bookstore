<?php
declare(strict_types=1);

class QueryBuilder 
{

    private $isOneToOne = FALSE;
    private $isManyToMany = FALSE;
    private $query = NULL;
    private $where_clause_counter = -1;
    private $table_name = NULL;





    function __construct ($models_table_name) 
    {
        $this->table_name = $models_table_name;
    }
    




    public function all() 
    {
        $this->query = 'SELECT * FROM '.$this->table_name;
        return $this->query;
    }





    public function where ( $col_name, $arg2, $arg3 )
    {
        $this->where_clause_counter++;
        if ( $this->where_clause_counter == 0) 
        {
            if ($this->query == NULL)
            {
                $this->query =" WHERE ".$col_name.$arg2."'".$arg3."'";
            }
            else
            {
                $this->query .=" WHERE ".$col_name.$arg2."'".$arg3."'";
            }
        } 
        else 
        {
             $this->query .=" AND ".$col_name.$arg2."'".$arg3."'";
        }
        
        return $this;
    }






    public function orWhere($col_name, $arg2, $arg3 ){
        $this->where_clause_counter++;
        if ( $this->where_clause_counter == 0 ) {
            if ($this->query == NULL)
                $this->query =" WHERE ".$col_name.$arg2."'".$arg3."'";
            else
                $this->query .=" WHERE ".$col_name.$arg2."'".$arg3."'";
        } else {
             $this->query .=" OR ".$col_name.$arg2."'".$arg3."'";
        }
        return $this;
    }






	public function manyToMany($table_name,$junction_table,$this_primary_key,$primary_key) {
        /*SELECT * from books INNER JOIN books_authors ON (books.book_id=books_authors.book_id) INNER JOIN authors ON (books_authors.author_id = authors.author_id) where 1*/
        $this->isManyToMany = TRUE;
        $this->checkTableExist($table_name);
        $this->checkTableExist($junction_table);
        if($this->query == NULL)
            $this->query = $this->table_name." JOIN ".$junction_table." ON (".$this->table_name.".".$this_primary_key."=".$junction_table.".".$this_primary_key.") JOIN ". $table_name." ON (".$junction_table.".".$primary_key."=".$table_name.".".$primary_key.")";
        else
             $this->query .= " JOIN ".$junction_table." ON (".$this->table_name.".".$this_primary_key."=".$junction_table.".".$this_primary_key.") JOIN ". $table_name." ON (".$junction_table.".".$primary_key."=".$table_name.".".$primary_key.")";
        return $this;
    }
	





    public function oneToOne($table_name, $primary_key, $foreign_key) { 
        $this->isOneToOne = TRUE;
        // void function will be part of query building


        /* SELECT title,genre_name FROM books JOIN genres WHERE books.genre = genres.id */

        // check if the table we are trying to join to exists
        $this->checkTableExist($table_name);

        $this->query = $this->table_name." JOIN ".$table_name." ON ".$this->table_name.".".$primary_key."=".$table_name.".".$foreign_key;
        

        return $this;
    }





    public function get($cols = NULL){
        $this->checkTableExist();
        $final_query = 'SELECT ';
        if ($cols == null) {
            // what if we have called oneToOne
            if ($this->isOneToOne || $this->isManyToMany)
                $final_query .= "* FROM ";//.$this->table_name;
            else
                $final_query .= "* FROM ".$this->table_name;
            
                
        } else {
            $length = sizeof($cols) -1;
            for ($i = 0; $i < $length; $i++) {
                $final_query .= $cols[$i] . ", ";
            }
            $final_query .= $cols[$length];
            // what if were calling oneToOne

            if ($this->isOneToOne || $this->isManyToMany)
                $final_query .= " FROM ";//.$this->table_name;
            else
                $final_query .= " FROM ".$this->table_name;
        }

        //reset properties
        $this->where_clause_counter = -1;
        $this->isOneToOne = FALSE;
        $this->isManyToMany = FALSE;


        if ($this->query !== NULL) 
        {
            $final_query .= $this->query;
            $this->query($final_query);
            return $this->resultset();
        }  
        else 
        {
            return $this->all();
        }
    }

}

?>