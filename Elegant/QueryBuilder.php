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

    public function select ($cols = NULL)
    {
        $this->query = 'SELECT ';

        if ($cols == null) 
        {
            // we have not specified what columns we want to retrieve, so we assume all is wanted
            $this->query .= "*";
        }
        else // we have specified what columns we want to retrieve
        {   

            $length = sizeof($cols) -1;

            for ($i = 0; $i < $length; $i++) 
            {
                $this->query.= $cols[$i] . ", ";
            }

            $this->query.= $cols[$length];
        }
        $this->query.= " FROM ".$this->table_name;

        return $this;
    }

    public function update($col_val_pairs)
    {
        if (!$this->hasWhereClause)
        {
            return '';
        }

        /*
        $query_update = $this->prepare('');
        
        to do:
        1. update query builder insert
        2. update query builder update
        3. update model insert  (do binding in here)
        4. update model update  (do binding in here)
        
        UPDATE users SET user_password_hash = :user_password_hash WHERE user_id = :user_id


        $query_update->bindValue(:user_password_hash', $user_password_hash, PDO::PARAM_STR);
        $query_update->bindValue(:user_id', $result_row->user_id, PDO::PARAM_INT);
        
        
        
        $query_update->execute();
        */
        reset($col_val_pairs);
        $query ="UPDATE ".$this->table_name." SET"; // "UPDATE books SET"
        $prefix = '';
        $n = sizeof($col_val_pairs) - 1;
        $i = 0;
        while ( list( $key, $val ) = each( $col_val_pairs ) ) 
        {
            $query .= " ".$prefix.$key." = ".":".$prefix.$key; // "UPDATE books SET title = :title
            if($i != $n)
            {
                $i++;
                $query .= ","; // "UPDATE books SET title = :title, description = :description"
            }

        }
        reset($col_val_pairs);
        $i = 0;
        $query .= $this->query;
        var_dump($query.' #2 QB');
        $this->resetProperties();
        return $query;
    }

    public function insert($col_val_pairs)
    {

        /*
            INSERT INTO table_name ( field1, field2,...fieldN ) VALUES ( value1, value2,...valueN );
        */
        reset($col_val_pairs);
        $query ="INSERT INTO ".$this->table_name." (";
        
     
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
            $query .= " :".$key;  // 'INSERT INTO users (user_type, first_name, last_name) VALUES (:user_type, :first_name, :last_name)'
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


        
   /**
    * 
    *  About Where:
    *  It prepares model for binding sanitized input.  You cannot pass in a WHERE
    *  clause in a safe fashion period end of story As of now there is a Security 
    *  issue prepare for all possible user input.
    *
    *  Assumption:
    *      The where function was built assuming only there can be only one WHERE clause in an sql query.
    *
    *  @param string $col_name is use to prepare :$col_name for binding
    *  @param string $arg2 = {=,>,<,<=,>=,LIKE}
    * 
    */
    public function where ( $col_name, $arg2 )
    {
        
        
        if ( ! $this->hasWhereClause ) // where has not been called already
        {   // then add WHERE

            if ($this->query == '') // the query string is not filled
            {   //then prepare for a call to delete or update to append to front of the query string


                // " WHERE USERNAME=:username "
                //              WHERE    USERNAME   =     :   username 
                $this->query =" WHERE ".$col_name.$arg2.":".$col_name." ";
            }
            else
            {
                $this->query .=" WHERE ".$col_name.$arg2.":".$col_name." ";
            }
        } 
        else 
        {
            // " WHERE USERNAME=:username AND PASSWORD=:pass"
            //                AND    PASSWORD   =     :  pass
             $this->query .=" AND ".$col_name.$arg2.":".$col_name." ";
        }

        $this->hasWhereClause = TRUE;

        return $this;
    }






    public function orWhere ( $col_name, $arg2)
    {
        if ( ! $this->hasWhereClause ) 
        {
            if ($this->query == '')
            {
                $this->query =" WHERE ".$col_name.$arg2.":".$col_name." ";
            }
            else
            {
                $this->query .=" WHERE ".$col_name.$arg2.":".$col_name." ";
            }
        } 
        else 
        {
             $this->query .=" OR ".$col_name.$arg2.":".$col_name." ";
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