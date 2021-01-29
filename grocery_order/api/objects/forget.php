<?php
class Video{
 
    // database connection and table name
    private $conn;
    private $table_name = "users";
 
    // object properties
    public $id;
    public $email;
    public $created_at;
    public $updated_at;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // read products
  function read(){
 
    // select all query
    $query = "SELECT p.id, p.email, p.created_at, p.updated_at
            FROM
                " . $this->table_name . " p WHERE p.email='".$this->email."'
            ORDER BY
                p.created_at DESC";
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
}
}
?>