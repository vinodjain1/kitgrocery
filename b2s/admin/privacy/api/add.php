<?php
include '../../../config.php';

$heading=$_POST['heading'];
$content=$_POST['content'];


$insert = $con->query("INSERT INTO `tbl_privacy`(`heading`,`content`) VALUES ('$heading','$content')");

if($insert > 0)
{ 
  echo '101';
}
else{
  echo '104';
}


?>