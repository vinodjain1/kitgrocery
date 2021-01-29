<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 // include database and object files
include_once '../config/database.php';
include_once '../objects/profile.php';
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
// initialize object
$profile = new Profile($db);
// query products
$profile->id = $_POST['id'];
$c_id = $profile->id;
if($c_id == ""){
$profile_arr=array(
            "status" => false,
            "message" => "Not Found!",
        );
}else{
$stmt = $profile->read();
$num = $stmt->rowCount();
// check if more than 0 record found
  $profile_arr=array();

if($num>0){
      $profile_arr["status"]="1";
      $profile_arr["messages"]="Read All Data.";
      $profile_arr["profile_data"]=array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $profile=array(
            "id" => $id,
            "type_id" => $type_id,
            "name" => $name,
            "phone" =>$phone,
            "email"=>$email, 
            "password"=>$password,
            "dob"=>$dob,
            "gender"=>$gender,
            "image"=>$image,
            "created_at" => $created_at,
            "updated_at" => $updated_at,
        );
 
        array_push($profile_arr["profile_data"], $profile);
    }
    // set response code - 200 OK
    http_response_code(200);
    // show products data in json format
    echo json_encode($profile_arr);
}else{
      
       $profile_arr["status"]="0";
       $profile_arr["messages"]="Data Not Found.";
       echo json_encode($profile_arr);

}
}
