<?php
include '../../../config.php';


$id=$_POST['id'];
$heading=$_POST['heading'];
$content=$_POST['content'];


 $insert = $con->query("UPDATE `tbl_terms_condition` SET  `heading`='$heading',`content`='$content'  WHERE  id='$id'");

if($insert > 0){

  echo '101';
}
else{
  echo '104';
}

?>
