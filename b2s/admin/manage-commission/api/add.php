<?php
include '../../../config.php';

$name=$_POST['name'];
$percent=$_POST['percent'];
 
$insert = $con->query("INSERT INTO `tbl_commission`(`value`,`percent` ) VALUES ('$name','$percent')");

if($insert > 0)
{ 
  echo '101';
}
else{
  echo '104';
}


?>