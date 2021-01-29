<?php
class User{
 
    // database connection and table name
    private $conn;
    private $table_name = "tbl_drivers";
 
    // object properties
    public $id;
    public $phone;
    public $email;
    public $password;
    public $created_at;
    public $updated_at;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // signup user
  
    function login(){
        // select all query
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . " 
                WHERE
                    phone='".$this->phone."' AND password='".$this->password."'" ;
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }
    function siginin(){
        // select all query
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . " 
                WHERE
                    email='".$this->email."' AND password='".$this->password."'" ;
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }

    
  
    
}