<?php

include_once("Elegant/Database.php");

class Model extends Database {

    private $isOneToOne = FALSE;
    private $query = NULL;
    private $where_clause_counter = -1;

    public $table_name = NULL;

    // function __construct() {
    //     $this->where_clause_counter = -1;
    // }
    
    public function all() {
        // check if table name exists
        $this->checkTableExist();
        $this->query('SELECT * FROM '.$this->table_name);
        return $this->resultset();
    }


    public function where($col_name, $arg2, $arg3 ){
        $this->where_clause_counter++;
        if ( $this->where_clause_counter == 0 ) {
             $this->query =" WHERE ".$col_name.$arg2."'".$arg3."'";
        } else {
             $this->query .="AND ".$col_name.$arg2."'".$arg3."'";
        }
        return $this;
    }

    public function orWhere($col_name, $arg2, $arg3 ){
        $this->where_clause_counter++;
        if ( $this->where_clause_counter == 0 ) {
             $this->query =" WHERE ".$col_name.$arg2."'".$arg3."'";
        } else {
             $this->query .=" OR ".$col_name.$arg2."'".$arg3."'";
        }
        return $this;
    }

    public function oneToOne($table_name, $primary_key, $foreign_key) { 
        $this->isOneToOne = TRUE;
        // void function will be part of query building


        /* SELECT title,genre_name FROM books JOIN genres WHERE books.genre = genres.id */

        // check if the table we are trying to join to exists
        $this->checkTableExist($table_name);

        $this->query = $this->table_name." JOIN ".$table_name." WHERE ".$this->table_name.".".$primary_key."=".$table_name.".".$foreign_key;
        

        return $this;
    }


    public function get($cols = NULL){
        $this->checkTableExist();
        $final_query = 'SELECT ';
        if ($cols == null) {
            // what if we have called oneToOne
            if ($this->isOneToOne)
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

            if ($this->isOneToOne)
                $final_query .= " FROM ";//.$this->table_name;
            else
                $final_query .= " FROM ".$this->table_name;
        }

        //reset properties
        $this->where_clause_counter = 0;
        $this->isOneToOne = FALSE;


        if ($this->query !== NULL) {
            $final_query .= $this->query;
            $this->query($final_query);
            return $this->resultset();
        }  else {
            return $this->all();
        }
    }

    private function checkTableExist($table_name = NULL) { 
        // check if developer remembered to give table name
        if ($this->table_name === NULL)
            redirect('error404.php');

        // check if (this table) name is correct or check if (the table we are trying to join) to (this table) exists
        $tableExists = $this->checkTableExistHelper($table_name);
        if (!$tableExists)
            redirect('error404.php');
    }

    private function checkTableExistHelper($table_name) {


        if ($table_name == NULL) {
            // then we are checking for the existence of this models table
            $this->query("SHOW TABLES LIKE '".$this->table_name."'");
        } else {
            // we are checking for a joining table
            $this->query("SHOW TABLES LIKE '".$table_name."'");
        }
        $result = $this->execute();
        return $this->rowCount($result) > 0;
    }

    private function redirect($url) {
        ob_start();
        header('Location: '.$url);
        ob_end_flush();
        die();
    }
}

?>