<?php
include '../../../config.php';


$id=$_POST['id'];
$name_ar=$_POST['name_ar'];
$name_en=$_POST['name_en'];
$address=$_POST['fulladdress']; 
$latitude=$_POST['lat']; 
$longitude=$_POST['lng'];

        
 
 $insert = $con->query("UPDATE `tbl_delivery_address` SET  `name_ar`='$name_ar',`name_en`='$name_en',`address`='$address' ,`longitude`='$longitude',`latitude`='$latitude' WHERE  id='$id'");

if($insert > 0){

  echo '101';
}
else{
  echo '104';
}

?>
