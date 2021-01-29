<?php
include '../../../config.php';


$id=$_POST['id'];
$name=$_POST['name'];
$percent=$_POST['percent'];
 $path=null;

 
 $insert = $con->query("UPDATE `tbl_commission` SET  `value`='$name',`percent`='$percent'  ");

if($insert > 0){

  echo '101';
}
else{
  echo '104';
}

?>
