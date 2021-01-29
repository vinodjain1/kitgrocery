<?php
include '../../config.php';
// $os=$_POST['os'];
// if($os == 'android'){
    $address_id=$_POST['address_id'];
    $address=$_POST['address'];
    $latitude=$_POST['latitude'];
    $longitude=$_POST['longitude'];
    $user_id=$_POST['user_id']; 
// }else{
//     $arrdata=array();
//     $data = json_decode(file_get_contents("php://input"));
//     $address_id=$data->address_id;
//     $address=$data->address;
//     $latitude=$data->latitude;
//     $longitude=$data->longitude;
//     $user_id=$data->user_id; 
    
// } 			
  
$insert = $con->query("UPDATE `tbl_address` SET  `address`= '$address', `latitude`='$latitude',`longitude`= '$longitude',`user_id`='$user_id' where id='$address_id'");

                if($insert > 0)
                { 
                  $j->status  = "101";
                 $j->message = "Success"; 
                }
                else{
                $j->status  = "104";
                $j->message = "Some thing wrong"; 
                
                }
 
echo json_encode($j);
 

?>