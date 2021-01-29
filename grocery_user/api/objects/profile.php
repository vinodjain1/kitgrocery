<?php
class Profile{
 
    // database connection and table name
    private $conn;
    private $table_name = "users";
    public $id;
    public $name;
    public $phone;
    public $email;
    public $dob;
    public $gender;
    public $image;
    public $created_at;
    public $updated_at;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // read products
  function read(){
 
    // select all query
    $query = "SELECT p.id, p.name,p.phone,p.email, p.dob,p.gender,p.image, p.created_at, p.updated_at
            FROM
                " . $this->table_name . " p WHERE id='".$this->id."'
            ORDER BY
                p.created_at DESC";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // execute query
    $stmt->execute();
 
    return $stmt;
}

function update(){
    
        $query = "UPDATE
                " . $this->table_name . "
            SET
                name = :name,
                dob = :dob,
                gender = :gender,
                image = :image
            WHERE
                id = :id";

     $stmt = $this->conn->prepare($query);
    // sanitize
 $this->name=htmlspecialchars(strip_tags($this->name));
    $this->dob=htmlspecialchars(strip_tags($this->dob));
    $this->gender=htmlspecialchars(strip_tags($this->gender));
     $this->image=htmlspecialchars(strip_tags($this->image));
    $this->id=htmlspecialchars(strip_tags($this->id));
    // bind new values
    $stmt->bindParam(':name', $this->name);
    $stmt->bindParam(':dob', $this->dob);
    $stmt->bindParam(':gender', $this->gender);
    $stmt->bindParam(':image', $this->image);
    $stmt->bindParam(':id', $this->id);
    // execute the query
    if($stmt->execute()){
        return 200;
    }
    return 201;
}


function update1(){
        $query = "UPDATE
                " . $this->table_name . "
            SET
                 name = :name,
                dob = :dob,
                gender = :gender
            WHERE
                id = :id";
        
   
     $stmt = $this->conn->prepare($query);
    // sanitize
     $this->name=htmlspecialchars(strip_tags($this->name));
    $this->dob=htmlspecialchars(strip_tags($this->dob));
    $this->gender=htmlspecialchars(strip_tags($this->gender));
    $this->id=htmlspecialchars(strip_tags($this->id));
    // bind new values
    $stmt->bindParam(':name', $this->name);
    $stmt->bindParam(':dob', $this->dob);
    $stmt->bindParam(':gender', $this->gender);
    $stmt->bindParam(':id', $this->id);
    // execute the query
    if($stmt->execute()){
        return true;
    }
    return false;
}
}
?>