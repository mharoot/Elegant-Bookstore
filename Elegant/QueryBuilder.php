<?php
declare(strict_types=1);
/*
    TODO:
    NOTE: GET(), UPDATE(), DELETE(), INSERT()
    1. All return strings so these
    2. All must reset the query string because its the end of the query.
*/
class QueryBuilder 
{

    public $hasWhereClause;
    private $isManyToMany;
    private $isOneToOne;
    private $isOneToMany;
    private $query;
    private $table_name;





    function __construct ($models_table_name) 
    {
        $this->resetProperties();
        $this->table_name = $models_table_name;
    }
    





    public function all() 
    {
        return 'SELECT * FROM '.$this->table_name;
       
    }
    
    public function delete()
    {
        if (!$this->hasWhereClause)
        {
            return '';
        }
 
        $query ="DELETE FROM ".$this->table_name;
 
        $query .= $this->query;
        $this->resetProperties();
        return $query;
    }

    public function update($col_val_pairs)
    {
        if (!$this->hasWhereClause)
        {
            return '';
        }


        reset($col_val_pairs);
        $query ="UPDATE ".$this->table_name." SET ";
        $prefix = '';
        while (list($key, $val) = each($col_val_pairs)) 
        {
            $query .= $prefix.$key."='".$val."' ";
            $prefix=', ';
        }
        $query .= $this->query;
        $this->resetProperties();
        return $query;
    }

    public function insert($col_val_pairs)
    {

        /*
INSERT INTO table_name ( field1, field2,...fieldN )
   VALUES
   ( value1, value2,...valueN );

        */
        reset($col_val_pairs);
        $query ="INSERT INTO ".$this->table_name." (";
        // INSERT INTO books VALUES title='The Algorithm Design Manual' , description='Cool book dude!' 

        
     
        $prefix = '';
        $n = sizeof($col_val_pairs) - 1;
        $i = 0;
        while ( list( $key, $val ) = each( $col_val_pairs ) ) 
        {
            $query .= " ".$prefix.$key;
            if($i != $n)
            {
                $i++;
                $query .= ",";
            }

        }
        $query .= " ) VALUES (";

        reset($col_val_pairs);
        $i = 0;
        while ( list( $key, $val ) = each( $col_val_pairs ) ) 
        {
            $query .= " '".$val."'";
            if($i != $n)
            {
                $i++;
                $query .= ",";
            }

        }
        $query .= " )";
        $this->resetProperties();
        return $query;
    }

    public function where ( $col_name, $arg2, $arg3 )
    {
        if ( ! $this->hasWhereClause ) 
        {
            if ($this->query == '')
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

        $this->hasWhereClause = TRUE;

        return $this;
    }






    public function orWhere ( $col_name, $arg2, $arg3 )
    {
        if ( ! $this->hasWhereClause ) 
        {
            if ($this->query == '')
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
             $this->query .=" OR ".$col_name.$arg2."'".$arg3."'";
        }

        $this->hasWhereClause = TRUE;

        return $this;
    }






	public function manyToMany ( $table_name, $junction_table, $this_primary_key, $primary_key) 
    {
        /*SELECT * from books INNER JOIN books_authors ON (books.book_id=books_authors.book_id) INNER JOIN authors ON (books_authors.author_id = authors.author_id) where 1*/

        $this->isManyToMany = TRUE;

        if($this->query == '')
        {
            $this->query = $this->table_name." JOIN ".$junction_table." ON (".$this->table_name.".".$this_primary_key."=".$junction_table.".".$this_primary_key.") JOIN ". $table_name." ON (".$junction_table.".".$primary_key."=".$table_name.".".$primary_key.")";
        }
        else
        {
             $this->query .= " JOIN ".$junction_table." ON (".$this->table_name.".".$this_primary_key."=".$junction_table.".".$this_primary_key.") JOIN ". $table_name." ON (".$junction_table.".".$primary_key."=".$table_name.".".$primary_key.")";
        }

        return $this;
    }
	





    public function oneToOne ( $table_name, $primary_key, $foreign_key) 
    { 
        $this->isOneToOne = TRUE;
        // void function will be part of query building


        /* SELECT * FROM books JOIN genres ON books.genre_id=genres.id */
        $this->query = $this->table_name." JOIN ".$table_name." ON ".$this->table_name.".".$primary_key."=".$table_name.".".$foreign_key;
        

        return $this;
    }

    public function oneToMany($table_name, $primary_key, $foreign_key) { 
        $this->isOneToMany = TRUE;
        // void function will be part of query building

        $this->query = $this->table_name." JOIN ".$table_name." ON ".$this->table_name.".".$primary_key."=".$table_name.".".$foreign_key;
        return $this;
        
    }

    public function get ($cols = NULL)
    {
        $final_query = 'SELECT ';

        if ($cols == null) // we have not specified what columns we want to retrieve, so we assume all is wanted
        {
            // if we have called any relationship function
            if ($this->isOneToOne || $this->isOneToMany || $this->isManyToMany)
            {
                // SELECT * FROM
                $final_query .= "* FROM "; 
            }
            else
            {
                // SELECT * FROM table_name
                $final_query .= "* FROM ".$this->table_name;
            }
            
                
        } 
        else // we have specified what columns we want to retrieve
        {   

            $length = sizeof($cols) -1;

            for ($i = 0; $i < $length; $i++) 
            {
                $final_query .= $cols[$i] . ", ";
            }

            $final_query .= $cols[$length];
            // At this point we have one or more columns we specified
            // SELECT col1, col2, ...., colk

            if ($this->isOneToOne || $this->isOneToMany|| $this->isManyToMany)
            {
                // SELECT col1, col2, ...., colk FROM 
                $final_query .= " FROM ";
            }
            else
            {
                // SELECT col1, col2, ...., colk FROM table_name
                $final_query .= " FROM ".$this->table_name;
            }
        }

        /**
         * Code Tracing Note: 
         * At this point we have not touched the property $this->query within this function get.
         * However, if one or more functions that build the query statement have been called.
        */

        if ($this->query !== '') // get has been called after one or more functions that build the query
        {
            $final_query .= $this->query;
            $this->resetProperties();
            return $final_query;
        }  
        else // get has been called all by itself
        {
            $this->resetProperties();
            return $final_query;
        }
    }




    /**
     * Resets all but the table name properties.
     *
     */
    private function resetProperties()
    {
        $this->hasWhereClause = FALSE;
        $this->isManyToMany   = FALSE;
        $this->isOneToOne     = FALSE;
        $this->isOneToMany    = FALSE;
        $this->query          = '';
    }


}

?>