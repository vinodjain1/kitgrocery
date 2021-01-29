<?php
// include database and object files
include_once '../config/database.php';
include_once '../objects/user.php';

// get database connection
$database = new Database();
$db = $database->getConnection();
$user = new User($db);
$user->phone = $_POST['phone'];
$user->email = $_POST['email'];
$user->password = base64_encode($_POST['password']);
$g = $_POST['phone'];
$p = $_POST['password'];
$q = $_POST['email'];
if(empty($q)){
if($g == " " && $p == " "){
$user_arr=array(
            "status" => 201,
            "message" => "creditional are Invalid!",
        );
}else{
    $stmt = $user->login();
    if($stmt->rowCount() > 0){
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // create array
        $user_arr=array(
            "status" => 200,
            "message" => "Successfully Login!",
            "id" => $row['id'],
            "name" => $row['name'],
            "email" => $row['email'],
            "phone" => $row['phone'],
            "city"   =>  $row['city'],
            "state" => $row['state']
           
        );
    }
    else{
        $user_arr=array(
            "status" => 404,
            "message" => "Invalid phone or Password!",
        );
    }

print_r(json_encode($user_arr));
}
}else{
    if($g == " " && $p == " "){
$user_arr=array(
            "status" => 201,
            "message" => "creditional are Invalid!",
        );
}else{
    $stmt = $user->siginin();
    if($stmt->rowCount() > 0){
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // create array
        $user_arr=array(
            "status" => 200,
            "message" => "Successfully Login!",
            "id" => $row['id'],
            "name" => $row['name'],
            "email" => $row['email'],
            "phone" => $row['phone'],
            "city"   =>  $row['city'],
            "state" => $row['state']
           
        );
    }
    else{
        $user_arr=array(
            "status" => 404,
            "message" => "Invalid phone or Password!",
        );
    }

print_r(json_encode($user_arr));
}
}
?>
