<?php
include '../../../config.php';

$name_ar=$_POST['name_ar'];
$name_en=$_POST['name_en'];
$address=$_POST['fulladdress']; 
$latitude=$_POST['lat']; 
$longitude=$_POST['lng']; 

 




$insert = $con->query("INSERT INTO `tbl_delivery_address`(`name_ar`,`name_en`, `address`,`latitude`,`longitude`) VALUES ('$name_ar','$name_en','$address','$latitude','$longitude')");

if($insert > 0)
{ 
  echo '101';
}
else{
  echo '104';
}


?>