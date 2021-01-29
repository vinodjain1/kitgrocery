<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/profile.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$profile = new Profile($db);

 

if(!empty($_FILES["image"]["name"])){
           $targetDir = "../image/";
           $upload_url="http://kitsupdates.work/experts/api/image/";
           $fileName = basename($_FILES["image"]["name"]);
            $fileinfo = pathinfo($_FILES['image']['name']);
            $file_url = $upload_url . $fileName;
            $file_path = $targetDir . $fileName; 
            move_uploaded_file($_FILES["image"]["tmp_name"], $file_path);
            $FilePath=$file_url;
            $profile->id = $_POST['id'];
            $profile->name = $_POST['name'];
            $profile->dob = $_POST['dob'];
            $profile->gender = $_POST['gender'];
            $profile->image = $FilePath;
            if($profile->update()){
                http_response_code(200);
                echo json_encode(array(
                    "status" => "200",
                    "message" => "Profile was updated.")
                    );
            }
            else{
                echo json_encode(array("status" => "201","message" => "Profile was Not updated."));
            }
   
    
    
}else{
   
        $profile->id = $_POST['id'];
        $profile->name = $_POST['name'];
        $profile->dob = $_POST['dob'];
        $profile->gender = $_POST['gender'];
      
        if($profile->update1()){
            http_response_code(200);
            echo json_encode(array(
                "status" => "200",
                "message" => "Profile was updated.")
                );
        }
        else{
            echo json_encode(array("status" => "201","message" => "Profile was Not updated."));
        }
}
       
?>