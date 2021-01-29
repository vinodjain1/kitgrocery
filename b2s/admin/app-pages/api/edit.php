<?php
include '../../../config.php';


$id=$_POST['id'];
$type=$_POST['type'];
$content=$_POST['editor1'];
 
 $insert = $con->query("UPDATE `tbl_pages` SET  `content`='$content'   WHERE  id='$id'");

if($insert > 0){

  echo '101';
}
else{
  echo '104';
}

?>
