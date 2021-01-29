<?php
class Database{
  
    // specify your own database credentials
    private $host = "localhost";
    private $db_name = "kamavvve_grocery_user";
    private $username = "kamavvve_grocery_user";
    private $password = "W9@y6d1i";
    public $conn;
  
    // get the database connection
    public function getConnection(){
  
        $this->conn = null;
  
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
  
        return $this->conn;
    }
}
?>