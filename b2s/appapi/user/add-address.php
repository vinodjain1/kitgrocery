<?php
include '../../config.php';


 
$os=$_POST['os'];
if($os == 'android'){
    $address=$_POST['address'];
    $latitude=$_POST['latitude'];
    $longitude=$_POST['longitude'];
    $user_id=$_POST['user_id']; 
    $city=$_POST['city'];
}else{
    $arrdata=array();
    $data = json_decode(file_get_contents("php://input"));
    $city=$data->city;
    $address=$data->address;
    $latitude=$data->latitude;
    $longitude=$data->longitude;
    $user_id=$data->user_id; 
} 			
 
$insert = $con->query("INSERT INTO `tbl_address`( `city`,`address`, `latitude`, `longitude`, `user_id`) VALUES ('$city','$address','$latitude','$longitude','$user_id')");

                if($insert > 0)
                { 
                  $j->status  = "101";
                 $j->message = $langs == 'en' ? "Success" : "تم"; 
                }
                else{
                $j->status  = "104";
                $j->message = $langs == 'en' ? "Some thing wrong" : "حدث خطأ"; 
                
                }
 
echo json_encode($j);
 

?>